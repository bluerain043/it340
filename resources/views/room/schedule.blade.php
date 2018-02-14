@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="/">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>List of Schedule</span>
        </li>
    </ul>
@endsection
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> Add Schedule</h1>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default add-student-btn popovers" data-container="body" data-trigger="hover" data-placement="left"
               data-content="Add schedule" data-original-title="Schedule" data-toggle="modal" href="#addSchedule">
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
                        <span class="caption-subject font-green sbold uppercase">List of Schedule</span>
                    </div>
                </div>
                <div class="portlet-body tbl-pad">
                    <!-- BEGIN TABLE-->
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> Subject </th>
                                <th> Day </th>
                                <th> Time </th>
                                <th> Room </th>
                                <th> Teacher </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody class="tschedule">
                            @if(count($schedules) > 0)
                                @foreach($schedules as $schedule)
                                    <tr class="tr-schedule-{{$schedule->schedule}}">
                                        <td>{{ucwords($schedule->subject)}}</td>
                                        <td>{{\App\Schedule::$days[$schedule->day]}}</td>
                                        <td>{{\App\Schedule::$time[$schedule->time]}}</td>
                                        <td> {{$schedule->room}} </td>
                                        <td> {{$schedule->teacher}} </td>
                                        <td>
                                            <span class="label label-sm {{($schedule->status == 1) ? 'label-info' : 'label-warning'}}"> {{($schedule->status == 1) ? 'Active' : 'Inactive'}} </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default edit-schedule" data-schedule="{{$schedule->schedule}}">Edit</button>
                                                <button type="button" class="btn btn-default delete-schedule" data-schedule="{{$schedule->schedule}}">Delete</button>
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

    <div class="modal fade bs-modal-lg" id="addSchedule" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Add Schedule Details</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="{{action('RoomController@post_schedule')}}" class="form-horizontal" id="form_sample_1" novalidate="novalidate" method="POST">
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
                                        <label class="col-md-2 control-label" for="form_control_1">Subject
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="subject">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter subject name</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Room
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="form_control_1" name="room">
                                                <option value=""></option>
                                                @foreach($allRooms as $room)
                                                    <option value="{{$room->room}}">{{$room->room_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Day(s)
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="form_control_1" name="day">
                                                <option value=""></option>
                                                @foreach(\App\Schedule::$days as $key=>$val)
                                                    <option value="{{$key}}">{{$val}}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Time
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="form_control_1" name="time">
                                                <option value=""></option>
                                                @foreach(\App\Schedule::$time as $key=>$val)
                                                    <option value="{{$key}}">{{$val}}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label" for="form_control_1">Teacher
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="" name="teacher">
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter name of room facilitor</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-checkboxes">
                                        <label class="col-md-2 control-label" for="form_control_1">Status
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="md-checkbox-inline">
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="checkbox1_3" name="status" value="1" class="md-check">
                                                    <label for="checkbox1_3">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Active</label>
                                                </div>
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="checkbox1_4" name="checkboxes2[]" value="2" class="md-check">
                                                    <label for="checkbox1_4">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Inactive </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn green">Add</button>
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

    <div class="modal fade bs-modal-lg" id="editSchedule" tabindex="-1" role="dialog" aria-hidden="true">
    {{--@include('modals/edit_schedule.blade.php')--}}
    </div>

    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p> Would you like to delete this schedule? </p>
                   {{-- <form id="delete-schedule" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">No</button>
                    <button type="button" data-dismiss="modal" class="btn green confirm-delete" {{--onclick="event.preventDefault(); document.getElementById('delete-schedule').submit();"--}}>Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
<script>
    $('document').ready(function(){
        var schedule = '';
       $('.tschedule').on('click', '.edit-schedule', function(e){
            e.preventDefault();
            schedule = $(this).data('schedule');
           $.post("{{ action('ScheduleController@get_schedule_details') }}", {_token:'{{ csrf_token() }}', schedule:schedule}, function(result){
               if(result.status == 'ok') {
                   $('#editSchedule').html(result.html);
                   $('#editSchedule').modal('show');
               }
           });
       }) ;

       $('.tschedule').on('click', '.delete-schedule', function(e){
            e.preventDefault();
            schedule = $(this).data('schedule');
            $('#static').modal('show');
       });

       /* $('#static').on('show.bs.modal', function(e) {*/
        $('#static').on('click', '.confirm-delete' ,function(e) {
            e.preventDefault(); console.log('delete btn');
            //$(this).find('.confirm-delete').attr('href', $(e.relatedTarget).data('href'));
            $.post("{{ action('ScheduleController@delete_schedule') }}", {_token:'{{ csrf_token() }}', schedule:schedule}, function(result){
                if(result.status == 'ok'){
                    $('.tr-schedule-'+schedule).remove();
                }
             });
            console.log('delete', schedule);
        });
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