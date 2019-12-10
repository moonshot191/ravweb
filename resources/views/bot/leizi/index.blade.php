@extends('layouts.app', ['activePage' => 'leizi-management', 'titlePage' => __('Leizi Management')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $leizi->total() }} {{str_plural('Question',$leizi->count())}}</h4>
                            <p class="card-category"> {{ __('Here you can manage Leizi questions') }}</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    @can('add_leizis')
                                        <button  class="btn btn-warning btn-sm validate_all" data-url="{{ route('leizival') }}"><i class="material-icons">thumb_up</i>Validate</button>
                                        <button  class="btn btn-danger btn-sm delete_all" data-url="{{ route('leizidel') }}"><i class="material-icons">delete</i>Delete</button>
                                        <a href="{{ route('leizis.create') }}" class="btn btn-sm btn-info">{{ __('Upload questions') }}</a>
                                        <a href="{{ route('lexport') }}" class="btn btn-sm btn-success">{{ __('Export to CSV') }}</a>
                                        <a href="#" onclick="window.print()" class="btn btn-sm btn-warning"><i class="material-icons">print</i> Print</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="exampl">

                                    <thead class=" text-primary">
                                    <th width="80px">
                                        {{ __('#') }}
                                    </th>
                                    <th width="50px"><input type="checkbox" id="master"></th>
                                    <th>
                                        {{ __('Instructions') }}
                                    </th>
                                    <th>
                                        {{ __('Question') }}
                                    </th>
                                    <th>
                                        {{ __('Answer') }}
                                    </th>
                                    <th>
                                        {{ __('Alt-Answer') }}
                                    </th>
                                    <th>
                                        {{ __('Level') }}
                                    </th>
                                    <th>
                                        {{ __('Validated') }}

                                    </th>
                                    <th>
                                        {{ __('Validated by') }}

                                    </th>
                                    {{--                                    <th>--}}
                                    {{--                                        {{ __('Validation date') }}--}}

                                    {{--                                    </th>--}}

                                    <th>
                                        {{ __('Last edited by') }}
                                    </th>
                                    {{--                                    <th>--}}
                                    {{--                                        {{ __('Date edited') }}--}}
                                    {{--                                    </th>--}}
                                    <th>
                                        {{ __('Created by') }}

                                    </th>
                                    {{--                                    <th>--}}
                                    {{--                                        {{ __('Creation date') }}--}}
                                    {{--                                    </th>--}}
                                    <th class="text-right">
                                        @can('edit_leizis','delete_leizis')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>

                                    </thead>
                                    <tbody>
                                    @if($leizi->total()>0)
                                        @foreach($leizi  as $index =>$group)
                                            <tr id="tr_{{$group->id}}">
                                                <td>
                                                    <strong>{{ $index+1 }}.</strong>
                                                </td>
                                                <td><input type="checkbox" class="sub_chk" data-id="{{$group->id}}"></td>
                                                <td>
                                                    {{ $group->instruction}}
                                                </td>
                                                <td>
                                                    {{ $group->question}}
                                                </td>
                                                <td>
                                                    {{ $group->answer}}
                                                </td>
                                                <td>
                                                    {{ $group->alternative}}
                                                </td>
                                                <td>
                                                    @if($group->level==1)
                                                        <span class="badge badge-pill badge-primary">Elementary</span>
                                                    @elseif($group->level==2)
                                                        <span class="badge badge-pill badge-warning">Intermediate</span>
                                                    @elseif($group->level==3)
                                                        <span class="badge badge-pill badge-danger">Advanced</span>
                                                    @endif

                                                </td>
                                                @if($group->validated==0)
                                                    <td>

                                                        <span class="badge badge-pill badge-info">Not Validated</span>
                                                    </td>
                                                @else
                                                    <td>

                                                        <span class="badge badge-pill badge-danger">Validated</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if($group->validated_by==null)
                                                        <span class="badge badge-pill badge-info">No one</span>
                                                    @else
                                                        <a href="https://t.me/{{ $group->validated_by }}">{{ $group->validated_by }}</a>
                                                    @endif
                                                </td>


                                                <td>
                                                    @if($group->edited_by==null)
                                                        No one
                                                    @else
                                                        <a href="https://t.me/{{ $group->edited_by }}">{{ $group->edited_by }}</a>
                                                    @endif
                                                </td>

                                                <td><a href="https://t.me/{{ $group->username }}">{{ $group->username }}</a></td>
                                                {{--                                                <td>--}}
                                                {{--                                                    {{ $group->created_at }}--}}
                                                {{--                                                </td>--}}
                                                <td class="td-actions text-right">
                                                    {{--                              @include('shared._actions', ['entity' => 'users','id'=>$group->id])--}}

                                                    <form action="{{ route('africas.destroy', $group) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_africas')
                                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('africas.edit', $group) }}" data-original-title="" title="Edit">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_africas')
                                                            <button type="button" class="btn btn-danger btn-link" data-toggle="tooltip" rel="tooltip" title="Delete" onclick="confirm('{{ __("Are you sure you want to delete this question?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                        <button type="button" class="btn btn-danger btn-link" data-toggle="modal" data-target=".bd-example-modal-lg" rel="tooltip" title="View" >
                                                            <i class="material-icons">chat</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                        {{--    -    modal--}}
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <form action="" method="post">
                                                        @csrf
                                                        {{--                                                        @method('post')--}}
                                                        <div class="modal-header card-header card-header-danger">
                                                            <h5 class="modal-title" id="exampleModalLabel">View question</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Instructions') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"  value="{{ old('question',$group->instruction) }}"  disabled>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Question') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"  value="{{ old('question',$group->question) }}"  disabled>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Answer') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"  value="{{ old('question',$group->answer) }}"  disabled>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Alt-Answer') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"  value="{{ old('question',$group->alternative) }}"  disabled>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Level') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->level==1)
                                                                            <span class="badge badge-pill badge-primary">Elementary</span>
                                                                        @elseif($group->level==2)
                                                                            <span class="badge badge-pill badge-warning">Intermediate</span>
                                                                        @elseif($group->level==3)
                                                                            <span class="badge badge-pill badge-danger">Advanced</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Validated') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->validated==0)


                                                                            <span class="badge badge-pill badge-warning">False</span>

                                                                        @else


                                                                            <span class="badge badge-pill badge-danger">True</span>

                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Validated by') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->validated_by==null)
                                                                            <span class="badge badge-pill badge-warning">No one</span>
                                                                        @else
                                                                            <a href="https://t.me/{{ $group->validated_by }}">{{ $group->validated_by }}</a>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Validated on') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->validated_at==null)
                                                                            <span class="badge badge-pill badge-warning">No date</span>
                                                                        @else
                                                                            {{ $group->validated_at }}
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Last Edited by') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->edited_by==null)
                                                                            No one
                                                                        @else
                                                                            <a href="https://t.me/{{ $group->edited_by }}">{{ $group->edited_by }}</a>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Last edited on') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->updated_at==null)
                                                                            <span class="badge badge-pill badge-warning">No date</span>
                                                                        @else
                                                                            {{ $group->updated_at }}
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Created by') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <a href="https://t.me/{{ $group->username }}">{{ $group->username }}</a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Created on') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        {{ $group->created_at }}

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{$leizi->links()}}
                                    @else
                                        <td>
                                            <p>No Leizi created at the moment</p>
                                        </td>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#exampl').DataTable( {
                "stateSave": true,
                "ordering": true,
                "info":true,
                "paging":   true,
                "pagingType": "full_numbers"
            } );


            $('#master').on('click', function(e) {
                if($(this).is(':checked',true))
                {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked',false);
                }
            });


            $('.delete_all').on('click', function(e) {


                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });


                if(allVals.length <=0)
                {
                    alert("Please select question(s).");
                }  else {


                    var check = confirm("Are you sure you want to delete this question(s)?");
                    if(check == true){


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });



                    }
                }
            });

            $('.validate_all').on('click', function(e) {


                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });


                if(allVals.length <=0)
                {
                    alert("Please select question(s).");
                }  else {


                    var check = confirm("Are you sure you want to validate this question(s)?");
                    if(check == true){


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'PUT',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    setTimeout(function(){// wait for 5 secs(2)
                                        location.reload(); // then reload the page.(3)
                                    }, 1000);
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                    }
                }
            });







        } );
    </script>

@endsection
