<?php

namespace App\Http\Controllers;

use App\Models\PastPaper;
use App\Models\PastPaperCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PastPaperController extends Controller
{
    public function storeCategory(Request $request)
    {
        $request->validate([
            'topic_name' => 'required|string',
        ]);
        if ($request->topic_id) {
            $category = PastPaperCategory::findOrFail($request->topic_id);
        } else {
            $category = new PastPaperCategory();
        }
        $category->name = $request->topic_name;
        $category->save();
        return back()->withSuccess("Topic Saved Successfully");
    }

    public function deleteCategory($id)
    {
        PastPaperCategory::where('id', $id)->delete();
        return back()->withSuccess("Category Deleted Successfully");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PastPaperCategory::all();
        $papers = PastPaper::all();
        return view('pastpapers.index', compact('categories', 'papers'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PastPaperCategory::all();
        return view('pastpapers.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PastPaper $paper)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required|string',
            'description' => 'required',
            'file' => 'required|mimes:pdf'
        ]);
        $category = PastPaperCategory::findOrFail(decrypt($request->category));
        $paper->name = $request->name;
        $paper->past_paper_category_id = $category->id;
        $paper->description = $request->description;
        if ($request->hasFile('file')) {
            $uuid = Str::uuid()->toString();
            $name = $paper->name . ' ' . $uuid . '.' . $request->file->extension();
            $paper->file = $name;
            $request->file->move(public_path('files/pastpaper'),  $name);
        }
        $paper->save();
        return to_route("past-papers.index")->withSuccess('Paper Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paper = PastPaper::findOrFail($id);
        $categories = PastPaperCategory::all();
        return view('pastpapers.edit', compact('paper', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hash)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required|string',
            'description' => 'required',
            // 'file' => 'required|mimes:pdf'
        ]);
        $paper = PastPaper::findOrFail(decrypt($hash));
        $category = PastPaperCategory::findOrFail(decrypt($request->category));
        $paper->name = $request->name;
        $paper->past_paper_category_id = $category->id;
        $paper->description = $request->description;
        if ($request->hasFile('file')) {
            $uuid = Str::uuid()->toString();
            $name = $paper->name . ' ' . $uuid . '.' . $request->file->extension();
            $paper->file = $name;
            $request->file->move(public_path('files/pastpaper'),  $name);
        }
        $paper->update();
        return to_route("past-papers.index")->withSuccess('Paper Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PastPaper::where('id', $id)->delete();
        return back()->with('success', 'Category Deleted Successfully');
    }
}
