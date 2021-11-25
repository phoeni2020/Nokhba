<?php $__env->startSection('css'); ?>
    <!--- Internal Select2 css-->
    <link href="<?php echo e(URL::asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="<?php echo e(URL::asset('assets/plugins/fileuploads/css/fileupload.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Add New Asstitant</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card-body pb-0">
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
                    <div class="card">
                        <?php if($user->role == 'developer'): ?>
                        <form action="<?php echo e(route('admin.app.developer.settings.store')); ?>" method="post" >
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <h3 class="mg-b-20">Application Settings</h3>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($value['key'],$whiteList)): ?>
                                            <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0"><?php echo e($value['key']); ?></label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" required name="<?php echo e($value['key']); ?>" value="<?php echo e($value['value']); ?>" type="text">
                                        </div>
                                    </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <hr class="mb-10 mt-10">
                            <div class="card-body">
                                <div class="pd-30 pd-sm-40 ">
                                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                                    <a href="<?php echo e(url('/index')); ?>">
                                        <button class="btn btn-dark pd-x-30 mg-t-5" type="button">
                                            Cancel
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <?php elseif($user->role == 'admin'): ?>
                            <div class="card-body">
                                <h3 class="mg-b-20">Application Settings</h3>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($value['key'],$whiteList)): ?>
                                            <div class="row row-xs align-items-center mg-b-20">
                                                <div class="col-md-4">
                                                    <label class="form-label mg-b-0"><?php echo e($value['key']); ?></label>
                                                </div>
                                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" readonly value="<?php echo e($value['value']); ?>"  type="text">
                                        </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashbord.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/app_settings/update.blade.php ENDPATH**/ ?>