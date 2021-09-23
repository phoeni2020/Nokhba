@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'filter'=>true,
            'actionUrl'=>route('admin.course.dataTables'),
            'tableHeaed'=>['Id','Course Name','Created Date','Updated Date'],
            'tableColumnsNames'=>json_encode(['id','name','created_at','updated_at']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'name'],
                                                ['data'=>'created_at'],['data'=>'updated_at'],
                                             ]),
            ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Course Name','type' => 'text','placeholder'=>'Course Name','name' => 'name'],
                    ['lable' => 'Course Name','type' => 'text','placeholder'=>'Course Name','name' => 'name'],
                    ['lable' => 'Course Name','type' => 'text','placeholder'=>'Course Name','name' => 'name'],
                ]
            ];
        $buttonsSettings = [
                'add' => ['lable'=>'Add New Course','link'=>route('admin.catgory.create')]
            ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Courses Page</h4>
                </div>
            </div>
            <x-button-setting :buttonsSettings="$buttonsSettings"/>
        </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                          <p class="label">
                              Courses DataTable
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

