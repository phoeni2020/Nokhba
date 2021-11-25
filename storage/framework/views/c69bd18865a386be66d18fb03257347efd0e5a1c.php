<?php $__env->startSection('page-header'); ?>
    <?php
        $tableConfig = [
                'filter'=>true,
                'actionUrl'=>route('admin.students.fillTableUser'),
                'hasActions' => true,
                'tableHeaed'=>['Id','Full Name','Email','Phone','Parent Phone','Created At','Actions'],
                'tableColumnsNames'=>json_encode(['id','fullName','email','phone','parentPhone','created_at','actions']),
                'tableColumnsData'=> json_encode([
                                                    ['data'=>'id'],['data'=>'fullName'],['data'=>'email'],['data'=>'phone'],
                                                    ['data'=>'parentPhone'],
                                                    ['data'=>'created_at'],
                                                    ['data'=>'actions','responsivePriority' => -1]
                                                 ]),
                'tableColumnDefs' => [
                       'link'=>  [
                                        ['targets' => 1, 'orderable' => "true", 'column'=>'name', 'link'=>'#']
                                  ]
                                  ],
                'customActions' => json_encode([[
                    'linkColumn' => 'showStudent','attributes'=> "class='showData modal-effect btn btn-sm btn-clean btn-icon'
                                                               title='add product details'
                                                               data-toggle='modal'
                                                               data-target='#modaldemo8'
                                                               data-effect='effect-super-scaled'
                                                               ",'icon'=>"fas fa-cog"],])
            ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'name'],
                ]
        ];
        $buttonsSettings = [
        'add' => ['lable'=>'Add New Catgory','link'=>route('admin.catgory.create')]
        ];
    ?>
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Students Page</h4>
                </div>
            </div>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.button-setting','data' => ['buttonsSettings' => $buttonsSettings]]); ?>
<?php $component->withName('button-setting'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['buttonsSettings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($buttonsSettings)]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        </div>
        <?php if(Session::has('message')): ?>
            <p class="alert <?php echo e(Session::get('message_class', 'alert-success')); ?>">
                <?php echo e(Session::get('message')); ?>

            </p>
        <?php endif; ?>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <p class="label">
                                Students DataTable
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashbord.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/students/index.blade.php ENDPATH**/ ?>