@extends('dashbord.layouts.master')
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
                        <div class="row row-sm">
                            <center>
                                <table class="table table-striped col-xl-12" style="width:100%">
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script>
        let request = $.ajax({
            url: '{{route('getExam',['course'=>$course,'id'=>$id])}}',
            dataType: "JSON",
            type: "GET",
        });
        request.done(function (response) {
            var exam = response.questions;
            exam.forEach(elements);
        });

        function elements(item, index) {
            if (item.question_text.length != 0) {
                $('.table').append('<tr>' +
                    '<th id="qeustion_text' + index + '">' +
                    '<label class="m-2" for="">' + (index + 1) + '-' + '</label>' +
                    item.question_text +
                    '</th>' +
                    '</tr>');
            }
            if (item.question_img.length != 0 && item.question_text.length == 0) {
                $('.table').append('<tr>' +
                    '<th id="qeustion_img' + index + '">' +
                    '<label for="">' + (index + 1) + '-' + '</label>' +
                    '<img src="' + item.question_img + '" alt=""/>' +
                    '</th>' +
                    '</tr>');
            } else {
                $('.table').append('<tr>' +
                    '<th id="qeustion_img' + index + '">' +
                    '<img class="image-group m-2" src="' + item.question_img + '" alt=""/>' +
                    '</th>' +
                    '</tr>');
            }
            var answers = item.answers;
            answers.forEach(ansewrs);
        }

        function ansewrs(item, index) {
            if (item.image_ansewr.length != 0) {
                $('.table').append('<tr>' +
                    '<td id="qeustion_img' + index + '">' +
                    '<label for="">' + (index + 1) + '-' + '</label>' +
                    '<img height="50%" width="50%" src="' + item.image_ansewr + '" alt=""/>' +
                    '</td>' +
                    '</tr>');
            }
            if (item.text.length != 0) {
                $('.table').append(
                    '<tr>' +
                    '<td style="   padding: 15px;">' +
                    '<label for="">' + (index + 1) + '-' + '</label>' +
                    '</td>' +
                    '<td id="qeustion_img' + index + '">' +
                    '<center>' +
                    '<button type="button" class="btn btn-primary" >' + item.text + '</button>' +
                    '</center>' +
                    '</td>' +
                    '<td>' +

                    '</td>' +

                    '</tr>');
            }
        }
    </script>
@endsection
