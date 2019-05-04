<div class="review-reply">
    <div class="card ml-5 mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                {{ $child->user->full_name }}
            </div>
            <p class="card-text">{{ $child->created_at->diffForHumans() }}</p>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $child->text }}</p>
        </div>
        <div class="card-footer text-muted d-flex justify-content-between align-items-center">
            <div class="review-controls">
                <a href="#" class="btn btn-sm btn-link" data-parent-id="{{ $parent->id }}">
                    <i class="fas fa-reply"></i> Reply
                </a>
            </div>
            <div class="review-rating">
                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-thumbs-up"></i></a>
                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-thumbs-down"></i></a>
            </div>
        </div>
    </div>
</div>

@foreach($child->children as $item)
    @include('reivews.child_review', ['parent' => $child, 'child' => $item])
@endforeach