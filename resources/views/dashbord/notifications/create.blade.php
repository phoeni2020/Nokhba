@extends('dashbord.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Create Notification</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card-body pb-0">
                    @if($errors->any())
                        <div class="alert alert-custom alert-notice alert-danger fade show mb-5" role="alert">
                            <div class="alert-icon">
                                <i class="flaticon-warning"></i>
                            </div>

                            {!! implode('', $errors->all('<div class="alert-text">:message</div>')) !!}

                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                </span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <form action="{{route('admin.notification.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h3 class="mg-b-20">Baisc Information About Notification</h3>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Title</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" placeholder="Enter Notification Title" name="title" type="text">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Notification Massage</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
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
                                <h3 class="mg-b-20">Advnced Information About Notification</h3>
                                <div class="pd-30 pd-sm-40 ">
                                    <div class="row row-sm mb-5">
                                        <!-- Cheack Button -->
                                        <div class="col-md-3">
                                            <label class="form-label mg-b-0">Send Event Link Button</label>
                                        </div>
                                        <div class="col-md-3 mg-t-2 mg-md-t-0">
                                            <input  type="checkbox" name="eventUrl">
                                        </div>
                                        <div class="col-md-6 mg-t-2 mg-md-t-0">
                                            <p>
                                                هذا يعني انه سيتم ارسال لينك في اﻻشعار يجب ادخال اللينك في اﻻسفل
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-10 col-sm-6 col-xs-12">
                                        <fieldset>
                                            <legend>Action Button :-</legend>
                                            <div class="row row-sm mb-5">
                                                <!-- Cheack Button -->
                                                <div class="col-md-3">
                                                    <label class="form-label mg-b-0">Title</label>
                                                </div>
                                                <div class="col-md-3 mg-t-2 mg-md-t-0">
                                                    <input class="form-control" placeholder="Enter Button Title" name="btnTitle" type="text">
                                                </div>
                                                <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                    <p>
                                                        هذا يعني ان هذا التصنيف تصنيف رئيسي يظهر في شاشه المدرس في التطبيق
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row row-sm mb-5">
                                                <!-- Cheack Button -->
                                                <div class="col-md-3">
                                                    <label class="form-label mg-b-0">Button Link</label>
                                                </div>
                                                <div class="col-md-3 mg-t-2 mg-md-t-0">
                                                    <input class="form-control" placeholder="Enter Button Link" name="btnUrl" type="text">
                                                </div>
                                                <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                    <p>
                                                        هذا يعني ان هذا التصنيف تصنيف رئيسي يظهر في شاشه المدرس في التطبيق
                                                    </p>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
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
    </div>
@endsection
@section('js')
    <script>

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            console.log(CSRF_TOKEN);
            $('.category').select2({
                placeholder: 'choose category',
                ajax: {
                    url: "{{route('admin.catgory.dropdown')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
    <!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <!--Internal  Form-elements js-->

@endsection
