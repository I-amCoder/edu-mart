<div class="col-md-4">
    <h3>Check More Jobs</h3>
    <div class="list-group">
        @foreach ($paperCategories as $category)
            <a href="{{ route('front.pastpapers', ['category' => $category->name]) }}"
                class="list-group-item list-group-item-action flex-column align-items-start  @if ($category->papers->count() < 1) disabled @endif">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $category->name }}</h5>
                    <small>{{ $category->papers->count() }} jobs</small>
                </div>
                <p class="mb-1">{{ $category->description }}</p>
            </a>
        @endforeach
        </ul>
    </div>
</div>
