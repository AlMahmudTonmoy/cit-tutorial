<?php $__env->startSection('content'); ?>
  <!-- Start Bradcaump area -->
          <div class="ht__bradcaump__area bg-image--4" style="  background-image: url(<?php echo e(asset('frontend_assets/images/bg/4.jpg')); ?>);">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="bradcaump__inner text-center">
                          	<h2 class="bradcaump-title">Checkout</h2>
                              <nav class="bradcaump-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb_item active">Checkout</span>
                              </nav>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- End Bradcaump area -->
  <!-- Start Checkout Area -->
          <section class="wn__checkout__area section-padding--lg bg__white">
          	<div class="container">
          		<div class="row">
          			<div class="col-lg-12">
          				<div class="wn_checkout_wrap">
          					<div class="checkout_info">
          						<span>Returning customer ?</span>
          						<a class="showlogin" href="#">Click here to login</a>
          					</div>
          					<div class="checkout_login">
          						<form class="wn__checkout__form" action="#">
          							<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>

          							<div class="input__box">
          								<label>Username or email <span>*</span></label>
          								<input type="text">
          							</div>

          							<div class="input__box">
          								<label>password <span>*</span></label>
          								<input type="password">
          							</div>
          							<div class="form__btn">
          								<button>Login</button>
          								<label class="label-for-checkbox">
          									<input id="rememberme" name="rememberme" value="forever" type="checkbox">
          									<span>Remember me</span>
          								</label>
          								<a href="#">Lost your password?</a>
          							</div>
          						</form>
          					</div>
          					<div class="checkout_info">
          						<span>Have a coupon? </span>
          						<a class="showcoupon" href="#">Click here to enter your code</a>
          					</div>
          					<div class="checkout_coupon">
          						<form action="#">
          							<div class="form__coupon">
          								<input type="text" placeholder="Coupon code">
          								<button>Apply coupon</button>
          							</div>
          						</form>
          					</div>
          				</div>
          			</div>
          		</div>
          		<div class="row">
          			<div class="col-lg-6 col-12">
          				<div class="customer_details">
                              <form action="<?php echo e(url('stripe/payment')); ?>" method="post">
                              <h3>Billing details</h3>
                              <?php if(auth()->guard()->guest()): ?>
                                  Please Login to Continue.
                                  <a href=" <?php echo e(url('login')); ?> ">Login Here..</a>
                                  <br>
                                  <hr>
                                  <br>
                                  Don't Have an Account?
                                  <a href=" <?php echo e(url('customer/register')); ?> ">Register Here..</a>

                              <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
          					<div class="customar__field">
          						<div class="margin_between">
  	        						<div class="input_box space_between">
  	        							<label>Name <span>*</span></label>
										  
										  	<input type="text" value="<?php echo e(Auth::user()->name ?? ""); ?>" name="name">
										  
  	        						</div>
  	        						<div class="input_box space_between">
  	        							<label>Email <span>*</span></label>
  	        							
											<input type="email" value="<?php echo e(Auth::user()->email ?? ""); ?>" name="email">
										
  	        						</div>
          						</div>
          						<div class="input_box">
          							<label>Country<span>*</span></label>
          							<select class="select__option" id="country_dropdown" name="country_id">
										<option value="">Select a country…</option>
										<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									  		<option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          							</select>
          						</div>
          						<div class="input_box">
          							<label>City<span>*</span></label>
          							<select class="select__option" id="city_dropdown" name="city_id">
          							</select>
								  </div>
								<div class="input_box">
									<label>Address <span>*</span></label>
									<input type="text" placeholder="address" name="address">
								</div>
  								<div class="margin_between">
  									<div class="input_box space_between">
  										<label>Phone <span>*</span></label>
  										<input type="text" name="phone_number">
  									</div>
  								</div>
          					</div>
                            <?php endif; ?>
          				</div>

          			</div>
          			<div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
          				<div class="wn__order__box">
          					<h3 class="onder__title">Your order</h3>
          					<ul class="order__total">
          						<li>Product</li>
          						<li>Total</li>
          					</ul>
          					<ul class="order_product">
                                  <?php $__currentLoopData = getcartproducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getcartproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <li><?php echo e($getcartproduct->relationtoproducttable->product_name); ?> × <?php echo e($getcartproduct->quantity); ?> <span>$<?php echo e($getcartproduct->relationtoproducttable->product_price * $getcartproduct->quantity); ?> </span></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          					</ul>
          					<ul class="shipping__method">
          						<li>Cart Subtotal <span>$<?php echo e(getcarttotalprice()); ?></span></li>
          						<li>
                                    <input type="hidden" name="coupon_code" value="<?php echo e($coupon_code); ?>">
                                      Discount(-) <?php echo e($coupon_code); ?> <span>
                                      $<?php echo e($discount_amount); ?>

                                    </span></li>
          						<li>After Discount <span>
                                    $
                                    <span id="after_discount_amount">
                                        <?php if(Str::endsWith($discount_amount, '%')): ?>
                                            <?php
                                                echo $after_discount = getcarttotalprice() - ((Str::before($discount_amount, '%') / 100) * getcarttotalprice())
                                            ?>
                                        <?php else: ?>
                                            <?php if(getcarttotalprice() > $discount_amount): ?>
                                                <?php
                                                    echo $after_discount = getcarttotalprice() - $discount_amount
                                                ?>
                                            <?php else: ?>
                                            Na
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </span>
                                    </span></li>
          						<li>Shipping(+)
          							<ul>
          								<li>
          									<input name="shipping_charge" data-index="0" value="60" checked="checked" type="radio" id="shipping_charge_dhaka">
          									<label>Dhaka: $60.00</label>
          								</li>
          								<li>
          									<input name="shipping_charge" data-index="0" value="120" type="radio" id="shipping_charge">
          									<label>Outside of Dhaka: $220.00</label>
          								</li>
          							</ul>
          						</li>
          					</ul>
          					<ul class="total__amount">
                                <input type="hidden" id="order_total_input" name="order_total_input" value=" <?php echo e($after_discount + 60); ?> ">
          						<li>Order Total <span>$ <span id="order_total_amount">
                                    <?php echo e($after_discount + 60); ?>

                                </span> </span></li>
          					</ul>
          				</div>
  					    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
  						    <div class="payment">
  						        <div class="che__header" role="tab" id="headingOne">
  						          	<a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
  						                <span>Direct Bank Transfer</span>
  						          	</a>
  						        </div>
  						        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
  					            	<div class="payment-body">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</div>
  						        </div>
  						    </div>
  						    <div class="payment">
  						        <div class="che__header" role="tab" id="headingTwo">
  						          	<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
  							            <span>Cheque Payment</span>
  						          	</a>
  						        </div>
  						        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
  					          		<div class="payment-body">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</div>
  						        </div>
  						    </div>
  						    <div class="payment">
  						        <div class="che__header" role="tab" id="headingThree">
  						          	<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
  							            <span>Cash on Delivery</span>
  						          	</a>
  						        </div>
  						        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
  					          		<div class="payment-body">Pay with cash upon delivery.</div>
  						        </div>
  						    </div>
  						    <div class="payment">
  						        <div class="che__header" role="tab" id="headingFour">
  						          	<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <span>Online Payment</span>
  						          	</a>
  						        </div>
  						        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
  					          		<div class="payment-body">
                                        <?php if(auth()->guard()->guest()): ?>
                                            Please Login to Continue.
                                            <a href=" <?php echo e(url('login')); ?> ">Login Here..</a>
                                        <?php endif; ?>
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="total_to_pay" value="<?php echo e($after_discount + 60); ?>" id="total_to_pay">
                                            <button type="submit" style="width: 20%; border: none;"">
                                                <img src="https://ioetraders.com/wp-content/uploads/2019/12/stripe-payment-method.png">
                                            </button>
                                        <?php endif; ?>
                                </form>
                                        <a href="http://">
                                        </a>
                                    </div>
  						        </div>
  						    </div>
  					    </div>

          			</div>
          		</div>
          	</div>
          </section>
          <!-- End Checkout Area -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#apply_code_btn').click(function(){
        var coupon_name = $('#coupon_name').val();
        var link_to_go = "<?php echo e(route('cart')); ?>"+"/"+coupon_name;
        window.location.href = link_to_go;

      })
    })

  </script>
  <script type="text/javascript">
	$(document).ready(function() {
		$('#country_dropdown').select2();
		$('#city_dropdown').select2();
		$('#country_dropdown').change(function(){
			var country_id = $(this).val();
			//ajax starts here
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:'POST',
				url:'/getcitylist',
				data:{country_id:country_id},
				success:function(data){
					$('#city_dropdown').html(data);
				}
			})
			//ajax ends here
        });

        $('#shipping_charge_dhaka').click(function () {
            var after_discount_amount = parseFloat($('#after_discount_amount').html()) + 60;
            $('#order_total_amount').html(after_discount_amount);
            $('#order_total_input').val(after_discount_amount);
            $('#total_to_pay').val(after_discount_amount);
        });
        $('#shipping_charge').click(function () {
            var after_discount_amount = parseFloat($('#after_discount_amount').html()) + 120;
            $('#order_total_amount').html(after_discount_amount);
            $('#order_total_input').val(after_discount_amount);
            $('#total_to_pay').val(after_discount_amount);
        });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/checkout.blade.php ENDPATH**/ ?>