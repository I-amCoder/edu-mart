<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Province;
use App\Models\Subject;
use App\Models\SubjectChapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectsController extends Controller
{
    public function create($class)
    {
        $class = Classes::findOrFail($class);
        $provinces = Province::all();
        return view('subject.create', compact('class', 'provinces'));
    }

    public function store(Request $request, $hash)
    {



        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            // 'province' => 'required|string',
            'image' => 'required',
        ]);

        $class = Classes::findOrFail(decrypt($hash));


        $subject = new Subject();
        //If we have A SubClass
        if ($request->has('subClass')) {
            $subClass = Classes::find(decrypt($request->subClass));
            if (!$subClass) {
                return redirect()->back()->withErrors(['subClass' => 'Please Select A Valid SubClass'])->withInput();
            } else {
                $subject->class_id = $subClass->id;
            }
        } else {
            $subject->class_id = $class->id;
        }

        if ($class->type == 'tertiary') {
            $subject->province_id = 0;
        } else {
            $province = Province::findOrFail(decrypt($request->province));
            $subject->province_id = $province->id;
        }
        $subject->name = $request->name;
        $subject->description = $request->description;

        // Upload Image
        if ($request->hasFile('image')) {
            $uuid = Str::uuid()->toString();
            $name = Str::slug($request->subject_name, '-') . '_' . $uuid   . '.' . $request->image->extension();
            $subject->image = $name;
            $request->image->move(public_path('subjects/images'),  $name);
        }
        $subject->save();

        // Save chapters
        foreach ($request->chapter as $chp) {
            $chapter = new SubjectChapter();
            $chapter->name = $chp['name'];
            $chapter->slug = Str::slug($chp['name'], '-');
            $chapter->description = $chp['description'];
            $chapter->subject_id = $subject->id;
            $chapter->save();
        }

        return to_route('admin.class.details', $class->id)->withSuccess("Subject Has Been Saved Successfully");
    }

    public function edit($class, $subject)
    {
        $class = Classes::findOrFail($class);
        $subject = Subject::findOrFail($subject);
        $provinces = Province::all();
        return view('subject.edit', compact('class', 'provinces', 'subject'));
    }

    public function destroy($class, $subject)
    {
        $subject = Subject::findOrFail($subject);
        SubjectChapter::where('subject_id', $subject->id)->delete();
        $subject->delete();
        return to_route('admin.class.details', $class)->withSuccess("Subject Has Been Saved Successfully");
    }

    public function update(Request $request, $class, $subject)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',

        ]);

        $class = Classes::findOrFail(decrypt($class));


        $subject = Subject::findOrFail($subject);
        //If we have A SubClass
        if ($request->has('subClass')) {
            $subClass = Classes::find(decrypt($request->subClass));
            if (!$subClass) {
                return redirect()->back()->withErrors(['subClass' => 'Please Select A Valid SubClass'])->withInput();
            } else {
                $subject->class_id = $subClass->id;
            }
        } else {
            $subject->class_id = $class->id;
        }

        if ($class->type == 'tertiary') {
            $subject->province_id = 0;
        } else {
            $province = Province::findOrFail(decrypt($request->province));
            $subject->province_id = $province->id;
        }
        $subject->name = $request->name;
        $subject->description = $request->description;

        // Upload Image
        if ($request->hasFile('image')) {
            $uuid = Str::uuid()->toString();
            $name = Str::slug($request->subject_name, '-') . '_' . $uuid   . '.' . $request->image->extension();
            $subject->image = $name;
            $request->image->move(public_path('subjects/images'),  $name);
        }
        $subject->update();

        // Save chapters
        $ids = [];
        foreach ($request->chapter as $chp) {
            if (isset($chapter['chapter_id'])) {
                $chapter = SubjectChapter::findOrFail(decrypt($chapter['chapter_id']));
            } else {
                $chapter = new SubjectChapter();
            }
            $chapter->name = $chp['name'];
            $chapter->slug = Str::slug($chp['name'], '-');
            $chapter->description = $chp['description'];
            $chapter->subject_id = $subject->id;
            $chapter->save();
            array_push($ids, $chapter->id);
        }

        // Clean up in remaing deleted chapters
        SubjectChapter::where('subject_id', $subject->id)->whereNotIn('id', $ids)->delete();

        return to_route('admin.class.details', $class->id)->withSuccess("Subject Has Been Updated Successfully");
    }
}
