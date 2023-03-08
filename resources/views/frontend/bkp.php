 <div class="container">

     <div class="row top_headings">
         <div class="col-7 py-3">
             <h6>{{ $job->title }}</h6>
         </div>
     </div>
     <div class="row">
         <div class="col-1 py-3 jobdetail_headings">
             <h5>Sr No.</h5>
         </div>
         <div class="col-3 py-3 jobdetail_headings">
             <h5>Title</h5>
         </div>
         <div class="col-3 py-3 jobdetail_headings">
             <h5>Details</h5>
         </div>
     </div>
     <div class="row ">
         <div class="col-1 py-3 jobdetail_data1">
             <h6>1</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data1">
             <h6>Job Location</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data1">
             <h6>{{ $job->job_location }}</h6>
         </div>
     </div>
     <div class="row">
         <div class="col-1 py-3 jobdetail_data2">
             <h6>2</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data2">
             <h6>Job Type</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data2">
             <h6>{{ $job->job_type }}</h6>
         </div>
     </div>
     <div class="row">
         <div class="col-1 py-3 jobdetail_data1">
             <h6>3</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data1">
             <h6>Published Date</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data1">
             <h6>{{ \Carbon\Carbon::parse($job->published_date)->format('d-F-Y l') }}</h6>
         </div>
     </div>
     <div class="row">
         <div class="col-1 py-3 jobdetail_data2">
             <h6>4</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data2">
             <h6>Last Date to Apply</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data2">
             <h6>{{ \Carbon\Carbon::parse($job->last_apply_date)->format('d-F-Y l') }}</h6>
         </div>
     </div>
     <div class="row">
         <div class="col-1 py-3 jobdetail_data1">
             <h6>5</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data1">
             <h6>Newspaper Name</h6>
         </div>
         <div class="col-3 py-3 jobdetail_data1">
             <h6>{{ $job->newspaper_name }}</h6>
         </div>
     </div>
 </div>