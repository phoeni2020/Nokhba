@extends('dashbord.layouts.master')

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Update Center {{ $center->name ??'' }}</h4>
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
                        <form action="{{route('admin.teachers.center.update',$center->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div id="holder">
                                <div class="card-body A">
                                    <h3 class="mg-b-20">Center Information</h3>
                                    <div class="pd-30 pd-sm-40 bg-gray-200">
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Name</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control linksUrl" placeholder="Enter Center Name" name="name" value="{{$center->name ?? ''}}" type="text">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Address</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control linksTitle" placeholder="Enter Address" required name="address" value="{{$center->address ?? ''}}" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-10 mt-10">
                            <div class="card-body">
                                <div class="pd-30 pd-sm-40 ">
                                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
