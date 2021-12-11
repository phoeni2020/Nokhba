@extends('front.layouts.master')
@section('css')
@endsection

@section('page-header')
    @php
        $tableConfig = [
            'actionUrl'=>route('admin.user.view.datatablelesson',$id),
            'tableHeaed'=>['المشاهدات','الدرس'],
            'tableColumnsNames'=>json_encode(['id','lesson','grade','resultLink']),
            'tableColumnsData'=> json_encode([
                                                ['data'=>'id'],
                                                ['data'=>'lesson'],
                                                ['data'=>'grade'],
                                                ['data'=>'resultLink']
                                                ]),
        ];
    @endphp
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-2">
                            <div class="table-responsive">
                                <x-data-table :tableConfig="$tableConfig"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

