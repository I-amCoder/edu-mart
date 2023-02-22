<form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="site_name">Site Name</label>
            <input type="text" value="{{ $settings->site_name }}" name="site_name" id="site_name"
                class="form-control shadow  @error('site_name') is-invalid @enderror" required>
            @error('site_name')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="whatsapp_no">Whatsapp No.</label>
            <input type="text" value="{{ $settings->whatsapp_no }}" name="whatsapp_no" id="whatsapp_no"
                class="form-control shadow @error('whatsapp_no') is-invalid @enderror" required>
            @error('whatsapp_no')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="meta_title">Meta Title</label>
            <input type="text" value="{{ $settings->meta_title }}" name="meta_title" id="meta_title"
                class="form-control shadow @error('meta_title') is-invalid @enderror" required>
            @error('meta_title')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="meta_description">Meta Description</label>
            <input type="text" value="{{ $settings->meta_description }}" name="meta_description"
                id="meta_description" class="form-control shadow @error('meta_description') is-invalid @enderror"
                required>
            @error('meta_description')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="site_name">Copyright Text</label>
            <input type="text" value="{{ $settings->copyright_text }}" name="copyright_text" id="copyright_text"
                class="form-control shadow @error('copyright_text') is-invalid @enderror" required>
            @error('copyright_text')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="meta_keywords">Meta Keywords (Comma seprated)</label>
            <input type="text" value="{{ $settings->keywords }}" name="meta_keywords" id="meta_keywords"
                class="form-control shadow @error('meta_keywords') is-invalid @enderror" required>
            @error('meta_keywords')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
    </div>
    <hr>
    <h3>Images</h3>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="logo">Logo</label>
            <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                    <img src="{{ $settings->logo_path }}" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists img-thumbnail"
                    style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                            image</span><span class="fileinput-exists">Change</span><input type="file"
                            name="logo"></span>
                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                        data-dismiss="fileinput">Remove</a>
                </div>
                @error('logo')
                    <span role="alert">
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="favicon">Favicon</label>
            <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                    <img src="{{ $settings->favicon_path }}" style="width: 100%" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists img-thumbnail"
                    style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                            image</span><span class="fileinput-exists">Change</span><input type="file"
                            name="favicon"></span>
                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                        data-dismiss="fileinput">Remove</a>
                </div>

                @error('favicon')
                    <span role="alert">
                        <strong class="text-danger">
                            {{ $message }}
                        </strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <hr>
    <h3>Social Links</h3>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="facebook_link">Facebook</label>
            <input type="text" value="{{ $settings->facebook_link }}" name="facebook_link" id="facebook_link"
                class="form-control shadow @error('facebook_link') is-invalid @enderror">
            <small class="form-text text-muted">Optional</small>
            @error('facebook_link')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="twitter_link">Twitter</label>
            <input type="text" value="{{ $settings->twitter_link }}" name="twitter_link" id="twitter_link"
                class="form-control shadow @error('twitter_link') is-invalid @enderror">
            <small class="form-text text-muted">Optional</small>
            @error('twitter_link')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="instagram_link">Instagram</label>
            <input type="text" value="{{ $settings->instagram_link }}" name="instagram_link" id="instagram_link"
                class="form-control shadow @error('instagram_link') is-invalid @enderror">
            <small class="form-text text-muted">Optional</small>
            @error('instagram_link')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="youtube_link">Youtube</label>
            <input type="text" value="{{ $settings->youtube_link }}" name="youtube_link" id="youtube_link"
                class="form-control shadow @error('youtube_link') is-invalid @enderror">
            <small class="form-text text-muted">Optional</small>
            @error('youtube_link')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="linkedin_link">LinkedIn</label>
            <input type="text" value="{{ $settings->linkedin_link }}" name="linkedin_link" id="linkedin_link"
                class="form-control shadow @error('linkedin_link') is-invalid @enderror">
            <small class="form-text text-muted">Optional</small>
            @error('linkedin_link')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="pinterest_link">Pinterest</label>
            <input type="text" value="{{ $settings->pinterest_link }}" name="pinterest_link" id="pinterest_link"
                class="form-control shadow @error('pinterest_link') is-invalid @enderror">
            <small class="form-text text-muted">Optional</small>
            @error('pinterest_link')
                <span role="alert">
                    <strong class="text-danger">
                        {{ $message }}
                    </strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-5">
        <div class="col">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</form>
