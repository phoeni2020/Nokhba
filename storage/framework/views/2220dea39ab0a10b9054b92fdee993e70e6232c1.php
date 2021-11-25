<?php $__env->startSection('page-header'); ?>
    <?php
    $fullName = $user->fullname();
    ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Student's</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <?php echo e($fullName); ?></span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row row-sm">
        <!-- Col -->
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt="" src="<?php echo e(URL::asset('assets/img/faces/6.jpg')); ?>"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name"><?php echo e($fullName); ?></h5>
                                    <p class="main-profile-name-text"><?php echo e($user->student == 1 ? 'Student' : $user->role); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col mb20">
                                    <h5><?php echo e($totalViews); ?></h5>
                                    <h6 class="text-small text-muted mb-0">Total Views</h6>
                                </div>
                                <div class="col-md-4 col mb20">
                                    <h5><?php echo e($totalQrCodes); ?></h5>
                                    <h6 class="text-small text-muted mb-0">Total Owned QR Codes</h6>
                                </div>
                                <div class="col-md-4 col mb20">
                                    <h5><?php echo e($totalEnrolledLessons); ?></h5>
                                    <h6 class="text-small text-muted mb-0">Total Enrolled Lesson </h6>
                                </div>
                            </div>
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label tx-13 mg-b-25">
                        Conatct
                    </div>
                    <div class="main-profile-contact-list">
                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>Mobile</span>
                                <hr>
                                <div>
                                    <?php echo e($user->phone); ?>

                                </div>
                            </div>

                        </div>
                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>Parent Mobile</span>
                                <hr>
                                <div>
                                    <?php echo e($user->parentPhone); ?>

                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-success-transparent text-success">
                                <i class="icon ion-logo-slack"></i>
                            </div>
                            <div class="media-body">
                                <span>E-mail</span>
                                <hr>
                                <div>
                                    <?php echo e($user->email); ?>

                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-info-transparent text-info">
                                <i class="icon ion-md-locate"></i>
                            </div>
                            <div class="media-body">
                                <span>Current Address</span>
                                <div>
                                    San Francisco, CA
                                </div>
                            </div>
                        </div>
                    </div><!-- main-profile-contact-list -->
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <?php
                $tableConfig = [
                        'filter'=>true,
                        'actionUrl'=>route('admin.exam.datatable'),
                        'tableHeaed'=>['Id','grade','done','student'],
                        'tableColumnsNames'=>json_encode(['id','grade','done','student']),
                        'tableColumnsData'=> json_encode([
                                                            ['data'=>'id'],['data'=>'grade'],
                                                            ['data'=>'done'],['data'=>'student'],
                                                         ]),
                    ];
                $filterConfig = ['inputs' => [
                            ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'name'],
                        ]
                ];
            ?>
            <div class="container-fluid">
                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    <p class="label">
                                        <?php echo e($fullName); ?>  Exams
                                    </p>
                                </div>
                                <div class="text-wrap">
                                    <div class="example">
                                        <div class="panel panel-primary tabs-style-2">
                                            <div class="table-responsive">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.table-filter','data' => ['filterConfig' => $filterConfig]]); ?>
<?php $component->withName('table-filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['filterConfig' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterConfig)]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.data-table','data' => ['tableConfig' => $tableConfig]]); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['tableConfig' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig)]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /Col -->
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('dashbord.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/students/view.blade.php ENDPATH**/ ?>