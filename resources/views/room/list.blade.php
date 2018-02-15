@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="/">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>List of Rooms</span>
        </li>
    </ul>
@endsection
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> Add Room</h1>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default add-student-btn popovers" data-container="body" data-trigger="hover" data-placement="left"
               data-content="Add user" data-original-title="User" data-toggle="modal" href="#addUser">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">List of Rooms</span>
                    </div>
                </div>
                <div class="portlet-body tbl-pad">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button> {{ $message }}
                        </div>
                    @endif
                    <!-- BEGIN TABLE-->
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> Room Number </th>
                                <th> Room Name </th>
                                <th> Facilitator </th>
                                <th> Seatplan image </th>
                                <th> Status </th>
                                <th> Created </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($allRooms) > 0)
                                @foreach($allRooms as $room)
                                    <tr class="mt-room-{{$room->room}}">
                                        <td>{{ucwords($room->room_number)}}</td>
                                         <td>{{ucwords($room->room_name)}}</td>
                                        <td>{{ucwords($room->facilitator)}}</td>
                                        <td> {{($room->seatplan_image)}} </td>
                                        <td class="room-status-{{$room->room}}"> <span class="label label-sm {{ ($room->status == 1) ? 'label-info' : 'label-warning'}}"> {{($room->status) ? 'Active' : 'Inactive'}} </span> </td>
                                        <td> {{ Carbon\Carbon::parse($room->created_at)->format('d-m-Y') }} </td>
                                        <td>
                                            <div class="btn-group actions">
                                                <button type="button" class="btn btn-default edit-room" data-room="{{$room->room}}">Edit</button>
                                                @if( Auth::user()->is_admin == 1)
                                                <button type="button" class="btn btn-default delete-room" id="room-text-{{$room->room}}" data-room="{{$room->room}}">Delete</button>
                                                @endif
                                                {{--<a href="{{action('RoomController@room_view_edit' ,compact('room'))}}" class="btn btn-default">View</a>--}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr style="text-align: center">
                                    <td colspan="7"> No Schedule Entry</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- END TABLE-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Add Room Details</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="{{action('RoomController@post_add_room')}}" class="form-horizontal"  enctype="multipart/form-data" id="form_sample_1" novalidate="novalidate" method="POST">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <button class="close" data-close="alert"></button> {{ $message }}
                                        </div>
                                    @endif
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Name
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" name="room_name">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter room name</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Room Number
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" placeholder="Enter digits" name="room_number">
                                                <div class="form-control-focus"> </div>
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Facilitor
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" placeholder="" name="facilitator">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter name of room facilitor</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Seatplan image</label>
                                        <div class="col-md-7">
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                    <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="seatplan_image"> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                                <div class="clearfix margin-top-10">
                                                    <span class="label label-success">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                            </div>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Status</label>
                                        <div class="col-md-8">
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" id="optionsRadios25" value="1" name="status" checked> Active
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" id="optionsRadios26" value="0" name="status"> Inactive
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <button type="submit" class="btn green">Add</button>
                                            <button type="reset" class="btn default">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-lg" id="edit-room-modal" tabindex="-1" role="dialog" aria-hidden="true">
        {{--@include('modals/edit_room_modal)--}}
    </div>

    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p> Would you like to delete this room? <br><br>
                        NOTE: by delete you would delete all related data like student, specification, hardware, software and etc.!</p>
                    {{-- <form id="delete-schedule" action="{{ route('logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                     </form>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn green confirm-delete" {{--onclick="event.preventDefault(); document.getElementById('delete-schedule').submit();"--}}>Yes</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script type="application/x-javascript">
        $('document').ready(function () {
            var room = '';
            setTimeout(function(){
                $('.alert-danger').addClass('hide');
                $('.alert-success').addClass('hide');
            }, 2000);

           $('.actions').on('click', '.edit-room', function(e){
                e.preventDefault();
                room = $(this).data('room');
                $.post("{{ action('RoomController@get_room_details') }}", {_token:'{{ csrf_token() }}', room:room}, function(result){
                    $('#edit-room-modal').modal('show');
                    $('#edit-room-modal').html(result.html);
                });
            });

            $('.actions').on('click', '.delete-room', function(e){
                e.preventDefault();
                room = $(this).data('room');
                //status = $(this).data('status');
                $('#static').modal('show');
            });

            $('#static').on('click', '.confirm-delete' ,function(e) {
                e.preventDefault();
                $.post("{{ action('RoomController@post_delete_room') }}", {_token:'{{ csrf_token() }}', room:room}, function(result){
                    if(result.status == 'ok'){
                        $('tr.mt-room-'+room).remove();
                        /*if(result.data.status == 1){ console.log('active');
                            html = '<span class="label label-sm label-info"> Active </span>';
                            $('td > .actions').find('#room-text-'+room).html('Deactivate').attr('data-status', result.data.status);
                        }else{console.log('inactive ');
                            $('td > .actions').find('#room-text-'+room).html('Activate').attr('data-status', result.data.status);
                            html = '<span class="label label-sm label-warning"> Inactive </span>'
                        }
                        $('.room-status-'+room).html(html);*/
                    }
                });
            });
        });


    </script>
@endsection