@extends('dashbord.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">

    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">

@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Create Course</h4>
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
                        <form>
                            @csrf
                            <div id="holder">
                                <div class="card-body A">
                                    <h3 class="mg-b-20">Genrate Random QR Codes To Lesson</h3>
                                    <div class="pd-30 pd-sm-40 bg-gray-200">
                                            <div class="row row-xs align-items-center mg-b-20">
                                                <div class="col-md-4">
                                                    <label class="form-label mg-b-0">How Many QR's You Want ?</label>
                                                </div>
                                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control qrCode" placeholder="Enter Numbers Of QRs Max QR Per One Time Is 250" name="number" type="number">
                                            </div>
                                            </div>
                                            <div class="row row-xs align-items-center mg-b-20">
                                                <div class="col-md-4">
                                                    <label class="form-label mg-b-0">Lesson</label>
                                                </div>
                                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                    <select class="js-example-basic-single form-control lesson" name="lesson">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row row-xs align-items-center mg-b-20">
                                                <div class="col-md-4">
                                                    <label class="form-label mg-b-0">Center</label>
                                                </div>
                                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                    <select class="js-example-basic-single form-control center" name="center">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-10 mt-10">
                            <div class="card-body">
                                <div class="pd-30 pd-sm-40 ">
                                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" id="submit" type="button">Done</button>
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
    <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
    <!-- Sweet-alert js  -->
    <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(function (){
            $('.lesson').select2({
                placeholder: 'choose Lesson',
                ajax: {
                    url: "{{route('admin.course.dropdown')}}",
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
            $('.center').select2({
                placeholder: 'choose center',
                ajax: {
                    url: "{{route('admin.center.dropdown')}}",
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
            function makeid() {
                var result           = '';
                var characters       = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789@#%*';
                var charactersLength = characters.length;
                var arrayResult = [];
                var number =$('.qrCode').val()
                for (var i = 0; i < number; i++ ) {
                    for(var x = 0; x < 10;x++){
                        result += characters.charAt(Math.random() * charactersLength);
                    }
                    arrayResult.push(result);
                    result = '';
                }
                var jsonObject = JSON.stringify(arrayResult);
                var lessonId = $('.lesson').val();
                var centerId = $('.center').val();
                let request = $.ajax({
                    url: '{{route('admin.qrcode.store')}}',
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: CSRF_TOKEN,
                        qrObject: jsonObject,
                        lesson:lessonId,
                        center:centerId,
                    }
                });
                request.done(function (response) {
                    swal(
                        {
                            title: 'Well done!',
                            text: 'You clicked the button!',
                            type: 'success',
                            confirmButtonColor: '#57a94f'
                        }
                        , function() {
                            getUrl =  window.location;
                            baseurl = getUrl.origin;
                            window.open(baseurl+'/'+response, '_blank').focus();
                    });
                });
            }
            $('#submit').on('click',makeid);
        });
    </script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
@endsection
