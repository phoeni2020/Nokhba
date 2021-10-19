@extends('dashbord.layouts.master')
@section('page-header')
    @php
        $tableConfig = [
                'filter'=>true,
                'actionUrl'=>route('admin.students.fillTableUser'),
                'hasActions' => true,
                'tableHeaed'=>['Id','Full Name','Email','Phone','Parent Phone','Created At','Actions'],
                'tableColumnsNames'=>json_encode(['id','fullName','email','phone','parentPhone','created_at','actions']),
                'tableColumnsData'=> json_encode([
                                                    ['data'=>'id'],['data'=>'fullName'],['data'=>'email'],['data'=>'phone'],
                                                    ['data'=>'parentPhone'],
                                                    ['data'=>'created_at'],
                                                    ['data'=>'actions','responsivePriority' => -1]
                                                 ]),
                'tableColumnDefs' => [
                       'link'=>  [
                                        ['targets' => 1, 'orderable' => "true", 'column'=>'name', 'link'=>'#']
                                  ]],
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
                ]
        ];
        $buttonsSettings = [
        'add' => ['lable'=>'Add New Catgory','link'=>route('admin.catgory.create')]
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

    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"></h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="button">Save changes</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('Scripts')
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).on('click','.showData',function(event) {
            event.preventDefault();
            let _this = $(this);
            var id = _this.attr('href');
            let request = $.ajax({
                "url": "{{route('admin.students.ajax.getuser')}}",
                "type": "POST",
                "dataType": "JSON",
                "data":
                    {
                        _token: CSRF_TOKEN,
                        id:id
                    },
            });
            request.done(function (response) {
                $('.modal-header').find('.modal-title').text(response.fName+' '+response.mName+ ' ' +response.lName);
            });

            request.fail(function (response) {
            });

        });
    </script>
@endpush


