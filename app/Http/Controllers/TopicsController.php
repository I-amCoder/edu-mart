<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\SubjectChapter;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicsController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $uuid = Str::uuid()->toString();
            $name = 'file___' . $uuid . '.'  . $request->file->extension();
            // $request->file->move(public_path('topics/files'),  $name);
            return response()->json(['name' => $name], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapter)
    {
        $chapter = SubjectChapter::findOrFail($chapter);
        $subject = $chapter->subject;
        $class = $subject->myClass;
        return view('topics.index', compact('chapter', 'subject', 'class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($chapter)
    {
        $chapter = SubjectChapter::findOrFail($chapter);
        return view('topics.create', compact('chapter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $chapter)
    {
        $request->validate([
            'topic_name' => 'required',
            'description' => 'required'
        ]);

        // Custom Validation

        $chapter = SubjectChapter::findOrFail($chapter);

        $check = Topic::where(['chapter_id' => $chapter->id, 'name' => $request->topic_name])->count();
        if ($check > 0) {
            return redirect()->back()->withErrors(['topic_name' => 'Topic Name Must Be Unique in this chapter'])->withInput();
        }


        $topic = new Topic();
        $topic->name = $request->topic_name;
        $topic->slug = Str::slug($request->topic_name, '-');
        $topic->description = $request->description;
        $topic->chapter_id = $chapter->id;
        $topic->subject_id = $chapter->subject->id;


        if ($request->hasFile('topic_image')) {
            $uuid = Str::uuid()->toString();
            $name = $uuid . '_' . Str::slug($request->topic_name, '-') . '.' . $request->topic_image->extension();
            $topic->image = $name;
            $request->topic_image->move(public_path('topics/images'),  $name);
        }
        if ($request->hasFile('pdf_file')) {
            $uuid = Str::uuid()->toString();
            $file = $uuid . '_' . Str::slug($request->topic_name, '-') . '.' . $request->pdf_file->extension();
            $topic->file = $file;
            $request->pdf_file->move(public_path('topics/files'),  $file);
        }
        $topic->save();
        return to_route('admin.topic.index', $chapter->id)->withSuccess('Topic Has Been Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($chapter, $id)
    {
        $chapter = SubjectChapter::findOrFail($chapter);
        $topic = Topic::findOrFail($id);
        return view('topics.edit', compact('chapter', 'topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $chapter, $id)
    {
        $request->validate([
            'topic_name' => 'required',
            'description' => 'required'
        ]);

        // Custom Validation
        $chapter = SubjectChapter::findOrFail($chapter);

        $topic = Topic::findOrFail($id);
        $check = Topic::whereNot('id', $topic->id)->where(['chapter_id' => $chapter->id, 'name' => $request->topic_name])->count();
        if ($check > 0) {
            return redirect()->back()->withErrors(['topic_name' => 'Topic Name Must Be Unique in this chapter'])->withInput();
        }


        $topic->name = $request->topic_name;
        $topic->slug = Str::slug($request->topic_name, '-');
        $topic->description = $request->description;
        $topic->chapter_id = $chapter->id;
        $topic->subject_id = $chapter->subject->id;


        if ($request->hasFile('topic_image')) {
            $uuid = Str::uuid()->toString();
            $name = $uuid . '_' . Str::slug($request->topic_name, '-') . '.' . $request->topic_image->extension();
            $topic->image = $name;
            $request->topic_image->move(public_path('topics/images'),  $name);
        }
        if ($request->hasFile('pdf_file')) {
            $uuid = Str::uuid()->toString();
            $file = $uuid . '_' . Str::slug($request->topic_name, '-') . '.' . $request->pdf_file->extension();
            $topic->file = $file;
            $request->pdf_file->move(public_path('topics/files'),  $file);
        }
        $topic->save();
        return to_route('admin.topic.index', $chapter->id)->withSuccess('Topic Has Been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($board, $class, $topic)
    {
        $topic = Topic::findOrFail($topic);
        $topic->delete();
        return redirect()->back()->withSuccess('Topic Has Been Deleted Successfully');
    }
}
