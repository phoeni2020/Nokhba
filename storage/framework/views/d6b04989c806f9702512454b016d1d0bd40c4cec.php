<?php $__env->startSection('page-header'); ?>
    <?php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.catgory.dataTables'),
            'hasActions' => true,
            'tableHeaed'=>['Id','Category Name','Description','Main','Is Parent','Created At','Updated Date','Actions'],
            'tableColumnsNames'=>json_encode(['id','name','desc','main','is_parent','created_at','updated_at','actions']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'name'],['data'=>'desc'],['data'=>'main'],
                                                ['data'=>'is_parent'],
                                                ['data'=>'created_at'],['data'=>'updated_at'],['data'=>'actions','responsivePriority' => -1]
                                             ]),
            'tableColumnDefs' => [
                   'link'=>  [
                                    ['targets' => 1, 'orderable' => "true", 'column'=>'name', 'link'=>'#']
                              ]],
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
                    <h4 class="content-title mb-0 my-auto">Catgories Page</h4>
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
                                Catgories DataTable
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

    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"></h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="button">Save changes</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('Scripts'); ?>
    <script src="<?php echo e(URL::asset('assets/js/modal.js')); ?>"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).on('click','.showData',function(event) {
            event.preventDefault();
            let _this = $(this);
            var id = _this.attr('href');
            let request = $.ajax({
                "url": "<?php echo e(route('admin.users.ajax.getuser')); ?>",
                "type": "POST",
                "dataType": "JSON",
                "data":
                    {
                        _token: CSRF_TOKEN,
                        id:id
                    },
            });
            request.done(function (response) {
                $('.modal-header').find('.modal-title').text(response.fName+' '+response.mName+ ' ' +response.lName);
            });

            request.fail(function (response) {
            });

        });
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('dashbord.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/users/index.blade.php ENDPATH**/ ?>