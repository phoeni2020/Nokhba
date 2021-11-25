<form class="" id="filter">
    <div class="row">

        <?php $__currentLoopData = $filterConfig['inputs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($input['type'] == 'select'): ?>
                <div class="col-lg col-md-4 col-sm-6 mb-6">
                    <label><?php echo e($input['lable']); ?></label>
                    <select class="form-control dropDown" id="<?php echo e($input['name']); ?>" name="<?php echo e($input['name']); ?>">
                        <option></option>
                        <?php $__currentLoopData = $input['dropDownData']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo $data->{$input['dropDownValue']}; ?>"><?php echo $data->{$input['dropDownText']}; ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php else: ?>
                <div class="col-lg col-md-4 col-sm-6 mb-6">
                    <label><?php echo e($input['lable']); ?></label>
                    <input type="<?php echo e($input['type']); ?>" class="form-control datatable-input"
                           placeholder="<?php echo e($input['placeholder']); ?>" name="<?php echo e($input['name']); ?>">
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <hr class="mb-10 mt-10">

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary btn-primary--icon" id="kt_search">
                <span>
                    <i class="la la-search"></i>
                    <span><?php echo app('translator')->get('Dashbord.search'); ?></span>
                </span>
            </button>&nbsp;&nbsp;
            <button class="btn btn-outline-secondary btn-secondary--icon" id="kt_reset">
                <span>
                    <i class="la la-close"></i>
                    <span><?php echo app('translator')->get('Dashbord.reset'); ?></span>
                </span>
            </button></div>
    </div>

    <hr class="mb-10 mt-10">
</form>

<?php $__env->startPush('Scripts'); ?>
    <script>
        $(function(){

            <?php if(isset($filterConfig['dropDownInput'])): ?>
            <?php $__currentLoopData = $filterConfig['dropDownInput']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dropDownInputData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            $('#<?php echo e($dropDownInputData['id']); ?>').select2({
                placeholder: "<?php echo e($dropDownInputData['placeholder']); ?>",
                allowClear: true
            });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        });
        /*====================================================*/
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/components/table-filter.blade.php ENDPATH**/ ?>