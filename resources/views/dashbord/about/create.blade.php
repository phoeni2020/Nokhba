@extends('dashbord.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Quill css -->
    <link href="{{URL::asset('assets/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">About Applcation Page</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                                About Us
                        </div>
                        <form id="createAbout" action="{{route('admin.about.store')}}" method="post">
                            @csrf
                            <div class="ql-wrapper ql-wrapper-demo bg-gray-100">
                                <div id="quillEditor">
                                </div>
                            </div>
                            <div class="modal-footer pd-20">
                                <button class="btn btn-main-primary" id="submit" type="button">Save changes</button>
                                <button class="btn btn-light" type="button">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </div>
@endsection
@section('js')

    <!--Internal quill js -->
    <script src="{{URL::asset('assets/plugins/quill/quill.min.js')}}"></script>
    <!-- Internal Form-editor js -->
    <script src="{{URL::asset('assets/js/form-editor.js')}}"></script>
    <script>
        $('#submit').click(function () {
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var myEditor = document.querySelector('#quillEditor')
            var html = myEditor.children[0].innerHTML
            const form = $('#createAbout');
            var request = $.ajax({
                'url': form.attr('action'),
                'type': "post",
                "data":{
                    about: html,
                    _token :csrf,
                }
            });
            request.done(function(response){
                $('#alertbody').append('<div class="alert alert-custom alert-notice alert-success fade show mb-5" role="alert">\n' +
                    '                        <div class="alert-icon">\n' +
                    '                            <i class="flaticon-warning"></i>\n' +
                    '                        </div>\n' +
                    '                        <div class="alert-text">'+response.message+'</div>\n' +
                    '                        <div class="alert-close">\n' +
                    '                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '                            <span aria-hidden="true">\n' +
                    '                                <i class="ki ki-close"></i>\n' +
                    '                            </span>\n' +
                    '                            </button>\n' +
                    '                        </div>\n' +
                    '                    </div>');
            });
            request.fail(function(response) {
                $('#alertbody').append('<div class="alert alert-custom alert-notice alert-danger fade show mb-5" role="alert">\n' +
                    '                        <div class="alert-icon">\n' +
                    '                            <i class="flaticon-warning"></i>\n' +
                    '                        </div>\n' +
                    '                        <div class="alert-text">'+response['responseJSON'].message.permission+'</div>\n' +
                    '                        <div class="alert-close">\n' +
                    '                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '                            <span aria-hidden="true">\n' +
                    '                                <i class="ki ki-close"></i>\n' +
                    '                            </span>\n' +
                    '                            </button>\n' +
                    '                        </div>\n' +
                    '                    </div>');

                /*
                        $.each(response.responseJSON.messages, function(key, value) {
                            $("#validation-errors").append(`
                                <div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                <div class="alert-text">${value}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                                </div>
                            `);
                        });
                */
            });
        });
    </script>
@endsection

