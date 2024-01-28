@if($action_array['is_simple_action']==1)
<div class="btn-icon-group" role="group" aria-label="Basic example">

    @if(isset($action_array['edit_route']))
    <a href="{{ $action_array['edit_route'] }}" class="btn btn-info btn-icon"
       data-toggle="tooltip" data-placement="top" title="EDIT">
        <i class="bx bx-pencil font-size-16 align-middle"></i>
    </a>
    @endif
    @if(isset($action_array['delete_id']))
    <button data-id="{{ $action_array['delete_id'] }}" class="delete-single btn btn-danger btn-icon"
            data-toggle="tooltip" data-placement="top" title="DELETE">
        <i class="bx bx-trash font-size-16 align-middle"></i>
    </button>
    @endif

    @if(isset($action_array['current_status']))
    @if($action_array['current_status']=='active')
    <button data-id="{{ $action_array['hidden_id'] }}" data-change-status="inactive"
            class="status-change btn btn-warning btn-icon" data-effect="effect-fall"
            data-toggle="tooltip" data-placement="top" title="InActive">
        <i class="bx bx-refresh font-size-16 align-middle"></i>
    </button>
    @else
    <button data-id="{{ $action_array['hidden_id'] }}" data-change-status="active"
            class="status-change btn btn-success btn-icon" data-effect="effect-fall"
            data-toggle="tooltip" data-placement="top" title="Active">
        <i class="bx bx-refresh font-size-16 align-middle"></i>
    </button>
    @endif
    @endif
    @if(isset($action_array['view_url']))
    <a href="{{ $action_array['view_url'] }}" class="btn btn-dark btn-icon"
       data-toggle="tooltip" data-placement="top" title="VIEW">
        <i class="bx bx-bullseye font-size-16 align-middle"></i>
    </a>
    @endif
</div>
@endif
