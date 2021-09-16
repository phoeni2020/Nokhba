@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'actionUrl'=>route('admin.course.dataTables'),
            'tableHeaed'=>['Id','Course Name','Created Date','Updated Date'],
            'tableColumnsNames'=>json_encode(['id','name','created_at','updated_at']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'name'],
                                                ['data'=>'created_at'],['data'=>'updated_at'],
                                             ]),
        ];
    @endphp
    <div class="row row-sm">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">

                    </div>
                    <p class="mg-b-20"></p>
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
        <!-- /div -->
    </div>

@endsection

