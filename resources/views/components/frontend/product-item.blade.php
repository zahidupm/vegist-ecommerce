@props(['product'])
<div class="tred-pro">
    <div class="tr-pro-img">
        <a href="{{ route('front.shop.single', $product->slug) }}">
            <img class="img-fluid"
                src="{{ count($product->gallery) > 0 ? getAssetUrl($product->gallery[0]->name, 'uploads/products') : '' }}"
                alt="{{ $product->title }}">
            <img class="img-fluid additional-image"
                src="{{ count($product->gallery) > 1 ? getAssetUrl($product->gallery[1]->name, 'uploads/products') : '' }}"
                alt="{{ $product->title }}">
        </a>
    </div>
    {!! productLabel($product) !!}
    <div class="pro-icn">
        <a href="wishlist.html" class="w-c-q-icn"><i class="fa fa-heart"></i></a>
        <a href="javascript:addToCart({{ $product->id }}, 1)" class="w-c-q-icn add-to-cart-btn"><i
                class="fa fa-shopping-bag"></i></a>
        <a href="javascript:void(0)" class="w-c-q-icn" data-bs-toggle="modal" data-bs-target="#product-quickview-modal"
            data-product="{{ $product->slug }}"><i class="fa fa-eye"></i></a>
    </div>
</div>
<div class="caption">
    <h3><a href="{{ route('front.shop.single', $product->slug) }}">{{ $product->title }}</a>
    </h3>
    <div class="rating">
        <i class="fa fa-star c-star"></i>
        <i class="fa fa-star c-star"></i>
        <i class="fa fa-star c-star"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
    </div>
    <div class="pro-price">
        <span class="new-price">${{ number_format($product->price, 2) }} USD</span>
    </div>
</div>


{{-- @push('js')
    <script>
        $(document).ready(function() {
                    cartload();
                    // Add To cart via cookie
                    $('.add-to-cart-btn').click(function(e) {
                        e.preventDefault();

                        var product_id = $(this).closest('.product_data').find('.product_id').val();
                        var quantity = $(this).closest('.product_data').find('.quantity').val();


                        $.ajax({
                            url: '{{ route('front.cart.store') }}',
                            method: "POST",
                            data: {
                                'quantity': quantity,
                                'product_id': product_id,
                            },
                            success: function(response) {
                                console.log(response);
                                toast(response.message);
                                cartload();
                            },
                        });
                    });

                    function cartload() {
                        $.ajax({
                            url: '{{ route('front.cart.load') }}',
                            method: "GET",
                            success: function(response) {
                                console.log(response);
                                $('.bigcounter').html(response.totalcart);
                                $('.cart-item-loop').html(response.html);
                                $('.subtotal-price').html(response.subtotal);
                            }
                        });
                    });
    </script>
@endpush --}}
