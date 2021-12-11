@extends('dashbord.layouts.master')
@section('page-header')
    @php
    $fullName = $user->fullname();
    @endphp
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Student's</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$fullName}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row row-sm">
        <!-- Col -->
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{$fullName}}</h5>
                                    <p class="main-profile-name-text">{{$user->student == 1 ? 'Student' : $user->role }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col mb20">
                                    <h5>{{$totalViews}}</h5>
                                    <h6 class="text-small text-muted mb-0">Total Views</h6>
                                </div>
                                <div class="col-md-4 col mb20">
                                    <h5>{{$totalQrCodes}}</h5>
                                    <h6 class="text-small text-muted mb-0">Total Owned QR Codes</h6>
                                </div>
                                <div class="col-md-4 col mb20">
                                    <h5>{{$totalEnrolledLessons}}</h5>
                                    <h6 class="text-small text-muted mb-0">Total Enrolled Lesson </h6>
                                </div>
                            </div>
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label tx-13 mg-b-25">
                        Conatct
                    </div>
                    <div class="main-profile-contact-list">
                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>Mobile</span>
                                <hr>
                                <div>
                                    {{$user->phone}}
                                </div>
                            </div>

                        </div>
                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>Parent Mobile</span>
                                <hr>
                                <div>
                                    {{$user->parentPhone}}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-success-transparent text-success">
                                <i class="icon ion-logo-slack"></i>
                            </div>
                            <div class="media-body">
                                <span>E-mail</span>
                                <hr>
                                <div>
                                    {{$user->email}}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-info-transparent text-info">
                                <i class="icon ion-md-locate"></i>
                            </div>
                            <div class="media-body">
                                <span>Current Address</span>
                                <div>
                                    San Francisco, CA
                                </div>
                            </div>
                        </div>
                    </div><!-- main-profile-contact-list -->
                </div>
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label tx-13 mg-b-25">
                        صفحات تهمك
                    </div>
                    <div class="main-profile-contact-list">

                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>الدروس و المشاهدات</span>
                                <hr>
                                <div>
                                    <a href="{{route('admin.user.view.lesson',$user->id)}}">عرض مشاهدات الدروس</a>
                                </div>
                            </div>

                        </div>

                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>QrCodes</span>
                                <hr>
                                <div>
                                    <a href="{{route('qrcodes.student',$user->id)}}">عرض الـqrcodes</a>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-success-transparent text-success">
                                <i class="icon ion-logo-slack"></i>
                            </div>
                            <div class="media-body">
                                <span>الامتحانات و النتائج</span>
                                <hr>
                                <div>
                                    <a href="{{route('examPage',$user->id)}}">عرض الامتحانات</a>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-info-transparent text-info">
                                <i class="icon ion-md-locate"></i>
                            </div>
                            <div class="media-body">
                                <span>Current Address</span>
                                <div>
                                    San Francisco, CA
                                </div>
                            </div>
                        </div>
                    </div><!-- main-profile-contact-list -->
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @php
                $tableConfig = [
                        'filter'=>true,
                        'actionUrl'=>route('admin.exam.datatable'),
                        'tableHeaed'=>['Id','grade','done','student'],
                        'tableColumnsNames'=>json_encode(['id','grade','done','student']),
                        'tableColumnsData'=> json_encode([
                                                            ['data'=>'id'],['data'=>'grade'],
                                                            ['data'=>'done'],['data'=>'student'],
                                                         ]),
                    ];
                $filterConfig = ['inputs' => [
                            ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'name'],
                        ]
                ];
            @endphp
            <div class="container-fluid">
                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    <p class="label">
                                        {{$fullName}}  Exams
                                    </p>
                                </div>
                                <div class="text-wrap">
                                    <div class="example">
                                        <div class="panel panel-primary tabs-style-2">
                                            <div class="table-responsive">
                                                <x-table-filter :filterConfig="$filterConfig" />
                                                <x-data-table :tableConfig="$tableConfig" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Col -->
    </div>
@endsection

