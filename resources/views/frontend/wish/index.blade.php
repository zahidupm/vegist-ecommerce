 @extends('frontend.layouts.master')

 @section('title', 'Wish')

 @section('content')
     <x-frontend.breadcrumb title="Wish" />

     <section class="wishlist-page section-tb-padding">
         <div class="container">
             <div class="row">
                 <div class="col">
                     <div class="wishlist-area">
                         <div class="wishlist-details">
                             <div class="wishlist-item">
                                 <span class="wishlist-head">My wishlist:</span>
                                 <span class="wishlist-items">{{ count($wishes) }}
                                     {{ count($wishes) > 1 ? 'items' : 'item' }}</span>
                             </div>
                         </div>
                     </div>
                     @forelse ($wishes as $wish)
                         {{-- {{ dd($wishes) }} --}}
                         @if (Cookie::get('shopping_wish'))
                         @endif
                         <div class="wishlist-area product_data">
                             <div class="wishlist-details">
                                 <div class="wishlist-all-pro">
                                     <div class="wishlist-pro">
                                         <div class="wishlist-pro-image">
                                             <a href="{{ route('front.shop.single', $wish->item_slug) }}"><img
                                                     src="{{ getAssetUrl($wish->item_image) }}" class="img-fluid"
                                                     style="width:80px" alt="{{ $wish->item_slug }}"></a>
                                         </div>
                                         <div class="pro-details">
                                             <h4><a
                                                     href="{{ route('front.shop.single', $wish->item_slug) }}">{{ $wish->item_name }}</a>
                                             </h4>
                                             <span class="wishlist-text">Multiwebinfo</span>
                                         </div>
                                     </div>

                                     <div class="pro-qty d-none">
                                         <span class="qty">Quantity:</span>
                                         <div class="plus-minus">
                                             <span>
                                                 <a href="javascript:void(0)" class="minus-btn text-black">-</a>
                                                 <input type="text" name="quantity" class="quantity hidden"
                                                     value="{{ $wish->item_quantity }}">
                                                 <a href="javascript:void(0)" class="plus-btn text-black hidden">+</a>
                                             </span>
                                         </div>
                                     </div>


                                     <div class="pro-btn">
                                         <input type="hidden" class="product_id" name="product_id"
                                             value="{{ $wish->item_id }}">
                                         <a href="javascript::void(0)" class="btn btn-style1 add-to-cart-btn"><span><i
                                                     class="fa fa-shopping-bag"></i> Add
                                                 to cart</span></a>
                                         <span class="ms-3"><a href="javascript:void(0)" data-id="{{ $wish->item_id }}"
                                                 class="text-danger remove-wish-item"><i
                                                     class="fa fa-remove"></i></a></span>
                                     </div>

                                     {{-- <div class="qty-item">
                                         <a href="javascript:void(0)" class="add-wishlist add-to-cart-btn">Add to cart</a>
                                         <a href="checkout-1.html" class="add-wishlist">Buy now</a>
                                     </div> --}}
                                     <div class="all-pro-price">
                                         <span
                                             class="new-price">${{ number_format($wish->item_price * $wish->item_quantity) }}
                                             USD</span>
                                         <span class="old-price"><del>$400.00 USD</del></span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @empty
                         <section class="empty-area section-1tb-padding">
                             <div class="container">
                                 <div class="row">
                                     <div class="col">
                                         <div class="empty-start">
                                             <h2 class="empty-title">
                                                 <span>Your</span>
                                                 <span class="color-text">wishlist</span><br>
                                                 <span>is currently</span>
                                                 <span class="color-text">empty!</span>
                                             </h2>
                                             <span class="empty-more">Continue browsing <a
                                                     href="grid-list.html">here</a></span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </section>
                     @endforelse
                 </div>
             </div>
         </div>
     </section>
     <!-- wishlist end -->
     <!-- footer start -->
     <section class="footer-one section-tb-padding">
         <div class="container">
             <div class="row">
                 <div class="col">
                     <div class="footer-service section-b-padding">
                         <ul class="service-ul">
                             <li class="service-li">
                                 <a href="javascript:void(0)"><i class="fa fa-truck"></i></a>
                                 <span>Free delivery</span>
                             </li>
                             <li class="service-li">
                                 <a href="javascript:void(0)"><i class="fa fa-rupee"></i></a>
                                 <span>Cash on delivery</span>
                             </li>
                             <li class="service-li">
                                 <a href="javascript:void(0)"><i class="fa fa-refresh"></i></a>
                                 <span>30 Days returns</span>
                             </li>
                             <li class="service-li">
                                 <a href="javascript:void(0)"><i class="fa fa-headphones"></i></a>
                                 <span>Online support</span>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 @endsection
