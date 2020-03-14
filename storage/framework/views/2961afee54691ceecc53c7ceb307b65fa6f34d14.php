<?php $__env->startSection('content'); ?>
  <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--3" style="background-image: url(<?php echo e(asset('frontend_assets/images/bg/3.jpg')); ?>);">
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
                                <?php if(session('success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                <?php endif; ?>
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
                                      <form action="<?php echo e(route('cartupdate')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                      <?php $__empty_1 = true; $__currentLoopData = getcartproducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getcartproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="<?php echo e(asset('uploads/product_photos')); ?>/<?php echo e($getcartproduct->relationtoproducttable->product_photo); ?>" alt="product img"></a></td>
                                            <td class="product-name"><a href="#"><?php echo e($getcartproduct->relationtoproducttable->product_name); ?></a></td>
                                            <td class="product-price"><span class="amount">$<?php echo e($getcartproduct->relationtoproducttable->product_price); ?></span></td>
                                            <td class="product-quantity">
                                              <input type="hidden" name="cart_id[]" value="<?php echo e($getcartproduct->id); ?>">
                                              <input name="cart_amount[]" type="number" value="<?php echo e($getcartproduct->quantity); ?>">
                                            </td>
                                            <td class="product-subtotal">$<?php echo e($getcartproduct->relationtoproducttable->product_price * $getcartproduct->quantity); ?></td>
                                            <td class="product-remove"><a href="<?php echo e(route('cartdelete', $getcartproduct->id)); ?>">X</a></td>
                                        </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                          <td class="text-danger" colspan="50">No Product Available</td>
                                        </tr>
                                      <?php endif; ?>


                                    </tbody>
                                </table>
                            </div>
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li>
                                  <input style="padding: 10px; margin-top: 5px;" type="text" id="coupon_name" placeholder="Coupon Name" value="<?php echo e($coupon_code); ?>">
                                  <br>
                                  <?php if($errors->all()): ?>
                                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <span class="text-danger" style="margin-top: 5px;"><?php echo e($error); ?></span>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                                </li>
                                <li><a id="apply_code_btn">Apply Code</a></li>
                                <li><button type="submit">Update Cart</button></li>
                                </form>
                                <li><a href="<?php echo e(url('checkout')); ?>/<?php echo e($coupon_code); ?>">Check Out</a></li>
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
                                    <li>$<?php echo e(getcarttotalprice()); ?></li>
                                    <li>
                                      <?php if(!Str::endsWith($coupon_discount_amount, '%')): ?>
                                      $
                                      <?php endif; ?>
                                      <?php echo e($coupon_discount_amount); ?></li>
                                </ul>
                            </div>
                            <div class="cart__total__amount">
                                <span>Grand Total</span>
                                <span>$
                                  <?php if(Str::endsWith($coupon_discount_amount, '%')): ?>
                                    <?php echo e(getcarttotalprice() - ((Str::before($coupon_discount_amount, '%') / 100) * getcarttotalprice())); ?>

                                  <?php else: ?>
                                    <?php if(getcarttotalprice() > $coupon_discount_amount): ?>
                                      <?php echo e(getcarttotalprice() - $coupon_discount_amount); ?></span>
                                    <?php else: ?>
                                      Na
                                    <?php endif; ?>
                                  <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\cit-tutorial\resources\views/cart.blade.php ENDPATH**/ ?>