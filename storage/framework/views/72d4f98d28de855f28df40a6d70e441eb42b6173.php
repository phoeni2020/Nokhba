<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <?php
        $tableConfig = [
            'filter'=>true,
            'hasActions'=>true,
            'actionUrl'=>route('admin.teachers.links.dataTables'),
            'tableHeaed'=>['Id','Link','Title','Hint','Image','Action'],
            'tableColumnsNames'=>json_encode(['id','url','title','hint','img','actions']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'url'],['data'=>'title'],
                                                ['data'=>'hint'],['data'=>'img'],
                                                ['data'=>'actions','responsivePriority' => -1]

                                             ]),
            'tableColumnDefs' => [
                  'image'=>  [
                                    ['targets' => 4, 'orderable' => "true", 'column'=>'img', 'link'=>'url'],
                              ],
                  'link'=>  [
                            ['targets' => 1, 'orderable' => "true", 'column'=>'url', 'link'=>'url']
                      ]
                              ]
        ];
        $buttonsSettings = [
              'add' => ['lable'=>'Add New Link','link'=>route('admin.teachers.links.add')]
        ];
    ?>
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Links Page</h4>
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
                                Links DataTable
                            </p>
                        </div>
                        <div class="text-wrap">
                            <div class="example">
                                <div class="panel panel-primary tabs-style-2">
                                    <div class="table-responsive">
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


<?php echo $__env->make('dashbord.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/teachers/links/index.blade.php ENDPATH**/ ?>