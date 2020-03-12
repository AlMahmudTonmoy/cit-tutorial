@extends('layouts.frontend_master')
@section('content')
  <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--3" style="background-image: url({{ asset('frontend_assets/images/bg/3.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Shopping Cart</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.html">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Shopping Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                            <div class="table-content wnro__table table-responsive">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      >
                                      <form action="{{ route('cartupdate') }}" method="post">
                                        @csrf
                                      @forelse (getcartproducts() as $getcartproduct)
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="{{ asset('uploads/product_photos') }}/{{ $getcartproduct->relationtoproducttable->product_photo }}" alt="product img"></a></td>
                                            <td class="product-name"><a href="#">{{ $getcartproduct->relationtoproducttable->product_name }}</a></td>
                                            <td class="product-price"><span class="amount">${{ $getcartproduct->relationtoproducttable->product_price }}</span></td>
                                            <td class="product-quantity">
                                              <input type="hidden" name="cart_id[]" value="{{ $getcartproduct->id }}">
                                              <input name="cart_amount[]" type="number" value="{{ $getcartproduct->quantity }}">
                                            </td>
                                            <td class="product-subtotal">${{ $getcartproduct->relationtoproducttable->product_price * $getcartproduct->quantity }}</td>
                                            <td class="product-remove"><a href="{{ route('cartdelete', $getcartproduct->id) }}">X</a></td>
                                        </tr>
                                      @empty
                                        <tr>
                                          <td class="text-danger" colspan="50">No Product Available</td>
                                        </tr>
                                      @endforelse


                                    </tbody>
                                </table>
                            </div>
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li>
                                  <input style="padding: 10px; margin-top: 5px;" type="text" id="coupon_name" placeholder="Coupon Name" value="{{ $coupon_code }}">
                                  <br>
                                  @if ($errors->all())
                                      @foreach($errors->all() as $error)
                                      <span class="text-danger" style="margin-top: 5px;">{{ $error }}</span>
                                      @endforeach
                                  @endif
                                </li>
                                <li><a id="apply_code_btn">Apply Code</a></li>
                                <li><button type="submit">Update Cart</button></li>
                                </form>
                                <li><a href="{{ url('checkout') }}/{{ $coupon_code }}">Check Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                            <div class="cartbox-total d-flex justify-content-between">
                                <ul class="cart__total__list">
                                    <li>Cart total</li>
                                    <li>Disount Amount</li>
                                </ul>
                                <ul class="cart__total__tk">
                                    <li>${{ getcarttotalprice() }}</li>
                                    <li>
                                      @if (!Str::endsWith($coupon_discount_amount, '%'))
                                      $
                                      @endif
                                      {{ $coupon_discount_amount }}</li>
                                </ul>
                            </div>
                            <div class="cart__total__amount">
                                <span>Grand Total</span>
                                <span>$
                                  @if (Str::endsWith($coupon_discount_amount, '%'))
                                    {{ getcarttotalprice() - ((Str::before($coupon_discount_amount, '%') / 100) * getcarttotalprice()) }}
                                  @else
                                    @if (getcarttotalprice() > $coupon_discount_amount)
                                      {{ getcarttotalprice() - $coupon_discount_amount }}</span>
                                    @else
                                      Na
                                    @endif
                                  @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
@endsection
@section('footer_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#apply_code_btn').click(function(){
        var coupon_name = $('#coupon_name').val();
        var link_to_go = "{{ route('cart') }}"+"/"+coupon_name;
        window.location.href = link_to_go;

      })
    })
  </script>
@endsection
