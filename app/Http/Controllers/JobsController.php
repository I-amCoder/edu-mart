<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\JobsBlog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class JobsController extends Controller
{

    public function saveJobCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
        ]);
        if ($request->category_id) {
            $category = JobCategory::findOrFail(decrypt($request->category_id));
            $check = JobCategory::whereNot('id', $category->id)->where(['name' => $request->name])->count();
            if ($check > 0) {
                return back()->withErrors(['name' => 'Category Name is Already Take'])->withInput();
            }
        } else {
            $request->validate([
                'name' => 'unique:job_categories,name'
            ]);
            $category = new JobCategory();
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return back()->withSuccess('Category Has Been ' . ($request->category_id ? "Updated" : "saved"));
    }


    public function deleteJobCategory($hash)
    {
        $category = JobCategory::findOrFail(decrypt($hash));
        $category->delete();
        return back()->withSuccess('Category Has Been Deleted');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = JobCategory::all();
        $posts = JobsBlog::all();
        return view('jobs.index', compact('categories', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = JobCategory::all();
        return view('jobs.create', compact('categories'));
    }

    // Upload Summernote Image
    public function imageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $name = Str::uuid()->toString() . '.' . $request->image->extension();
            $request->image->move(public_path('jobs/images/blog'),  $name);
            return response()->json(url('jobs/images/blog/' . $name), 200);
        }
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
            'title' => 'required|unique:jobs_blogs,title',
            'image' => 'required|mimes:png,jpg,jpeg,',
            'category' => 'required',
            'description' => 'required',
            'job_location' => 'required',
            'job_type' => 'required',
            'published_date' => 'required',
            'last_apply_date' => 'required',
            'newspaper_name' => 'required',
        ]);
        $slug = Str::slug($request->title, '-');
        $job = new JobsBlog();
        $job->title = $request->title;
        $job->job_location = $request->job_location;
        $job->job_type = $request->job_type;
        $job->newspaper_name = $request->newspaper_name;
        $job->published_date = $request->published_date;
        $job->last_apply_date = $request->last_apply_date;
        if ($request->apply_link) {
            $job->apply_link = $request->apply_link;
        }
        $job->slug = $slug;
        $job->description = json_encode($request->description);
        $job->job_category_id = decrypt($request->category);

        // Upload Image
        if ($request->hasFile('image')) {
            $name = $slug . '.' . $request->image->extension();
            $job->image = $name;
            $request->image->move(public_path('jobs/images'),  $name);
        }
        if ($request->hasFile('pdf_english')) {
            $uuid = Str::uuid()->toString();
            $name = $slug . '_' . $uuid . '.' . $request->pdf_english->extension();
            $job->pdf_english = $name;
            $request->pdf_english->move(public_path('jobs/files'),  $name);
        }
        if ($request->hasFile('pdf_urdu')) {
            $uuid = Str::uuid()->toString();
            $name = $slug . '_' . $uuid . '.' . $request->pdf_urdu->extension();
            $job->pdf_urdu = $name;
            $request->pdf_urdu->move(public_path('jobs/files'),  $name);
        }


        $job->save();

        return to_route('admin.job-blog.index')->withSuccess("Job Post Created Successfully");
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
        $job = JobsBlog::findOrFail(decrypt($id));
        $categories = JobCategory::all();
        return view('jobs.edit', compact('job', 'categories'));
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
        // Let's Validate
        $request->validate([
            'title' => 'required|unique:jobs_blogs,title,' . decrypt($id),
            'category' => 'required',
            'description' => 'required'
        ]);

        // Proceed To Update
        $slug =  Str::slug($request->title, '-');
        $job = JobsBlog::findOrFail(decrypt($id));
        $job->title = $request->title;
        if ($request->apply_link) {
            $job->apply_link = $request->apply_link;
        }
        $job->slug = $slug;
        $job->description = json_encode($request->description);

        // Upload Image
        if ($request->hasFile('image')) {
            // First Delete Old Image
            $file = public_path() . 'jobs/images/' . $job->image;
            File::delete($file);

            // Now Upload New Image If It has
            $name = $slug . '.' . $request->image->extension();
            $job->image = $name;
            $job->job_category_id = decrypt($request->category);
            $request->image->move(public_path('jobs/images'),  $name);
        }
        $job->update();

        return to_route('admin.job-blog.index')->withSuccess("Job Post Updated Successfully");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = JobsBlog::findOrFail(decrypt($id));
        $job->delete();
        return back()->withSuccess('Job Pos Has Been Deleted Successfully');
    }
}
