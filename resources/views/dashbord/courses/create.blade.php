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
                        <form action="{{route('admin.course.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h3 class="mg-b-20">Baisc Information About Lesson</h3>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Lesson Name</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input required class="form-control" placeholder="Enter Lesson Title" name="title" type="text">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Number Of Quistions</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input required class="form-control" placeholder="Enter Quistions Numbers" name="q_no" type="number" min="4" max="100">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Description</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <textarea required class="form-control" name="desc" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Category</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <select required class="js-example-basic-single form-control category" name="category_id">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Image</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="file" name="img" class="dropify" data-height="200" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-10 mt-10">
                            <div class="card-body">
                                <h3 class="mg-b-20">Advnced Information About Lesson</h3>
                                <div class="pd-30 pd-sm-40 ">
                                    <div class="form-group col-md-10 col-sm-6 col-xs-12">
                                        <fieldset>
                                            <legend>Attachment's :-</legend>
                                            <div id="attch">
                                                <div class="row row-sm mb-5 attchClass">
                                                    <!-- Cheack Button -->
                                                    <div class="col-md-3">
                                                        <label class="form-label mg-b-0">Attachment</label>
                                                    </div>
                                                    <div class="col-md-6 mg-t-2 mg-md-t-0 attchInput">
                                                        <div class="inputHolder">
                                                            <select class="js-example-basic-single form-control attch" name="attch[]">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mg-t-2 mg-md-t-0">
                                                        <p>
                                                            ???????? ???????? ???????? ???????????? ???? ???????? ????pdf
                                                            ???????? ???? ?????? :-
                                                            https://www.youtube.com/watch?v=0GwYU6xaTcU
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-sm mb-5">
                                                <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                    <button class="btn btn-primary attchButton" type="button" data-acount="0" >Add More</button>
                                                </div>
                                                <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                    <p>
                                                        ?????? ???????? ???? ?????? ?????????????? ?????????? ?????????? ???????? ???? ???????? ???????????? ???? ??????????????
                                                    </p>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                        <fieldset id="holder">
                                            <legend>Vedio's :-</legend>
                                            <div class="continar">
                                                <div class="row row-sm mb-5 vedio">
                                                    <!-- Cheack Button -->
                                                    <div class="col-md-3">
                                                        <label class="form-label mg-b-0">Vedio Link</label>
                                                    </div>
                                                    <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                        <input class="form-control attchUrl" type="text" name="vedios[0][url]" >
                                                    </div>
                                                    <div class="col-md-3 mg-t-2 mg-md-t-0">
                                                        <p>
                                                            ???????? ???????? ???????? ???????????? ???? ???????? ????pdf
                                                            ???????? ???? ?????? :-
                                                            https://www.youtube.com/watch?v=0GwYU6xaTcU
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row row-sm mb-5 vedio">
                                                    <!-- Cheack Button -->
                                                    <div class="col-md-3">
                                                        <label class="form-label mg-b-0">Description</label>
                                                    </div>
                                                    <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                        <input class="form-control attachDesc" type="text" name="vedios[0][desc]" >
                                                    </div>
                                                    <div class="col-md-3 mg-t-2 mg-md-t-0">
                                                        <p>
                                                            ???????? ???????? ???????? ???????????? ???? ???????? ????pdf
                                                            ???????? ???? ?????? :-
                                                            https://www.youtube.com/watch?v=0GwYU6xaTcU
                                                        </p>
                                                    </div>
                                                </div>
                                                <input class="vedioId" name="vedios[0][id]" type="hidden" value="0">
                                                <input class="vedioVewis" name="vedios[0][views]" type="hidden" value="0">
                                                <button type="button" onclick="removeElement()"  class="btn btn-danger pd-x-30 mg-r-5 mg-t-5 delBtn" data-count="0">Delete</button>
                                                <hr>
                                            </div>
                                        </fieldset>
                                        <div class="row row-sm mb-5">
                                            <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                <button class="btn btn-primary vedioButton " type="button" data-acount="0" >Add More</button>
                                            </div>
                                        </div>
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
        function removeElement() {
          $('.delBtn').click(function(){
              console.log('sss')
              $(this).closest('.continar').remove();
          });

      }
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function select2(element) {
            $('.'+element).select2({
                placeholder: 'choose attachment',
                ajax: {
                    url: "{{route('admin.attach.dropdown')}}",
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
        }
        $(document).ready(function() {
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
            select2('attch')
            $(function(){
                function attachCount(event){
                    var _this = $(this);

                    var rows = (typeof _this.data('acount') == undefined || typeof _this.data('acount') == "undefined") ? rows : _this.data('acount');

                    $('#'+event.data.element).append($('.attchClass').first().clone());

                    $(_this).data('acount',rows+1);

                    var lastRow = $('#'+event.data.element+' .'+event.data.parent+':last');

                    lastRow.find('.'+event.data.holder).remove()

                    lastRow.find('.'+event.data.appendTo).append(`<select class="js-example-basic-single form-control attch" name="attch[${rows+1}]"></select>`);

                    select2('attch')
                }
                $('.attchButton').on('click', {
                        element:'attch',
                        holder:'inputHolder',
                        appendTo:'attchInput',
                        parent:'attchClass',
                    }, attachCount);

                function vedioCount(event){
                    var _this = $(this);

                    var rows = (typeof _this.data('acount') == undefined || typeof _this.data('acount') == "undefined") ? rows : _this.data('acount');

                    $('#'+event.data.element).append($('.continar').first().clone());

                    $(_this).data('acount',rows+1);

                    var lastRow = $('#'+event.data.element+' .'+event.data.parent+':last');

                    lastRow.attr('id', `element-${rows+1}`);
                    lastRow.find('.attchUrl').attr('name', `vedios[${rows+1}][url]`).val('');
                    lastRow.find('.attachDesc').attr('name', `vedios[${rows+1}][desc]`).val('');
                    lastRow.find('.vedioId').attr('name', `vedios[${rows+1}][id]`).val(rows+1);
                    lastRow.find('.vedioVewis').attr('name', `vedios[${rows+1}][views]`);
                    lastRow.find('.delBtn').data('count',rows+1);
                    lastRow.find('.delBtn').attr('id',`delBtn-${rows+1}`);
                }
                $('.vedioButton').on('click',{
                    element:'holder',
                    holder:'continar',
                    appendTo:'vedio',
                    parent:'continar',
                },vedioCount);

            });
            $('.B-0').click(function(){
                var count = $('.B-0').data('acount');
                var element = $(".A-0").clone();
                element.addClass("A-"+count).removeClass('A-0');
                element.appendTo('.holder');
            });

        });
    </script>
    <!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
@endsection
