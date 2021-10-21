@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.notifications.fillTableNotifications'),
            'tableHeaed'=>['Id','Title','Image','Thaumbnail','actionName','actionUrl'],
            'tableColumnsNames'=>json_encode(['id','title','img','thaumbnail','actionName','actionUrl']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'title'],['data'=>'img'],['data'=>'thaumbnail'],
                                                ['data'=>'actionName'],
                                                ['data'=>'actionUrl'],
                                             ]),
            'tableColumnDefs' => [
                  'image'=>  [
                                    ['targets' => 2, 'orderable' => "true", 'column'=>'img', 'link'=>'#'],
                                    ['targets' => 3, 'orderable' => "true", 'column'=>'thaumbnail', 'link'=>'#'],
                              ],
                  'link'=>  [
                            ['targets' => 5, 'orderable' => "true", 'column'=>'actionUrl', 'link'=>'actionUrl']
                      ]
                              ],];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'name'],
                ]
        ];
        $buttonsSettings = [
            'add' => ['lable'=>'Add New Catgory','link'=>route('admin.notifications.create')]
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

