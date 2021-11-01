@extends('dashbord.layouts.master')
@section('page-header')
    @php
        $tableConfig = [
                'filter'=>true,
                'actionUrl'=>route('admin.exam.datatable'),
                //'hasActions' => true,
                'tableHeaed'=>['Id','grade','done','student'],
                'tableColumnsNames'=>json_encode(['id','grade','done','student']),
                'tableColumnsData'=> json_encode([
                                                    ['data'=>'id'],['data'=>'grade'],
                                                    ['data'=>'done'],['data'=>'student'],
                                                   // ['data'=>'actions','responsivePriority' => -1]
                                                 ]),
            ];

        $filterConfig = ['inputs' => [
                    ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'name'],
                ]
        ];
        $buttonsSettings = [
            'add' => ['lable'=>'Add New Exam','link'=>route('admin.exam.create')],
            'view' => ['lable'=>'Add New Question','link'=>route('admin.exam.question.index')],
            ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Exams Page</h4>
                </div>
            </div>
            <x-button-setting :buttonsSettings="$buttonsSettings"/>
        </div>
        @if(Session::has('message'))
            <p class="alert {{ Session::get('message_class', 'alert-success') }}">
                {{ Session::get('message') }}
            </p>
        @endif
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <p class="label">
                                Exams DataTable
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

@endsection
@push('Scripts')
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endpush


