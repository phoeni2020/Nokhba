@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.catgory.dataTables'),
            'tableHeaed'=>['Id','Category Name','Description','Created At','Updated Date'],
            'tableColumnsNames'=>json_encode(['id','name','desc','created_at','updated_at']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'name'],['data'=>'desc'],
                                                ['data'=>'created_at'],['data'=>'updated_at'],
                                             ]),
        ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'name'],
                ]
        ];
        $buttonsSettings = [
        'add' => ['lable'=>'Add New Catgory','link'=>route('admin.catgory.create')]
        ];
    @endphp
    <div class="row row-sm">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <x-button-setting :buttonsSettings="$buttonsSettings"/>
                    </div>
                    <p class="mg-b-20"></p>
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
        <!-- /div -->
    </div>

@endsection

