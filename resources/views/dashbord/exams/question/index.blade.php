@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'hasActions' => true,
            'actionUrl'=>route('admin.exam.question.fillTableQuestion'),
            'tableHeaed'=>['Id','question','Grade','Created At','Actions'],
            'tableColumnsNames'=>json_encode(['id','question','grade','created_at','actions']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'question'],
                                               ['data'=>'grade'],
                                                ['data'=>'created_at'],
                                                ['data'=>'actions','responsivePriority' => -1]
                                             ]),
/*           'tableColumnDefs' => [
                   'image'=>  [
                                    ['targets' => 3, 'orderable' => "true", 'column'=>'img', 'link'=>'#']
                              ]],*/
        ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Title Arabic','type' => 'text','placeholder'=>'Title Arabic','name' => 'title'],
                ]
        ];
        $buttonsSettings = [
          'add' => ['lable'=>'Add New Question','link'=>route('admin.exam.question.create')],
          'back' => ['lable'=>'Back'],
        ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Lessons Page</h4>
                </div>
            </div>
            <x-button-setting :buttonsSettings="$buttonsSettings"/>
        </div>
        @if(Session::has('message'))
            <p class="alert {{ Session::get('message_class', 'alert-success') }}">
                {{ Session::get('message') }}
            </p>
        @elseif(Session::has('errorMessage'))
            <p class="alert {{ Session::get('message_class', 'alert-danger')}}">
                {{ Session::get('errorMessage') }}
            </p>
        @endif
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <p class="label">
                                Lessons DataTable
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

