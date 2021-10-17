@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.lessons.dataTables'),
            'tableHeaed'=>['Id','Lesson Title','Description','Videos','Thumbnails','Created At','Updated Date'],
            'tableColumnsNames'=>json_encode(['id','title','description','img','vedios','created_at','updated_at']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'title'],['data'=>'description'],['data'=>'img'],
                                                ['data'=>'vedios'],
                                                ['data'=>'created_at'],['data'=>'updated_at'],
                                             ]),
        ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Title Arabic','type' => 'text','placeholder'=>'Title Arabic','name' => 'title'],
                ]
        ];
        $buttonsSettings = [
        'add' => ['lable'=>'Add New Lesson','link'=>route('admin.lessons.create')]
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

