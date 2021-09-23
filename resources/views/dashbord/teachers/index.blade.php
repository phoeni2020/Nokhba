@extends('dashbord.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'actionUrl'=>route('admin.teachers.dataTables'),
            'tableHeaed'=>['Id','Name'],
            'tableColumnsNames'=>json_encode(['id','name']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],['data'=>'name'],
                                             ]),
        ];
    @endphp
    <div class="row row-sm">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Basic Style2 Tabs
                    </div>
                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
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

