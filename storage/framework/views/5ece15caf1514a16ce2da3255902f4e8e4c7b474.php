<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <?php echo $__env->make('dashbord.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="<?php echo e(URL::asset('assets/img/loader.svg')); ?>" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
        <?php
            $user =auth()->user();
        ?>
		<?php echo $__env->make('dashbord.layouts.main-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- main-content -->
		<div class="main-content app-content">
			<?php echo $__env->make('dashbord.layouts.main-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<!-- container -->
			<div class="container-fluid">
				<?php echo $__env->yieldContent('page-header'); ?>
				<?php echo $__env->yieldContent('content'); ?>
				<?php echo $__env->make('dashbord.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('dashbord.layouts.models', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('dashbord.layouts.footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->yieldPushContent('Scripts'); ?>
    </body>
</html>
<?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/layouts/master.blade.php ENDPATH**/ ?>