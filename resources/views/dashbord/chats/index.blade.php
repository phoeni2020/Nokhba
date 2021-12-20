@extends('dashbord.layouts.master')
@section('page-header')
    @php
        $tableConfig = [
                'filter'=>true,
                'actionUrl'=>route('admin.chats.fillTableChat'),
                'hasActions' => true,
                'tableHeaed'=>['Id','Full Name','Is Readed','Actions'],
                'tableColumnsNames'=>json_encode(['id','fullName','read','actions']),
                'tableColumnsData'=> json_encode([
                                                    ['data'=>'id'],['data'=>'fullName'],['data'=>'read'],
                                                    ['data'=>'actions','responsivePriority' => -1]
                                                 ]),
                'tableColumnDefs' => [
                       'label'=>  [
                                        ['targets' => 1, 'orderable' => "true", 'column'=>'name','columnLabel'=>'status','link'=>'#']
                                  ]
                                  ],
                'customActions' => json_encode([[
                    'linkColumn' => 'showStudent','attributes'=> "class='showData modal-effect btn btn-sm btn-clean btn-icon'
                                                               title='add product details'
                                                               data-toggle='modal'
                                                               data-target='#modaldemo8'
                                                               data-effect='effect-super-scaled'
                                                               ",'icon'=>"fas fa-cog"],])
            ];
        $filterConfig = ['inputs' => [
                    ['lable' => 'Name Arabic','type' => 'text','placeholder'=>'Name Arabic','name' => 'name'],
                    ['lable' => 'Email','type' => 'text','placeholder'=>'Email','name' => 'email'],
                    ['lable' => 'id','type' => 'text','placeholder'=>'ID','name' => 'id'],
                ]
        ];
    @endphp
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Students Page</h4>
                </div>
            </div>
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
                                Students DataTable
                            </p>
                        </div>
                        <div class="text-wrap">
                            <div class="example">
                                <div class="panel panel-primary tabs-style-2">
                                    <div class="table-responsive">
                                        <x-table-filter :filterConfig="$filterConfig"/>
                                        <x-data-table :tableConfig="$tableConfig"/>
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
