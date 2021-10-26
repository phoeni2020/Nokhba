@extends('dashbord.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Add New Asstitant</h4>
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
                        @if($user->role == 'developer')
                        <form action="{{route('admin.app.developer.settings.store')}}" method="post" >
                            @csrf
                            <div class="card-body">
                                <h3 class="mg-b-20">Application Settings</h3>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    @foreach($array as $value)
                                        @if(in_array($value['key'],$whiteList))
                                            <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">{{$value['key']}}</label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" required name="{{$value['key']}}" value="{{$value['value']}}" type="text">
                                        </div>
                                    </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <hr class="mb-10 mt-10">
                            <div class="card-body">
                                <div class="pd-30 pd-sm-40 ">
                                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                                    <a href="{{url('/index')}}">
                                        <button class="btn btn-dark pd-x-30 mg-t-5" type="button">
                                            Cancel
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                        @elseif($user->role == 'admin')
                            <div class="card-body">
                                <h3 class="mg-b-20">Application Settings</h3>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    @foreach($array as $value)
                                        @if(in_array($value['key'],$whiteList))
                                            <div class="row row-xs align-items-center mg-b-20">
                                                <div class="col-md-4">
                                                    <label class="form-label mg-b-0">{{$value['key']}}</label>
                                                </div>
                                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" readonly value="{{$value['value']}}"  type="text">
                                        </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
@endsection
