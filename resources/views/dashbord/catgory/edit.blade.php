@extends('dashbord.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Update Catgory</h4>
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
                        <form action="{{route('admin.category.update',$catgory->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <h3 class="mg-b-20">Baisc Information About Catgory</h3>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Name</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" placeholder="Enter Category Name" name="name" value="{{$catgory['name']}}" type="text">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Description</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <textarea class="form-control" name="desc" id="" cols="30" rows="10">{{$catgory['desc']}}</textarea>
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
                                            <legend>Main Category :-</legend>
                                            <div class="row row-sm mb-5">
                                                <!-- Cheack Button -->
                                                <div class="col-md-3">
                                                    <label class="form-label mg-b-0">Is Main</label>
                                                </div>
                                                <div class="col-md-3 mg-t-2 mg-md-t-0">
                                                    <input type="checkbox" name="main" {{$catgory['main'] ==0 ? 'checked':''}}>
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
                                    <div class="form-group col-md-10 col-sm-6 col-xs-12">
                                        <fieldset>
                                            <legend>Is Parent :-</legend>
                                            {{--Main Category Start --}}
                                            <div class="row row-sm mb-5">
                                                <!-- Dropdown -->
                                                <div class="col-lg-3">
                                                    <label class="form-label mg-b-0">Main Category</label>
                                                </div>
                                                <div class="col-lg-3 mg-t-2 mg-md-t-0"
                                                >
                                                    <select class="js-example-basic-single form-control category" name="main_cat" id="main">
                                                            @if($catgory['is_parent'] != 0)
                                                                <option value="{{$catgory['main']}}">{{$catgory->mainCategories->name}}</option>
                                                            @endif
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 mg-t-2 mg-md-t-0">
                                                    <p>
                                                        هنا يتم اختيار التصنيف المرغوب بالوراثه منه علي سبيل المثال :-
                                                        <br>
                                                        تصنيف الباب الاول يرث من تصنيف الدورات
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="row row-sm mb-5">
                                                <!-- Dropdown -->
                                                <div class="col-lg-3">
                                                    <label class="form-label mg-b-0">Parent Category</label>
                                                </div>
                                                <div class="col-lg-3 mg-t-2 mg-md-t-0">
                                                    <select class="js-example-basic-single form-control category" name="parent" >
                                                        @if($catgory['is_parent'] != 0 )
                                                            <option value="{{$catgory['parent']}}">{{$catgory->parentCategories->name}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 mg-t-2 mg-md-t-0">
                                                    <p>
                                                        هنا يتم اختيار التصنيف المرغوب بالوراثه منه علي سبيل المثال :-
                                                        <br>
                                                        تصنيف الفصل اﻻول - مبادئ الفيزياء الكهربائيه يرث من تصنيف الباب اﻻول الفيزياء الكهربائيه
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row row-sm mb-5">
                                                <!-- Cheack Button -->
                                                <div class="col-md-3">
                                                    <label class="form-label mg-b-0">Is Parent</label>
                                                </div>
                                                <div class="col-md-3 mg-t-2 mg-md-t-0">
                                                    <input type="checkbox" name="is_parent" {{$catgory['is_parent']==1?'checked':''}} >
                                                </div>
                                                <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                    <p>
                                                        هذا يعني ان هذا التصنيف تصنيف فرعي قد يأتي بعد
                                                        تصنيف رئيسي أو تصنيف فرعي اخر و يوجد بعده عده
                                                        تصنيفات اخري علي سبيل المثال :-
                                                        <br>
                                                        الباب الاول الفيزياء الكهربائيه يأتي بعد منها الفصل اﻻول مبادئ الفيزياء الكهربائيه
                                                    </p>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-10 col-sm-6 col-xs-12">
                                        <fieldset>
                                            <legend>Has Parent :-</legend>
                                            <div class="row row-sm mb-5">
                                                <!-- Dropdown -->
                                                <div class="col-lg-3">
                                                    <label class="form-label mg-b-0">Parent</label>
                                                </div>
                                                <div class="col-lg-3 mg-t-2 mg-md-t-0">
                                                    <select class="js-example-basic-single form-control category" name="child">
                                                        @if($catgory['is_parent'] == 0)
                                                            <option value="{{$catgory['parent']}}">{{$catgory->parentCategories->name}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mg-t-2 mg-md-t-0">
                                                    <p>
                                                        هذا يعني ان هذا التصنيف تصنيف فرعي لا يأتي من بعده
                                                        اي تصنيفات فرعيه تاتي من بعده دروس او فيديوهات او مرفقات
                                                        تصنيفات اخري علي سبيل المثال :-
                                                        <br>
                                                        الفصل الاول مبادئ الفيزياء الكهربائيه يأتي بعد منه الدرس اﻻول في مبادئ الفيزياء الكهربيه
                                                    </p>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                    </div>
                                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Save</button>
                                    <a href="{{route('admin.catgory.index')}}">
                                        <button class="btn btn-dark pd-x-30 mg-t-5" type="button">
                                            Cancel
                                        </button>
                                    </a>
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
@endsection
