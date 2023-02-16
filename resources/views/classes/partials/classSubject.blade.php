<div class="row">

    @if ($class->type == 'secondary' || $class->type == 'tertiary' || count($class->subClasses) > 0)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Manage Sub Classes
                </div>
                <div class="card-body">
                    <button class="btn btn-primary addSubClass mb-4">Add New</button>
                    @forelse ($class->subClasses as $sub)
                        <div class="row">
                            <div class="col"><strong>Class:</strong></div>
                            <div class="col">{{ $sub->name }}</div>
                            <div class="col">
                                <form action="{{ route('admin.classes.destroy', $sub->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                    @empty
                        <div class="row">
                            <div class="col">
                                You don't have any sub class yet!
                            </div>
                            {{-- <button class="btn btn-primary addSubClass">Add New</button> --}}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Manage Subjects
            </div>
            <div class="card-body">
                <a href="{{ route('subjects.create', $class->id) }}" class="btn btn-primary addSubject mb-3">Add
                    Subject</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th></th>
                            <th>Name</th>
                            <th>Chapters</th>
                            <th>{{ $class->type == 'tertiary' ? 'Sub Class' : 'Province' }}</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if (count($class->subClasses) > 0)
                                @foreach ($class->subClasses as $class)
                                    @foreach ($class->subjects as $subject)
                                        <tr>
                                            <td>
                                                <img class="img-table-sm" src="{{ $subject->image_path }}"
                                                    alt="image">
                                            </td>
                                            <td>
                                                {{ $class->name }} : {{ $subject->name }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ $subject->chapters->count() }} Chapters
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @foreach ($subject->chapters as $chapter)
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.topic.index', $chapter->id) }}">{{ $loop->index + 1 }}:{{ $chapter->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($class->parent && $class->parent->type == 'tertiary')
                                                    {{ $subject->myClass->name }}
                                                @else
                                                    {{ $subject->province->name }}
                                                @endif
                                            </td>

                                            <td>
                                                <form
                                                    action="{{ route('subjects.destroy', [$class->id, $subject->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('subjects.edit', [$class->id, $subject->id]) }}"
                                                        class="btn btn-sm" data-toggle="tooltip" title="Edit"><i
                                                            class="fa fa-edit text-primary"></i></a>
                                                    <button type="submit" class="btn btn-sm"><i
                                                            class="fa fa-trash text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                @forelse ($class->subjects as $subject)
                                    <tr>
                                        <td>
                                            <img class="img-table-sm" src="{{ $subject->image_path }}" alt="image">
                                        </td>
                                        <td>
                                            {{ $class->name }} : {{ $subject->name }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    {{ $subject->chapters->count() }} Chapters
                                                </button>
                                                <div class="dropdown-menu">
                                                    @foreach ($subject->chapters as $chapter)
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.topic.index', $chapter->id) }}">{{ $loop->index + 1 }}:{{ $chapter->name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $subject->province->name }}
                                        </td>
                                        <td>
                                            <form action="{{ route('subjects.destroy', [$class->id, $subject->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('subjects.edit', [$class->id, $subject->id]) }}"
                                                    class="btn btn-sm" data-toggle="tooltip" title="Edit"><i
                                                        class="fa fa-edit text-primary"></i></a>
                                                <button data-toggle="tooltip" title="Delete" type="submit"
                                                    class="btn btn-sm"><i class="fa fa-trash text-danger"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
