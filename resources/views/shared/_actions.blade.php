@if ($user->id != auth()->id())
@can('edit_'.$entity)
    <a href="{{ route($entity.'.edit', [str_plural($entity) => $id])  }}" class="btn btn-sm btn-light">
        ✏️ Edit</a>
@endcan

@can('delete_'.$entity)
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy', ['user' => $id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are you sure wanted to delete it?")']) !!}
    @csrf
    <button type="submit" class="btn-delete btn btn-sm btn-light">
        ❌
    </button>
    {!! Form::close() !!}
@endcan
@else

    @can('edit_'.$entity)
        <a href="{{ route($entity.'.edit', [str_plural($entity) => $id])  }}" class="btn btn-sm btn-light">
            ✏️ Edit</a>
    @endcan

    @endif
