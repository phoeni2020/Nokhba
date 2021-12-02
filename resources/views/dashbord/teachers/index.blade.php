@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'hasActions' => true,
            'actionUrl'=>route('admin.teachers.dataTables'),
            'tableHeaed'=>['Id','Teacher Name','Long Description','Short Description','Image','Subject','Vedio','Regstrierd At','Ban'],
            'tableColumnsNames'=>json_encode([
                                    'id','name','long_description','short_description',
                                    'image','subject','vedio','created_at','actions'
                                ]),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'name'],['data'=>'short_description'],
                                                ['data'=>'long_description'],
                                                ['data'=>'image'],
                                                ['data'=>'subject'],['data'=>'vedio'],
                                                ['data'=>'created_at'],
                                                 ['data'=>'actions','responsivePriority' => -1]
                                             ]),
                                             'tableColumnDefs' => [
                   'image'=>  [
                                    ['targets' => 4, 'orderable' => "true", 'column'=>'image', 'link'=>'#']
                              ]],
        ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'nickName'],
                ]
        ];
        $buttonsSettings = [
        'add' => ['lable'=>'Add New Catgory','link'=>route('admin.catgory.create')]
        ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Catgories Page</h4>
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
                                Catgories DataTable
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

