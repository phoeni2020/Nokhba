@extends('dashbord.layouts.master')

@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet"/>
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
    @php
        $user =auth()->user();
    @endphp
    <h1>test</h1>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, {{ $user->fullname() }} Welcome</h2>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    @if($user->student == 0)
        <div class="row row-sm">
                    {{-- compositeline --}}
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
                            <span id="compositeline"
                                  class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                        </div>
                    </div>
                    {{-- compositeline2 --}}
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
                    {{-- compositeline3 --}}
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
                            <span id="compositeline3" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
                        </div>
                    </div>
                    {{-- compositeline4 --}}
                    @if($user->role == 'admin')
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-primary-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">
                                            TOTAL PLATFORM SALES
                                        </h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white plat_qr_sales"></h4>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
											        <i class="fas fa-arrow-circle-up text-white"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                            </div>
                        </div>
                    @endif
                    {{-- compositeline5 --}}
                    @if($user->role == 'admin')
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-success-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">Your Sales QRCodes </h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white total_teacher_qr_codes"></h4>
                                                <p class="mb-0 tx-12 text-white op-7"></p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
										</span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline5" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                            </div>
                        </div>
                    @endif
                    {{-- compositeline6 --}}
                    @if($user->role == 'admin')
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-danger-gradient">
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
                                <span id="compositeline6" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row row--lg">
                    <div class="col-xl-6">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="breadcrumb-header justify-content-between">
                                        <div class="my-auto">
                                            <div class="d-flex">
                                                <h4 class="content-title mb-0 my-auto">اعلي 10 دروس مبيعا</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                        <tr>
                                            <th>الدرس</th>
                                            <th>عدد مرات البيع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($topLessons as $topLesson)
                                            <tr>
                                                <td>{{$topLesson->title}}</td>
                                                <td>{{$topLesson->count}}</td>
                                            </tr>
                                        @empty
                                            <center>لم يتم بيع اي درس او لم يتم اضافه اي درس</center>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Salary</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Joan Powell</td>
                                            <td>Associate Developer</td>
                                            <td>$450,870</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <center>
                        You'r Password Changed Successfully
                    </center>
                @endif
                <!-- row closed -->
@endsection

@section('js')
    <!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
<script >
    $(document).ready(function(){
        let request = $.ajax({
            "url": "{{route('admin.dashbord.getdata')}}",
            "type": "GET",
            "dataType": "JSON",
        });
        request.done(function (response) {
            $('.counusedqr').text(response.usedQrCount);
            $('.countstudent').text(response.studentCount);
            $('.totallessons').text(response.countLessons);
            $('.plat_qr_sales').text(response.platformSales);
            $('.total_teacher_qr_codes').text(response.qrcodeSales);

        });

    });
</script>
@endsection
