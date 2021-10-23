@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.teachers.links.dataTables'),
            'tableHeaed'=>['Id','`Link`','Title','Hint','Image'],
            'tableColumnsNames'=>json_encode(['id','url','title','hint','img']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'url'],['data'=>'title'],
                                                ['data'=>'hint'],['data'=>'img'],

                                             ]),
            'tableColumnDefs' => [
                  'image'=>  [
                                    ['targets' => 4, 'orderable' => "true", 'column'=>'img', 'link'=>'url'],
                              ],
                  'link'=>  [
                            ['targets' => 1, 'orderable' => "true", 'column'=>'url', 'link'=>'url']
                      ]
                              ]
        ];
        $buttonsSettings = [
              'add' => ['lable'=>'Add New Link','link'=>route('admin.teachers.links.add')]
        ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Links Page</h4>
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
                                Links DataTable
                            </p>
                        </div>
                        <div class="text-wrap">
                            <div class="example">
                                <div class="panel panel-primary tabs-style-2">
                                    <div class="table-responsive">
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
