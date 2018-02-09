@extends('layouts.header')
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> {{$room->room_name}}</h1>
        <div class="btn-group dp-schedule">
            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                @if(isset($schedule) && count($schedule) > 0)
                    @foreach(\App\Schedule::$time as $key=>$val)
                        @if($key == $schedule->time)
                            {{$schedule->day .' - '. $val}}
                        @endif
                    @endforeach
                @else
                    Select Schedule
                @endif
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                @if(count($schedules_list) > 0)
                    @foreach($schedules_list as $schedule)
                        @foreach(\App\Schedule::$time as $key=>$val)
                            @if($key == $schedule->time)
                                <li><a href="{{action('RoomController@room_view_edit_schedule', compact('room', 'schedule'))}}"> {{$schedule->day .' - '. $val}} </a></li>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </ul>

        </div>
        <div class="actions">


            <a class="btn btn-circle btn-icon-only btn-default add-student-btn popovers" href="javascript:;" data-container="body" data-trigger="hover" data-placement="left" data-content="Add student on seat plan" data-original-title="Dashboard">
                <i class="fa fa-plus"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default popovers" href="javascript:;" data-container="body" data-trigger="hover" data-placement="left" data-content="Edit Settings" data-original-title="Dashboard">
                <i class="icon-wrench"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default popovers" href="javascript:;" data-container="body" data-trigger="hover" data-placement="left" data-content="Delete this room entry" data-original-title="Dashboard">
                <i class="icon-trash"></i>
            </a>

        </div>
    <div class="row">
        <div class="col-md-12 student-box">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered vertical-center" style="z-index:1;">
            {{--<div class="seatplan_img" style="z-index:1;">--}}
                <img src="{{asset($room->seatplan_image)}}" alt="#" class="seat-image">

                @foreach($all_student as $student)
                    <div id="jquery-draggable-{{$student->students}}" onMouseOver="showStudentInfo({{$student->students}});" onMouseOut="hideStudentInfo({{$student->students}});"
                         {{--data-toggle="modal" href="#full-{{$student->students}}"   onClick="setInfo({{$student->students}}{{($student->room) ? ','.$room->room : ',0'}}{{','.$schedule->schedule}});"--}}
                         data-student="{{$student->students}}" data-room="{{$student->room}}" data-schedule="{{$schedule->schedule}}"
                         onClick="setInfo({{$student->students}});" class="student-chair jquery-draggable department-{{str_replace(['/', ' '],'-',$student->department)}}" style="left:{{$student->pos_x}}px;top:{{$student->pos_y}}px;z-index:1;">
                        <div id="student-info-{{$student->students}}" class="student-info">{{$student->student_name}} - {{$student->seat_number}}</div>
                    </div>
                @endforeach
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>

        <div class="modal fade" id="full-new" tabindex="-1" role="dialog" aria-hidden="true">
           {{-- @include('modals/view_student_modal')--}}
        </div>

@endsection

@section('page_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script type="application/x-javascript">
var x_axis = -1, y_axis = -1, total_draggable = {{ count($all_student) }}, div_pos_x = -1, div_pos_y = -1;
var glow_color = "black";
var temp_id, temp_id, temp_student_id = -1;
var room = "{{$room->room}}";
var schedule = "{{$schedule->schedule}}";
$('document').ready(function(){

    $('.jquery-draggable').draggable({
        stop: function(event, ui) {
            var student_div_id_arr = ui.helper[0].id.split('-'); console.log(student_div_id_arr);
            temp_student_id = student_div_id_arr[2];
            fnScript.saveData();
        },
        start: function() {},
        drag: function() {},
    });

    $('body').mousemove(function( event ) {
        x_axis = event.pageX;
        y_axis = event.pageY;
        $('#x-axis').html(event.pageX);
        $('#y-axis').html(event.pageY);
    });

    $('body').on('click','.date-picker', function() {
        $(this).datepicker('destroy').datepicker({showOn:'focus'}).focus();
    });
    var fnScript = {
        onLoad: function(){
          this._ajxAddStudent();
          this._removeBoxShadow();
          this._addEditStudent();
          this._addEditSpecification();
          this._addEditSoftware();
          this._addEditDevice();
          /*this.others();*/
          $('.student-info').hide();
        },
        _removeBoxShadow: function(){
            $('html').click(function(e) {
                if(!$(e.target).hasClass('student-chair') )
                {
                    $('.student-chair').css('box-shadow', '');
                }
            });
        },
        _ajxAddStudent: function(){
            $('.add-student-btn').on('click', function(e){
                e.preventDefault();
                total_draggable++;
                div_pos_x = x_axis - 15;
                div_pos_y = y_axis + 35;
                $.post("{{action('RoomController@save_new_student')}}", {_token:'{{ csrf_token() }}', pos_x:div_pos_x, pos_y:div_pos_y, room:room,
                    schedule:schedule, status: 1}, function(result){
                    if(result.status == 'ok'){
                        temp_student_id = result.data.students;
                        fnScript._addChair(result.data.students, result.data.room, result.schedule.schedule);
                        $('#jquery-draggable-'+result.data.students).draggable({
                            stop:function() {fnScript.saveData}
                        });
                    }

                });
            });
        },
        _addChair: function(student_id, room, schedule){
            htmlChair = '<div id="jquery-draggable-'+student_id+'" onMouseOver="showStudentInfo('+student_id+');" onMouseOut="hideStudentInfo('+student_id+');" ' +
                'onClick="setInfo('+student_id+', '+room+', '+schedule+');" class="student-chair jquery-draggable" style="left:50%;top:50%;"><div id="student-info-'+student_id+'" ' +
                'class="student-info"></div></div>';
            $('body').append(htmlChair);
            $('#jquery-draggable-'+student_id).draggable({
                stop:function() {fnScript.saveData}
            });

            $('#jquery-draggable-'+student_id).css('position', 'absolute');
            $('#jquery-draggable-'+student_id)
                .animate({backgroundColor:glow_color}, 500)
                .animate({backgroundColor:'#CCCCCC'}, 500)
                .animate({backgroundColor:glow_color}, 500)
                .animate({backgroundColor:'#CCCCCC'}, 500)
                .animate({backgroundColor:glow_color}, 500)
                .animate({backgroundColor:'#CCCCCC'}, 500);
            $('#jquery-draggable-'+student_id).css('top', div_pos_y);
            $('#jquery-draggable-'+student_id).css('left', div_pos_x);
        },
        saveData: function(){
         if(temp_student_id != -1){
              temp_div = $('#jquery-draggable-'+temp_student_id);
              $.post("{{ action('RoomController@save_new_student') }}", {_token:'{{ csrf_token() }}', student_id:temp_student_id, pos_x:temp_div.position().left,
                  pos_y:temp_div.position().top, room:room}, function(result){
                  $('#jquery-draggable-'+total_draggable).data('student_id', result.id);
                  if(result.seat_number == null){
                      $('#student-info-'+result.id).html("");
                  }else{
                      $('#student-info-'+result.id).html(result.seat_number + " - " + result.name);
                  }
              });
          }
        },
        _addEditStudent: function(){
            $('#full-new').on('click', '.addStudent-btn', function(){
                $sID = $(this).attr('data-student');
                $form = $('#addStudentForm');
                url = $form.attr('action');
                data = $form.serialize()  + '&ajaxReturn=TRUE';
                $.post(url, data, function(result){
                    if(result.errors){
                        $('.student-error').removeClass('hide');
                        html = '';
                        $.each(result.errors, function (index, data) {
                            html += '<li>'+data+'</li>';
                        });
                        $('.student-error ul').html(html);
                        setTimeout(function(){ $('.student-error').addClass('hide'); }, 2000);
                    }else if(result.status == 'ok'){
                        $('.student-success').removeClass('hide');
                        $('.student-success .msg').html('Student Record is Updated Successfully');
                        setTimeout(function(){ location.reload(); }, 2000);
                     }
                   console.log(result.errors);
                });
            });
        },
        _addEditSpecification: function(){
            $('#full-new').on('click', '.addSpecification-btn', function(){
                $form = $('#addSpecs');
                url = $form.attr('action');
                data = $form.serialize()  + '&ajaxReturn=TRUE';
                $.post(url, data, function(result){console.log(result);
                   if(result.errors){
                        $('.specs-error').removeClass('hide');
                        html = '';
                        $.each(result.errors, function (index, data) {
                            html += '<li>'+data+'</li>';
                        });
                        $('.specs-error ul').html(html);
                        setTimeout(function(){ $('.specs-error').addClass('hide'); }, 2000);
                    }else if(result.status == 'ok'){
                        $('.specs-success').removeClass('hide');
                        $('.specs-success .msg').html('System Specification is Updated Successfully');
                        setTimeout(function(){ location.reload(); }, 2000);
                    }

                });
            });
        },
        _addEditSoftware: function(){
            $('#full-new').on('click', '.addSoftware-btn', function(){
                $form = $('#addSoftware');
                url = $form.attr('action');
                data = $form.serialize()  + '&ajaxReturn=TRUE';
                $.post(url, data, function(result){
                    if(result.errors){
                        $('.software-error').removeClass('hide');
                        html = '';
                        $.each(result.errors, function (index, data) {
                            html += '<li>'+data+'</li>';
                        });
                        $('.software-error ul').html(html);
                        setTimeout(function(){ $('.software-error').addClass('hide'); }, 2000);
                    }else if(result.status == 'ok'){
                        $('.software-success').removeClass('hide');
                        $('.software-success .msg').html('System Software is Updated Successfully');
                        setTimeout(function(){ location.reload(); }, 2000);
                    }
                    console.log(result.errors);
                });
            });
        },
        _addEditDevice: function() {
            $('#full-new').on('click', '.addDevice', function(){
                $form = $('#addHardware');
                url = $form.attr('action');
                data = $form.serialize()  + '&ajaxReturn=TRUE';
                $.post(url, data, function(result){
                    if(result.errors){
                        $('.device-error').removeClass('hide');
                        html = '';
                        $.each(result.errors, function (index, data) {
                            html += '<li>'+data+'</li>';
                        });
                        $('.device-error ul').html(html);
                        setTimeout(function(){ $('.device-error').addClass('hide'); }, 2000);
                    }else if(result.status == 'ok'){
                        $('.device-success').removeClass('hide');
                        $('.device-success .msg').html('System Software is Updated Successfully');
                        setTimeout(function(){ location.reload(); }, 2000);
                    }
                    console.log(result.errors);
                });
            });
        },
        showModalOnStudentClick: function(student_id, room_id, schedule_id){
            temp_student_id = student_id;
            $.post("{{ action('RoomController@get_info_details') }}", {_token:'{{ csrf_token() }}', student_id:temp_student_id,
                room:room_id, schedule: schedule_id}, function(result){
                $('#full-new').html(result.html);
                $('#full-new').modal('show');
                FormRepeater.init();
            });
        },
        others: function(){
            $('.btn-cancel').on('click',function(){
                $form = $(this).attr('data-form');
                $('#'+$form)[0].reset();
            });
        },

        showStudentInfo: function(){
            alert('sdgsg');
        },
        hideStudentInfo: function(){
            alert('sdgsg');
        }
    }
    fnScript.onLoad();

    $('.student-chair').on('click', function(){
        cStudent = $(this).data('student');
        cRoom = $(this).data('room');
        cSchedule = $(this).data('schedule');
        fnScript.showModalOnStudentClick(cStudent, cRoom, cSchedule);
    });
});

function setInfo(student_id, room_id, schedule_id){
    temp_student_id = student_id;
    $('#edit-delete-container').show();
    $('.employee-chair').css('box-shadow', '');
    $('#jquery-draggable-'+temp_student_id).css('box-shadow', '0px 0px 10px 10px '+glow_color);
}
function showStudentInfo(student_id){
    $('#student-info-'+student_id).show();
}
function hideStudentInfo(student_id){
    $('#student-info-'+student_id).hide();
}
function getInfoDetails_(student_id, room_id, schedule_id){
    temp_student_id = student_id;
    $.post("{{ action('RoomController@get_info_details') }}", {_token:'{{ csrf_token() }}', student_id:temp_student_id,
        room:room_id, schedule: schedule_id}, function(result){//console.log(result.html);
       /* $('#jquery-draggable-'+total_draggable).data('student_id', result.id);*/
        $('#full-new').html(result.html);
        $('#full-new').modal('show');
        FormRepeater.init();
        /*if(result.seat_number == null){
            $('#student-info-'+result.id).html("");
        }else{
            $('#student-info-'+result.id).html(result.seat_number + " - " + result.name);
        }*/
    });

    $('.student-chair').css('box-shadow', '');
    $('#jquery-draggable-'+temp_student_id).css('box-shadow', '0px 0px 3px 3px '+glow_color);
}

</script>
@endsection