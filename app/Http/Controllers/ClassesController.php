<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Province;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::where('parent_id', 0)->get();
        $provinces = Province::all();
        return view('classes.index', compact('classes', 'provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required | string ',
            'class_description' => 'required | string',

        ]);
        if ($request->class_id) {
            $class = Classes::findOrFail($request->class_id);
        } else {
            $request->validate([
                'class_name' => 'unique:classes,name'
            ]);
            $class = new Classes();
        }
        if ($request->has('parent_id')) {
            $parent = Classes::findOrFail(decrypt($request->parent_id));
            $class->parent_id = $parent->id;
        }
        if ($request->has('class_type')) {
            $class->type = $request->class_type;
        }
        $class->name = $request->class_name;
        $class->description = $request->class_description;
        $class->save();
        $message = "Class Has Been " . ($request->class_id ? "Updated" : "Created") . " Successfully";
        return redirect()->back()->withSuccess($message);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();
        return redirect()->back()->withSuccess("Class Has Been Deleted");
    }

    public function classDetail($class)
    {
        $class = Classes::findOrFail($class);
        $provinces = Province::all();
        $topics = Topic::all();
        return view('classes.detail', compact('class', 'provinces', 'topics'));
    }


    public function addSubject(Request $request)
    {

        $request->validate([
            'subject_name' => 'required |string',
            'subject_description' => 'required |string',
            'subject_image' => 'required ',
            'board' => 'required'
        ]);

        $class = Classes::findOrFail($request->class_id);
        $board = Board::findOrFail($request->board);
        if ($class->type == 'secondary') {
            if ($request->has('sub_class_id')) {

                $class = Classes::findOrFail($request->sub_class_id);
            } else {
                return redirect()->back()->withErrors(['sub_class_id' => 'Subclass is required']);
            }
        }

        if ($request->subject_id) {
            $subject = Subject::findOrFail($request->subject_id);
        } else {
            $subject = new Subject();
        }
        if ($request->hasFile('subject_image')) {
            $uuid = Str::uuid()->toString();
            $name = $uuid . '_' . Str::slug($request->subject_name, '-') . '.' . $request->subject_image->extension();
            $subject->image = $name;
            $request->subject_image->move(public_path('subjects/images'),  $name);
        }
        $subject->name = $request->subject_name;
        $subject->description = $request->subject_description;
        $subject->class_id = $class->id;
        $subject->board_id = $board->id;
        $subject->chapters = $request->subject_chapters;
        $subject->save();
        $message = "Subject Has Been " . ($request->class_id ? "Updated" : "Created") . " Successfully";
        return redirect()->back()->withSuccess($message);
    }

    public function deleteSubject($subject)
    {
        $subject = Subject::findOrFail($subject);
        $subject->delete();
        return redirect()->back()->withSuccess('Subject Deleted Successfully');
    }
}
