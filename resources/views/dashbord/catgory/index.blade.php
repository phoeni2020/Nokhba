@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'hasActions' => true,
            'actionUrl'=>route('admin.catgory.dataTables'),
            'tableHeaed'=>['Id','Category Name','Description','Main','Is Parent','Created At','Updated Date','Actions'],
            'tableColumnsNames'=>json_encode(['id','name','desc','main','is_parent','created_at','updated_at','actions']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'name'],['data'=>'desc'],['data'=>'main'],
                                                ['data'=>'is_parent'],
                                                ['data'=>'created_at'],['data'=>'updated_at'],
                                                ['data'=>'actions','responsivePriority' => -1]
            ]),
        ];
        $filterConfig = [
            'inputs' => [
                    ['lable' => 'Name In Arabic','type' => 'text','placeholder'=>'Name In Arabic','name' => 'name'],
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

