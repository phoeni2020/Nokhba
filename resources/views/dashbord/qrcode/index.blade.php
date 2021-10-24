@extends('dashbord.layouts.master')

@section('page-header')
    @php
           $tableConfig = [
               'filter'=>true,
               'actionUrl'=>route('admin.qrCode.dataTables'),
               'tableHeaed'=>['Id','QrCode Image','Lesson Title','Created At'],
               'tableColumnsNames'=>json_encode(['id','qrUrl','lesson','created_at']),
               'tableColumnsData'=> json_encode([
                                                   ['data'=>'id'],['data'=>'qrUrl'],
                                                   ['data'=>'lesson'],['data'=>'created_at'],
                                                 ]),
              'tableColumnDefs' => [
                      'image'=>  [
                                       ['targets' => 1, 'orderable' => "true", 'column'=>'qrUrl', 'link'=>'#']
                                 ]],
           ];
           $filterConfig = ['inputs' => [
                       ['lable' => 'Title Arabic','type' => 'text','placeholder'=>'Title Arabic','name' => 'title'],
                       ['lable' => 'QrCode Text','type' => 'text','placeholder'=>'Title Arabic','name' => 'code_text'],
                   ]];
           $buttonsSettings = [
           'add' => ['lable'=>'Create New QrCodes','link'=>route('admin.qrcode.create')],
           'delete' => ['lable'=>'Used QrCodes','link'=>route('admin.used.qrCode')]
           ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">None Used QrCodes</h4>
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
                                None Used QrCodes DataTable
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

