<div class="col-md-4" data-product-item-id="{{ $product->id }}">
    <div class="card mb-4 shadow-sm product-item">
        <div class="product-controls">
            <div class="btn-group bg-light rounded">
                <bookmark-button product-id="{{ $product->id }}"
                                 :status="@bool($product->hasBookmark())"
                                 :remove="@bool(isset($bookmark))"></bookmark-button>
            </div>
        </div>
        @if($product->cover)
            <img src="{{ asset($product->cover) }}" alt="{{ $product->title }}" class="bg-placeholder-img card-img-top">
        @endif
        <div class="card-body">
            <a href="{{ route('products.show', $product) }}" class="card-link">
                {{ $product->title }}
            </a>
            <small class="text-muted">
                {{ $product->category->title }}
            </small>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span class="price">
                    <b>{{ price($product->price) }}</b> $
                </span>

                <button type="button" class="btn btn-sm btn-success">
                    <i class="fas fa-shopping-cart"></i> <span class="buy-text">Buy</span>
                </button>
            </div>
        </div>
    </div>
</div>