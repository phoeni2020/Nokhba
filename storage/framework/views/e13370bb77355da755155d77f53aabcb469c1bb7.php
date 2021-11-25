<div class="card-toolbar">

    <?php if(isset($buttonsSettings['delete'])): ?>
    <!--begin::Button-->
        <a href="<?php echo $buttonsSettings['delete']['link']; ?>"  id="deleteSelected" class="btn btn-outline-danger font-weight-bolder color-primary mb-2 mb-sm-0 mr-2">
            <i class="icon-nm flaticon-delete"></i>
            <?php echo $buttonsSettings['delete']['lable']; ?>

        </a>
        <!--end::Button-->
    <?php endif; ?>

    <?php if(isset($buttonsSettings['view'])): ?>
        <!--begin::Button-->
            <a href="<?php echo $buttonsSettings['view']['link']; ?>"  id="deleteSelected" class="btn btn-outline-primary font-weight-bolder color-primary mb-2 mb-sm-0 mr-2">
                <i class="icon-nm flaticon-delete"></i>
                <?php echo $buttonsSettings['view']['lable']; ?>

            </a>
            <!--end::Button-->
        <?php endif; ?>

    <?php if(isset($buttonsSettings['actions'])): ?>
        <div class="dropdown dropdown-inline mr-2">
            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle mb-2 mb-sm-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs side-menu__icon"></i>
                <?php echo e($buttonsSettings['actions']['buttonLabel']); ?></button>
            <!--begin::Dropdown Menu-->
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                <!--begin::Navigation-->
                <ul class="navi flex-column navi-hover py-2">
                    <?php $__currentLoopData = $buttonsSettings['actions']['actionsLinks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actionData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="navi-item">
                            <a href="<?php echo e($actionData['link']); ?>"
                                <?php echo !empty($actionData['attributs']) ? $actionData['attributs'] : 'class="navi-link"'; ?> >
                        <span class="navi-icon">
                            <i class="<?php echo e($actionData['icon']); ?>"></i>
                        </span>
                                <span class="navi-text"><?php echo e($actionData['label']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <!--end::Navigation-->
            </div>
            <!--end::Dropdown Menu-->
        </div>
    <?php endif; ?>

    <?php if(isset($buttonsSettings['add'])): ?>
    <!--begin::Button-->
        <a href="<?php echo $buttonsSettings['add']['link']; ?>" class="btn btn-primary mb-2 mb-sm-0 mr-2">
            <i class="typcn typcn-plus"></i>
            <?php echo $buttonsSettings['add']['lable']; ?>

        </a>
        <!--end::Button-->
    <?php endif; ?>

    <?php if(isset($buttonsSettings['back'])): ?>
        <!--begin::Button-->
            <button type="button" onclick="window.history.back()" class="btn btn-outline-secondary mb-2 mb-sm-0 mr-2">
                <i class="far fa-arrow-alt-circle-left"></i>
                <?php echo $buttonsSettings['back']['lable']; ?>

            </button>
            <!--end::Button-->
        <?php endif; ?>

</div>
<?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/components/button-setting.blade.php ENDPATH**/ ?>