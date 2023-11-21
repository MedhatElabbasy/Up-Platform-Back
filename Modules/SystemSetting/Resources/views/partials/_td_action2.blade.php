<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button"
            id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
        {{trans('common.Action')}}
    </button>
    <div class="dropdown-menu dropdown-menu-right"
         aria-labelledby="dropdownMenu2">
        @if (permissionCheck('consultant.secretLogin'))
            <a class="dropdown-item" href="{{route('secretLogin', $query->id)}}"
               type="button">{{trans('common.Secret Login') }}</a>
        @endif
        @if (permissionCheck('consultant.edit'))
            @if (isModuleActive('Appointment'))
                <a class="dropdown-item" target="_blank"
                   href="{{route('appointment.consultant.edit', [$query->id])}}"> {{trans('common.Edit')}}
                </a>
            @else

                <button data-item-id="{{$query->id}}"
                        class="dropdown-item editconsultant"
                        type="button">{{trans('common.Edit')}}
                </button>
            @endif
        @endif

        @if (permissionCheck('consultant.delete'))
            <button class="dropdown-item deleteconsultant"
                    data-id="{{$query->id}}"
                    type="button">{{trans('common.Delete')}}
            </button>
        @endif


    </div>
</div>
