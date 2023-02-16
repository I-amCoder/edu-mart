<div class="modal fade" id="addSubClassModal" tabindex="-1" role="dialog" aria-labelledby="addSubClassModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubClassModalTitle">Add Sub Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.classes.store') }}" method="POST" id="add-sub-class-form">
                    @csrf
                    <input required type="hidden" name="parent_id" value="{{ encrypt($class->id) }}" />
                    <input type="hidden" name="class_id">
                    <div class="form-group row mb-4">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text"
                                class="form-control @error('class_name') is-invalid @enderror" name="class_name"
                                placeholder="E.g 10th">
                            @error('class_name')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <div class="col">
                            <label for="name" class="form-label">Description</label>
                            <input required type="text"
                                class="form-control @error('class_description') is-invalid @enderror"
                                name="class_description" placeholder="A Small Descripion About Class">
                            @error('class_description')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="document.getElementById('add-sub-class-form').submit()"
                    class="btn btn-primary">Save / Update Class</button>
            </div>
        </div>
    </div>
</div>
