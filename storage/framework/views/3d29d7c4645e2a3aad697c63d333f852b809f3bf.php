<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <?php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.qrUsedCode.dataTables'),
            'tableHeaed'=>['Id','QrCode Image','Lesson Title','Student','Created At','Valid Till'],
            'tableColumnsNames'=>json_encode(['id','qrUrl','lesson','student','created_at','valid_till']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'qrUrl'],
                                                ['data'=>'lesson'],['data'=>'student'],
                                                ['data'=>'created_at'],['data'=>'valid_till'],
                                                ]),
           'tableColumnDefs' => [
                   'image'=>  [
                                    ['targets' => 1, 'orderable' => "true", 'column'=>'qrUrl', 'link'=>'#']
                              ]],
        ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Title Arabic','type' => 'text','placeholder'=>'Title Arabic','name' => 'title'],
                    ['lable' => 'QrCode Text','type' => 'text','placeholder'=>'Title Arabic','name' => 'code_text'],
                ]];
        $buttonsSettings = [
                'view' => ['lable'=>'None Used QrCodes','link'=>route('admin.qrcode.index')],
        ];
    ?>
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Used QrCodes</h4>
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
        <?php elseif(Session::has('errorMessage')): ?>
            <p class="alert <?php echo e(Session::get('message_class', 'alert-danger')); ?>">
                <?php echo e(Session::get('errorMessage')); ?>

            </p>
        <?php endif; ?>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <p class="label">
                                 Used QrCodes DataTable
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


<?php echo $__env->make('dashbord.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/qrcode/used.blade.php ENDPATH**/ ?>