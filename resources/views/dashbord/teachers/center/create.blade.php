@extends('dashbord.layouts.master')

@section('page-header')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Create Center</h4>
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
                        <form action="{{route('admin.teahcer.center.store')}}" method="post">
                            @csrf
                            <div id="holder">
                                <div class="card-body A">
                                    <h3 class="mg-b-20">Center Information</h3>
                                    <div class="pd-30 pd-sm-40 bg-gray-200">
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Name</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control linksUrl" placeholder="Enter Center Name" name="center[0][name]" type="text">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Address</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control linksTitle" placeholder="Enter Address" required name="center[0][address]" type="text">
                                            </div>
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
                                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
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
            $(function(){
                function attachCount(){
                    var _this = $(this);

                    var rows = (typeof _this.data('acount') == undefined || typeof _this.data('acount') == "undefined") ? rows : _this.data('acount');

                    $('#holder').append($('.A').first().clone());


                    $(_this).data('acount',rows+1);

                    var lastRow = $('#holder .A:last');

                    lastRow.removeClass('.A').addClass('A'+$(_this).data('acount'))
                    lastRow.find('.dropify-wrapper').remove();
                    lastRow.find('.linksTitle').attr('name', `center[${rows+1}][address]`).val('');
                    lastRow.find('.linksUrl').attr('name', `center[${rows+1}][name]`).val('');
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
    </script>
@endsection
