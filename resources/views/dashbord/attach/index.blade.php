@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.attach.dataTables'),
            'tableHeaed'=>['Id','Attachment Name','Attachment Description','Created Date','Updated Date'],
            'tableColumnsNames'=>json_encode(['id','title','desc','created_at','updated_at']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'title'],['data'=>'desc'],
                                                ['data'=>'created_at'],['data'=>'updated_at'],
                                             ]),
            ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Attachment title','type' => 'text','placeholder'=>'Attachment title','name' => 'title'],
                    ['lable' => 'Attachment Description','type' => 'text','placeholder'=>'Attachment Description','name' => 'description'],
                ]
            ];
        $buttonsSettings = [
                'add' => ['lable'=>'Add New Attachment','link'=>route('admin.attach.create')]
            ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Attachments Page</h4>
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
                                Attachments DataTable
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

