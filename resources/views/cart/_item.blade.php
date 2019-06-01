<div class="col-md-4" data-item-id="{{ $item->getKey() }}">
    <div class="card mb-4 shadow-sm product-item">
        <div class="product-controls">
            <div class="btn-group bg-light rounded">
               <cart-remove-button item-id="{{ $item->getKey() }}"></cart-remove-button>
            </div>
        </div>
        @if($item->product->cover)
            <img src="{{ asset($item->product->cover) }}" alt="{{ $item->product->title }}" class="bg-placeholder-img card-img-top">
        @endif
        <div class="card-body">
            <a href="{{ route('products.show', $item->product) }}" class="card-link">
                {{ $item->product->title }}
            </a>
            <small class="text-muted">
                {{ $item->product->category->title }}
            </small>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span class="price">
                    <b>{{ price($item->product->price) }}</b> $
                </span>

                <cart-item-count item-id="{{ $item->getKey() }}" item-count="{{ $item->count }}"></cart-item-count>
            </div>
        </div>
    </div>
</div>