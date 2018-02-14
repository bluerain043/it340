@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="/">{{ (Auth::user() != null) && (Auth::user()->is_admin == 1) ? 'Admin ' : '' }} Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
@endsection
@section('content')
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title"> Admin Dashboard
                <small>room, users, schedule, inventory</small>
            </h1>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject bold uppercase font-dark">Classrooms</span>
                                    <span class="caption-helper">click to view classrooms</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="mt-element-list">
                                    <div class="mt-list-head list-default green-haze">
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <div class="list-head-title-container">
                                                    <h3 class="list-title uppercase sbold">Classroom List</h3>
                                                    <div class="list-date">{{  \Carbon\Carbon::now()->format('l j F Y')  }}</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mt-list-container list-default">
                                        <ul>
                                            @if(count($allRooms) > 0)
                                                @foreach($allRooms as $room)
                                                    <li class="mt-list-item">
                                                        <div class="list-icon-container done">
                                                            <a href="javascript:;">
                                                                <i class="icon-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="list-datetime"> {{ Carbon\Carbon::parse($room->created_at)->format('j F Y') }}
                                                            {{--<br> 8 Nov--}} </div>
                                                        <div class="list-item-content">
                                                            @foreach ($allRooms as $room)
                                                                @foreach ($schedules as $schedule)
                                                                    @if($room->room == $schedule->room)
                                                                    <h3 class="uppercase bold">
                                                                        <a href="{{action('RoomController@room_view_edit_schedule', compact('room', 'schedule'))}}">{{$room->room_name}}</a>
                                                                        {{--<a href="{{action('RoomController@room_view_edit', compact('room'))}}">{{$room->room_name}}</a>--}}
                                                                    </h3>
                                                                    <p>{{$room->facilitator}}</p>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach


                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="mt-list-item">
                                                    <div class="list-icon-container">
                                                        <a href="javascript:;">
                                                            <i class="icon-close"></i>
                                                        </a>
                                                    </div>
                                                    <div class="list-item-content">
                                                        <h3 class="uppercase bold">
                                                            <a href="{{action('RoomController@add_room')}}">No Room to Display</a>
                                                        </h3>
                                                        <p>please add a room</p>
                                                    </div>
                                                </li>

                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption ">
                                <span class="caption-subject font-dark bold uppercase">Inventory</span>
                                <span class="caption-helper">System Unit, Software, Hardware ...</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="mt-element-list">
                                <div class="mt-list-head list-default green-haze">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <div class="list-head-title-container">
                                                <h3 class="list-title uppercase sbold">Inventory List</h3>
                                                <div class="list-date">{{  \Carbon\Carbon::now()->format('l j F Y')  }}</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-list-container list-default">
                                    <ul>
                                        @if(count($allRooms) > 0)
                                            @foreach($allRooms as $room)
                                                <li class="mt-list-item">
                                                    <div class="list-icon-container done">
                                                        <a href="javascript:;">
                                                            <i class="icon-check"></i>
                                                        </a>
                                                    </div>
                                                    <div class="list-datetime"> {{ Carbon\Carbon::parse($room->created_at)->format('j F Y') }}
                                                        {{--<br> 8 Nov--}} </div>
                                                    <div class="list-item-content">
                                                        <h3 class="uppercase bold">
                                                            <a href="{{action('InventoryController@view_list', compact('room'))}}">Software</a>
                                                        </h3>
                                                        <p>{{$room->room_name}}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="mt-list-item">
                                                <div class="list-icon-container">
                                                    <a href="javascript:;">
                                                        <i class="icon-close"></i>
                                                    </a>
                                                </div>
                                                <div class="list-item-content">
                                                    <h3 class="uppercase bold">
                                                        <a href="{{action('RoomController@add_room')}}">No Data to Display</a>
                                                    </h3>
                                                    <p>please process to add entries for inventory</p>
                                                </div>
                                            </li>

                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"><!--start user -->
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Users</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="mt-comments">
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <div class="mt-comment mt-user-{{$user->id}}">
                                                <div class="mt-comment-img">
                                                    <img alt="" class="img-circle" src="{{asset('assets/layouts/layout/img/avatar.png')}}"></div>
                                                <div class="mt-comment-body">
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author">{{ucwords($user->name)}}</span>
                                                        <span class="mt-comment-date"> {{ Carbon\Carbon::parse($user->created_at)->format('j F Y') }}</span>
                                                    </div>
                                                    <div class="mt-comment-text"> Email Address: {{ $user->email }}. </div>
                                                    <div class="mt-comment-details actions">
                                                        <span class="mt-comment-status mt-comment-status-pending">{{($user->status == 1) ? 'Active' : 'Inactive'}}</span>
                                                        <ul class="mt-comment-actions">
                                                            @if(Auth::user()->is_admin == 1)
                                                            <li>
                                                                <a href="javascript:void(0);" class="edit-user" data-userid="{{$user->id}}">Quick Edit</a>
                                                            </li>
                                                          @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
             </div><!--end user -->

                <div class="row"><!--start schedule -->
                    <div class="col-lg-6 col-xs-12 col-sm-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class="icon-bubbles font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Schedule</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="mt-comments">
                                        @if(count($schedules) > 0)
                                            @foreach($schedules as $schedule)
                                                <div class="mt-comment schedule-box-{{$schedule->schedule}}">
                                                    <div class="mt-comment-img">
                                                        <img alt="" class="img-circle" src="{{asset('assets/layouts/layout/img/avatar.png')}}"></div>
                                                    <div class="mt-comment-body">
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author">{{ucwords($schedule->subject)}}</span>
                                                            <span class="mt-comment-date"> {{ucwords($schedule->day)}}</span>
                                                        </div>
                                                        <div class="mt-comment-text"> {{ucwords($schedule->teacher)}} </div>
                                                        <div class="mt-comment-details">
                                                            <span class="mt-comment-status mt-comment-status-pending">{{($schedule->status == 1) ? 'Active' : 'Inactive'}}</span>
                                                            <ul class="mt-comment-actions">
                                                                <li>
                                                                    <a href="javascript;" class="edit-schedule" data-schedule="{{$schedule->schedule}}">Quick Edit</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end schedule -->

<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-hidden="true">
    {{--@include('modals/edit_user_modal')--}}
</div>

<div class="modal fade bs-modal-lg" id="editSchedule" tabindex="-1" role="dialog" aria-hidden="true">
    {{--@include('modals/edit_schedule.blade.php')--}}
</div>
@endsection
@section('page_script')
    <script type="application/x-javascript">
        $('document').ready(function(){
            var schedule = '';
            $('.actions').on('click', '.edit-user', function () {
                var user = $(this).data('userid');
                $.post("{{ action('UserController@get_user_data') }}", {_token:'{{ csrf_token() }}', user:user}, function(result){
                    $('#editUser').modal('show');
                    $('#editUser').html(result.html);
                });
            });
            $('#editUser').on('click', '.user-delete', function(){ console.log('sdgsdgs');
                var user = $(this).data('userid');
                $.post("{{ action('UserController@delete_user') }}", {_token:'{{ csrf_token() }}', user:user}, function(result){
                    if(result.status == 'ok'){
                        $('.mt-user-'+user).remove();
                        $('#editUser').modal('hide');
                    }

                });
            });

            $('.mt-comments').on('click', '.edit-schedule', function(e){
                e.preventDefault();
                schedule = $(this).data('schedule');
                $.post("{{ action('ScheduleController@get_schedule_details') }}", {_token:'{{ csrf_token() }}', schedule:schedule}, function(result){
                    if(result.status == 'ok') {
                        $('#editSchedule').html(result.html);
                        $('#editSchedule').modal('show');
                    }
                });
            });//schedule-box-

            $('#editSchedule').on('click', '.update-schedule', function(){
                $form = $('#update-schedule-form');
                url = $form.attr('action');
                data = $form.serialize();
                $.post(url, data, function(result){
                    if(result.errors){
                        $('.danger-edit-error').removeClass('hide');
                        html = '';
                        $.each(result.errors, function (index, data) {
                            html += '<li>'+data+'</li>';
                        });
                        $('.danger-edit-error ul').html(html);
                        setTimeout(function(){ $('.danger-edit-error').addClass('hide'); }, 1000);
                    }else if(result.status == 'ok'){
                        $('.success-edit-msg').removeClass('hide');
                        $('.success-edit-msg .msg').html('Schedule is Updated Successfully');
                        setTimeout(function(){ location.reload(); }, 1000);
                    }
                });
            });
        });

    </script>
@endsection
