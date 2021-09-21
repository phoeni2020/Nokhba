@extends('dashbord.layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Create Catgory</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <form action="{{route('admin.catgory.store')}}" method="post" enctype="multipart/form">
                        @csrf
                        <div class="card-body">
                            <h3 class="mg-b-20">Baisc Information About Catgory</h3>
                            <div class="pd-30 pd-sm-40 bg-gray-200">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Name</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input class="form-control" placeholder="Enter Category Name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Description</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <textarea class="form-control" name="desc" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Image</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="file" name="img" class="dropify" data-height="200" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-10 mt-10">
                        <div class="card-body">
                            <h3 class="mg-b-20">Advnced Information About Catgory</h3>
                            <div class="pd-30 pd-sm-40 ">
                                <div class="form-group col-md-10 col-sm-6 col-xs-12">
                                    <fieldset>
                                        <legend>Has Parent :-</legend>
                                        <div class="row row-sm mb-5">
                                            <!-- Dropdown -->
                                            <div class="col-lg-3">
                                                <label class="form-label mg-b-0">Parent</label>
                                            </div>
                                            <div class="col-lg-3 mg-t-2 mg-md-t-0">
                                                    <select class="js-example-basic-single form-control category" name="parent">

                                                    </select>
                                                </div>
                                        </div>
                                        <div class="row row-sm mb-5">
                                                <!-- Cheack Button -->
                                                <div class="col-md-3">
                                                    <label class="form-label mg-b-0">Is Parent</label>
                                                </div>
                                                <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked />
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"
                                                        >Checked switch checkbox input</label
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                    </fieldset>
                                    <hr>
                                    <fieldset>
                                        <legend>
                                        </legend>
                                    </fieldset>
                                </div>
                                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Register</button>
                                <button class="btn btn-dark pd-x-30 mg-t-5">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
@endsection
