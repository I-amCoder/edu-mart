<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Classes;
use App\Models\JobCategory;
use App\Models\JobsBlog;
use App\Models\PastPaper;
use App\Models\PastPaperCategory;
use App\Models\Province;
use App\Models\SubClasses;
use App\Models\Subject;
use App\Models\SubjectChapter;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Mockery\Matcher\Subset;
use PhpParser\Builder\Class_;

class FrontEndController extends Controller
{
    public function index()
    {
        $primary = Classes::where('type', 'primary')->get();
        $secondary = Classes::where('type', 'secondary')->get();
        $jobCategories = JobCategory::all();
        return view('welcome', compact('primary', 'jobCategories', 'secondary'));
    }

    public function class($class)
    {
        $provinces = Province::all();
        $class = Classes::where('name', $class)->firstOrFail();

        return view('frontend.accordion', compact('provinces', 'class'));
    }

    public function subject(Request $request)
    {
        $class = Classes::where('name', $request->class)->firstOrFail();
        $province = null;
        if ($request->board) {
            $province = Province::where('name', $request->board)->firstOrFail();
        }
        $subject = Subject::where(['class_id' => $class->id, 'province_id' => $province ? $province->id : 0])->firstOrFail();
        return view('frontend.subject', compact('class',  'province', 'subject'));
    }



    public function chapter(Request $request)
    {
        $province = null;
        $class = Classes::where('name', $request->class)->firstOrFail();
        if ($request->board) {
            $province = Province::where('name', $request->board)->firstOrFail();
        }
        $chapter = SubjectChapter::where('slug', $request->chapter)->firstOrFail();
        return view('frontend.chapter', compact('class', 'chapter', 'province'));
    }

    public function topic($board, $class, $topic)
    {
        $topic = Topic::where('slug', $topic)->firstOrFail();
        return view('frontend.note', compact('topic'));
    }





    public function pastPapers(Request $request)
    {
        $currentCategory = null;
        if ($request->has('category')) {
            $currentCategory = PastPaperCategory::where('name', $request->category)->firstOrFail();
            $papers = PastPaper::where('past_paper_category_id', $currentCategory->id)->paginate(10);
        } else {
            $papers = PastPaper::paginate(10);
        }
        $paperCategories = PastPaperCategory::all();
        return view('frontend.papers', compact('papers', 'currentCategory', 'paperCategories'));
    }


    public function showAllJobs(Request $request)
    {
        $currentCategory = null;
        if ($request->has('category')) {
            $currentCategory = JobCategory::where('name', $request->category)->firstOrFail();
            $jobs = JobsBlog::where('job_category_id', $currentCategory->id)->paginate(10);
        } else {
            $jobs = JobsBlog::paginate(5);
        }
        $jobCategories = JobCategory::all();
        return view('frontend.jobs', compact('jobs', 'jobCategories', 'currentCategory'));
    }

    public function showJob($slug)
    {
        $job = JobsBlog::where('slug', $slug)->firstOrFail();
        $jobCategories = JobCategory::all();
        return view('frontend.job', compact('job', 'jobCategories'));
    }


    // Downloads
    public function downloadJobPdf($id, $type = 'english')
    {
        $job = JobsBlog::where('id', $id)->firstOrFail();
        $file = public_path() . '/jobs/files/' . $job['pdf_' . $type];
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, ($job->title . " - " . $type . '.pdf'), $headers);
    }

    public function downloadPdf($slug)
    {
        $topic = Topic::where('slug', $slug)->firstOrFail();
        $file = public_path() . '/topics/files/' . $topic->file;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, ($topic->name . " - " . $topic->description . '.pdf'), $headers);
    }

    public function downloadPaper($id)
    {
        $paper = PastPaper::findOrFail($id);
        $file = public_path() . '/files/pastpaper/' . $paper->file;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, ($paper->name . " - " . $paper->description . '.pdf'), $headers);
    }
}
