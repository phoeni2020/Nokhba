<?php $__env->startSection('css'); ?>
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="<?php echo e(URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')); ?>"
          rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="<?php echo e(URL::asset('assets/img/media/login.png')); ?>" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="m-10 d-flex">
                                         <img src="<?php echo e(URL::asset('assets/img/brand/BeFunky-design.png')); ?>"class="sign-favicon ht-70" alt="logo">
                                    </div>
                                    <div class="main-signup-header">
                                        <h5 class="font-weight-normal mb-4">
                                           تسجيل عضويه مدرس
                                        </h5>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-custom alert-notice alert-danger fade show mb-5" role="alert">
                                                <div class="alert-icon">
                                                    <i class="flaticon-warning"></i>
                                                </div>

                                                <?php echo implode('', $errors->all('<div class="alert-text">:message</div>')); ?>


                                                <div class="alert-close">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                </span>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <form method="post" action="<?php echo e(route('register')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <span style="color:red;">*</span>
                                                <input class="form-control" placeholder="Enter your firstname " name="fName" required type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <span style="color:red;">*</span>
                                                <input class="form-control" placeholder="Enter your Middle Name" name="mName" required type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <span style="color:red;">*</span>
                                                <input class="form-control" placeholder="Enter your Last Name" name="lName" required type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <span style="color:red;">*</span>
                                                <input class="form-control" placeholder="Enter your email" name="email" required type="email">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <span style="color:red;">*</span>
                                                <input class="form-control" name="password" placeholder="Enter your password" required type="password">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <span style="color:red;">*</span>
                                                <input class="form-control" name="password_confirmation" type="password" required placeholder="Confirm Your Password">
                                            </div>
                                            <button class="btn btn-main-primary btn-block">Create Account</button>
                                        </form>
                                        <div class="main-signup-footer mt-5">
                                            <p>Already have an account?
                                                <a href="<?php echo e(url('/signin')); ?>">SignIn</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div>
            <!-- End -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashbord.layouts.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/auth/register.blade.php ENDPATH**/ ?>