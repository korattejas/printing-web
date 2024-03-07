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
</div>
@endif
