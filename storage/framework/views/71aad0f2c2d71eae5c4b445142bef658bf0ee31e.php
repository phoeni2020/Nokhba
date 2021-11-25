<?php $__env->startSection('css'); ?>
<!--  Owl-carousel css-->
<link href="<?php echo e(URL::asset('assets/plugins/owl-carousel/owl.carousel.css')); ?>" rel="stylesheet" />
<!-- Maps css -->
<link href="<?php echo e(URL::asset('assets/plugins/jqvmap/jqvmap.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
    <?php
        $user =auth()->user();
    ?>
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, <?php echo e($user->fullname()); ?> Welcome</h2>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">
                                        TOTAL USED QRCODES
                                    </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white counusedqr"></h4>
										</div>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">TOTAL STUDENTS</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white countstudent"></h4>
										</div>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">TOTAL LESSONS</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white totallessons"></h4>
											<p class="mb-0 tx-12 text-white op-7"></p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1"></span>
						</div>
					</div>
                    <?php if($user->role == 'admin'): ?>
					    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">Platform QRCodes Sales</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white total_qr_codes"></h4>
											<p class="mb-0 tx-12 text-white op-7"></p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1"></span>
						</div>
					</div>
                    <?php endif; ?>
                    <?php if($user->role == 'admin'): ?>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-success-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">Your Sales  QRCodes </h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white total_qr_codes"></h4>
                                                <p class="mb-0 tx-12 text-white op-7"></p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
										</span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline3" class="pt-1"></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($user->role == 'admin'): ?>
					    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">TOTAL LESSONS</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white totallessons"></h4>
											<p class="mb-0 tx-12 text-white op-7"></p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1"></span>
						</div>
					</div>
                    <?php endif; ?>
				</div>
				<!-- row closed -->

				
				<!-- /row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!--Internal  Chart.bundle js -->
<script src="<?php echo e(URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')); ?>"></script>
<!-- Moment js -->
<script src="<?php echo e(URL::asset('assets/plugins/raphael/raphael.min.js')); ?>"></script>
<!--Internal  Flot js-->
<script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/dashboard.sampledata.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/chart.flot.sampledata.js')); ?>"></script>
<!--Internal Apexchart js-->
<script src="<?php echo e(URL::asset('assets/js/apexcharts.js')); ?>"></script>
<!-- Internal Map -->
<script src="<?php echo e(URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/modal-popup.js')); ?>"></script>
<!--Internal  index js -->
<script src="<?php echo e(URL::asset('assets/js/index.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.vmap.sampledata.js')); ?>"></script>
<script >
    $(document).ready(function(){
        let request = $.ajax({
            "url": "<?php echo e(route('admin.dashbord.getdata')); ?>",
            "type": "GET",
            "dataType": "JSON",
        });
        request.done(function (response) {
            $('.counusedqr').text(response.usedQrCount);
            $('.countstudent').text(response.studentCount);
            $('.totallessons').text(response.countLessons);
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashbord.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/index.blade.php ENDPATH**/ ?>