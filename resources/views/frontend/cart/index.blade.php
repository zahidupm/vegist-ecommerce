@extends('frontend.layouts.master')

@section('title', 'Cart')

@section('content')

    <x-frontend.breadcrumb title="Cart" />

    @php $total = null @endphp

    <section class="cart-page section-tb-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <div class="cart-area">
                        <div class="cart-details">
                            <div class="cart-item">
                                <span class="cart-head">My cart:</span>
                                <span class="c-items">{{ count($carts) }} {{ count($carts) > 1 ? 'items' : 'item' }}</span>
                            </div>
                        </div>
                    </div>
                    @forelse($carts as $cart)
                        @if (Cookie::get('shopping_cart'))
                            @php $total += ($cart->item_price * $cart->item_quantity) @endphp
                        @endif
                        <div class="cart-area">
                            <div class="cart-details">
                                <div class="cart-all-pro">
                                    <div class="cart-pro">
                                        <div class="cart-pro-image">
                                            <a href="{{ route('front.shop.single', $cart->item_slug) }}"><img
                                                    src="{{ getAssetUrl($cart->item_image) }}" class="img-fluid"
                                                    style="width:80px" alt="{{ $cart->item_slug }}"></a>
                                        </div>
                                        <div class="pro-details">
                                            <h4><a
                                                    href="{{ route('front.shop.single', $cart->item_slug) }}">{{ $cart->item_name }}</a>
                                            </h4>
                                            <span class="cart-pro-price">${{ number_format($cart->item_price, 2) }}
                                                USD</span>
                                        </div>
                                    </div>
                                    <div class="qty-item">
                                        <div class="center">
                                            <div class="plus-minus">
                                                <span>
                                                    <a href="javascript:void(0)" data-id={{ $cart->item_id }}
                                                        class="minus-btn text-black">-</a>

                                                    <input type="text" class="quantity" name="name"
                                                        value="{{ $cart->item_quantity }}">

                                                    <a href="javascript:void(0)" data-id="{{ $cart->item_id }}"
                                                        class="plus-btn text-black">+</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="all-pro-price">
                                        <span
                                            class="item-total">${{ number_format($cart->item_price * $cart->item_quantity, 2) }}
                                            USD</span>
                                        <span class="ms-3"><a href="javascript:void(0)" class="text-danger"><i
                                                    class="fa fa-remove"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-left">No Item Found!</div>
                    @endforelse

                </div>
                {{-- <div class="col-xl-3 col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="cart-total">
                        <div class="cart-price">
                            <span>Subtotal</span>
                            <span class="total">${{ $total ? number_format($total, 2) : 0 }} USD</span>
                        </div>
                        <div class="cart-price">
                            <span class="">Dicount</span>
                            <span class="discount">$0.00 USD</span>
                        </div>
                        <div class="shop-total">
                            <span>Total</span>
                            <span class="total-amount">${{ $total ? number_format($total, 2) : 0 }} USD</span>
                        </div>
                        <a href="javascript:void(0)" class="check-link btn btn-style1">Checkout</a>
                    </div>
                </div> --}}

                <div class="col-xl-3 col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="cart-total">
                        <div class="cart-price">
                            <span>Subtotal</span>
                            <span class="total">${{ $total ? number_format($total, 2) : 0 }} USD</span>
                        </div>
                        <div class="cart-price">
                            <span>Discount</span>
                            <span class="discount">$0.00 USD</span>
                        </div>

                        <div class="shop-total">
                            <span>Total</span>
                            <span class="total-amount">${{ $total ? number_format($total, 2) : 0 }} USD</span>
                        </div>
                        <a href="javascript:voic(0)" class="check-link btn btn-style1">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).on('click', '.minus-btn', function(e) {
            e.preventDefault();
            const el = $(this).closest('.cart-area');
            const product_id = $(this).data('id');
            updateCart('minus', el, product_id);
        });


        $(document).on('click', '.plus-btn', function(e) {
            e.preventDefault();
            const el = $(this).closest('.cart-area');
            const product_id = $(this).data('id');
            updateCart('plus', el, product_id);
        });

        function updateCart(method, el, product_id) {

            // Item details
            // const quantity = el.find('.quantity').val();
            var quantity = el.find('.quantity').val();
            const price = parseFloat(el.find('.cart-pro-price').html().replace(
                /[^0-9.-]+/g, ""));

            const itemTotal = quantity * price;

            const itemTotalString = '$' + itemTotal.toLocaleString('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2
            });

            // Main Total
            // const total = $('span.total').text();
            // const oldTotalValue = parseFloat(total.replace(/[^0-9.-]+/g, ""));
            // // Discount
            // const discount = parseFloat($('.discount').text().replace(/[^0-9.-]+/g, ""));

            // // Sum
            // if (method == 'minus') {
            //     let sum = oldTotalValue - price;
            // }
            // if (method == 'plus') {
            //     let sum = oldTotalValue + price;
            //     console.log(sum);
            // }

            // const sumWithDiscount = sum - discount;

            // Main Total
            var total = $('span.total').text();
            var oldTotalValue = parseFloat(total.replace(/[^0-9.-]+/g, ""));
            // Discount
            var discount = parseFloat($('.discount').text().replace(/[^0-9.-]+/g, ""));
            // Sum
            if (method == 'minus') {
                var sum = oldTotalValue - price;
            }
            if (method == 'plus') {
                var sum = oldTotalValue + price;
            }
            var sumWithDiscount = sum - discount;

            // Format the sum as a currency amount string
            const sumString = '$' + sum.toLocaleString('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2
            }) + " USD";

            const sumWithDiscountString = '$' + sumWithDiscount.toLocaleString('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2
            }) + " USD";

            // Update data
            el.find('span.item-total').html(itemTotalString);
            $('span.total').html(sumString);
            $('span.total-amount').html(sumWithDiscountString);

            // Ajax
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
        }
    </script>
@endpush
