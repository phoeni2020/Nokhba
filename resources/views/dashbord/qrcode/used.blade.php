@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.qrUsedCode.dataTables'),
            'tableHeaed'=>['Id','QrCode Image','Lesson Title','Student','Created At','Valid Till'],
            'tableColumnsNames'=>json_encode(['id','qrUrl','lesson','student','created_at','valid_till']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'qrUrl'],
                                                ['data'=>'lesson'],['data'=>'student'],
                                                ['data'=>'created_at'],['data'=>'valid_till'],
                                                ]),
           'tableColumnDefs' => [
                   'image'=>  [
                                    ['targets' => 1, 'orderable' => "true", 'column'=>'qrUrl', 'link'=>'#']
                              ]],
        ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Title Arabic','type' => 'text','placeholder'=>'Title Arabic','name' => 'title'],
                ]];
        $buttonsSettings = [
                'view' => ['lable'=>'None Used QrCodes','link'=>route('admin.qrcode.index')],
        ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Used QrCodes</h4>
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
                                 Used QrCodes DataTable
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

