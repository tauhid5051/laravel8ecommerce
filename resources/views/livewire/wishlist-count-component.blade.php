<div class="wrap-icon-section wishlist">
    <a href="{{route('product.wishlist')}}" class="link-direction">
        <i class="fa fa-heart" aria-hidden="true"></i>
        <div class="left-info">
            @if (Cart::instance('wishlist')->count() > 0)

            @endif
            <span class="index">{{Cart::instance('wishlist')->count()}} item</span>
            <span class="title">Wishlist</span>
        </div>
    </a>
</div>
