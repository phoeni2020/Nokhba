<div class="card-toolbar">

    @if(isset($buttonsSettings['delete']))
    <!--begin::Button-->
        <a href="{!! $buttonsSettings['delete']['link'] !!}"  id="deleteSelected" class="btn btn-outline-danger font-weight-bolder color-primary mb-2 mb-sm-0 mr-2">
            <i class="icon-nm flaticon-delete"></i>
            {!! $buttonsSettings['delete']['lable'] !!}
        </a>
        <!--end::Button-->
    @endif

    @if(isset($buttonsSettings['view']))
        <!--begin::Button-->
            <a href="{!! $buttonsSettings['view']['link'] !!}"  id="deleteSelected" class="btn btn-outline-primary font-weight-bolder color-primary mb-2 mb-sm-0 mr-2">
                <i class="icon-nm flaticon-delete"></i>
                {!! $buttonsSettings['view']['lable'] !!}
            </a>
            <!--end::Button-->
        @endif

    @if(isset($buttonsSettings['actions']))
        <div class="dropdown dropdown-inline mr-2">
            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle mb-2 mb-sm-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs side-menu__icon"></i>
                {{ $buttonsSettings['actions']['buttonLabel'] }}</button>
            <!--begin::Dropdown Menu-->
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                <!--begin::Navigation-->
                <ul class="navi flex-column navi-hover py-2">
                    @foreach($buttonsSettings['actions']['actionsLinks'] as $actionData)
                        <li class="navi-item">
                            <a href="{{ $actionData['link'] }}"
                                {!! !empty($actionData['attributs']) ? $actionData['attributs'] : 'class="navi-link"' !!} >
                        <span class="navi-icon">
                            <i class="{{ $actionData['icon'] }}"></i>
                        </span>
                                <span class="navi-text">{{ $actionData['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <!--end::Navigation-->
            </div>
            <!--end::Dropdown Menu-->
        </div>
    @endif

    @if(isset($buttonsSettings['add']))
    <!--begin::Button-->
        <a href="{!! $buttonsSettings['add']['link'] !!}" class="btn btn-primary mb-2 mb-sm-0 mr-2">
            <i class="typcn typcn-plus"></i>
            {!! $buttonsSettings['add']['lable'] !!}
        </a>
        <!--end::Button-->
    @endif

    @if(isset($buttonsSettings['back']))
        <!--begin::Button-->
            <button type="button" onclick="window.history.back()" class="btn btn-outline-secondary mb-2 mb-sm-0 mr-2">
                <i class="far fa-arrow-alt-circle-left"></i>
                {!! $buttonsSettings['back']['lable'] !!}
            </button>
            <!--end::Button-->
        @endif

</div>
