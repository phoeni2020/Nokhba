@extends('dashbord.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Create Question</h4>
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
                        <form action="{{route('admin.exam.question.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body ">
                                    <h3 class="mg-b-20">Baisc Information About Lesson</h3>
                                    <div class="pd-30 pd-sm-40 bg-gray-200">
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Question Text</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control attchName" placeholder="Enter Question" name="questionText" type="text">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Question Image</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input type="file" name="questionImage" class="dropify uploadimg "  data-height="200" />
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Grade</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" placeholder="Enter Grade" name="grade" type="number" min="0"/>
                                            </div>
                                        </div>
                                        <div id="holder">
                                            <div class="A">
                                                <div class="row row-xs align-items-center mg-b-20 ">
                                                    <div class="col-md-4">
                                                        <label class="form-label mg-b-0">Answers</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                        <input class="form-control Answer" placeholder="Enter Answer Text" name="answer[text][]" type="text">
                                                        <hr>
                                                        <div class="imgHolder">
                                                            <input type="file" name="answer[img][]" class="dropify uploadimg "  data-height="200" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row row-xs align-items-center mg-b-20 ">
                                                    <div class="col-md-4">
                                                        <label for="">Correct Answer</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                        <input class="answerCorrect" name="answer[correct][]" type="checkbox" value="0">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <hr class="mb-10 mt-10">
                            <div class="card-body">
                                <div class="pd-15 pd-sm-40 ">
                                    <button class="btn btn-primary B-0" type="button" data-acount="0" >Add More</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="pd-30 pd-sm-40 ">
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
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $(function(){
                function attachCount(){
                    var _this = $(this);

                    var rows = (typeof _this.data('acount') == undefined || typeof _this.data('acount') == "undefined") ? rows : _this.data('acount');

                    $('#holder').append($('.A').first().clone());


                    $(_this).data('acount',rows+1);

                    var lastRow = $('#holder .A:last');

                    lastRow.removeClass('.A').addClass('A'+$(_this).data('acount'))
                    lastRow.find('.dropify-wrapper').remove();
                    lastRow.find('.Answer').attr('name', `answer[text][${rows+1}]`).val('');
                    lastRow.find('.answerCorrect').attr('name', `answer[correct][${rows+1}]`).val(rows+1);
                    lastRow.find('.imgHolder').append('<input type="file" name="answer[img][]" class="dropify uploadimg"  data-height="200" />');
                    lastRow.find('.delBtn').data('count',rows+1);
                    lastRow.find('.uploadimg').attr('name', `answer[img][${rows+1}]`).val('');
                    $('.dropify').dropify();
                }
                $('.B-0').on('click',attachCount);

                function removeElement(){
                    var _this = $(this);

                    var count = _this.data('count');

                    console.log(count);
                }
                $('.delBtn').on('click',removeElement);

            });
        });

        var drEvent = $('.dropify').dropify();
        drEvent.on('dropify.beforeClear', function(event, element){
            console.log(element.filenameWrapper[0].textContent);
            return confirm("Do you really want to delete \"" + element.filenameWrapper[0].textContent + "\" ?");
        });


    </script>
    <!--Internal Fileuploads js-->

    <!--Internal  Form-elements js-->

@endsection
