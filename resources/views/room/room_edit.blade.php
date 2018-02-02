@extends('layouts.header')
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> {{$room->room_name}}</h1>
        <div class="btn-group dp-schedule">
            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Select Schedule
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">

                @if(count($schedules) > 0)
                    @foreach($schedules as $schedule)
                        <li>
                            @foreach(\App\Schedule::$time as $key=>$val)
                                @if($key == $schedule->time)
                                    <a href="{{action('RoomController@room_view_edit_schedule', compact('room', 'key'))}}> {{$schedule->day .' - '. $val}} </a>
                                @endif
                            @endforeach
                        </li>
                    @endforeach
                @endif

                {{--<li>
                    <a href="javascript:;"> Settings
                        <span class="badge badge-success"> 3 </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;"> Preferences </a>
                </li>
                <li>
                    <a href="javascript:;"> Window Options </a>
                </li>
                <li>
                    <a href="javascript:;"> Help
                        <span class="badge badge-danger"> 7 </span>
                    </a>
                </li>--}}
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

            {{--<select class="form-control" id="form_control_1" name="room">
                <option value=""></option>
                @foreach($schedules as $schedule)
                    <option value="{{$schedule->day}}">{{$schedule->day}}</option>
                @endforeach
            </select>--}}
        </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered vertical-center" style="z-index:1;">
                <img src="{{asset($room->seatplan_image)}}" alt="#" class="seat-image">

                @foreach($all_student as $student)
                    <div id="jquery-draggable-{{$student->students}}" onMouseOver="showStudentInfo({{$student->students}});" onMouseOut="hideStudentInfo({{$student->students}});" onClick="setStudentId({{$student->students}});" class="student-chair jquery-draggable department-{{str_replace(['/', ' '],'-',$student->department)}}" style="left:{{$student->pos_x}}px;top:{{$student->pos_y}}px;z-index:1;">
                        <div id="student-info-{{$student->students}}" class="student-info">{{$student->seat_number}} - {{$student->student_name}}</div>
                    </div>
                @endforeach
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@endsection

@section('page_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script type="application/x-javascript">
        var x_axis = -1, y_axis = -1, total_draggable = {{ count($all_student) }}, div_pos_x = -1, div_pos_y = -1;
        var glow_color = "black";
        var temp_id, temp_id, temp_student_id = -1;
        var room = "{{$room->room}}";
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
            var fnScript = {
                onLoad: function(){
                  this._addStudent();
                  this._removeBoxShadow();
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
                _addStudent: function(){
                    $('.add-student-btn').on('click', function(e){
                        e.preventDefault();
                        total_draggable++;
                        div_pos_x = x_axis - 15;
                        div_pos_y = y_axis + 35;
                        this._addChair('new');
                    });
                },
                _addChair: function(id){
                    htmlChair = '<div id="jquery-draggable-'+id+'" onMouseOver="showStudentInfo('+id+');" onMouseOut="hideStudentInfo('+id+');" onClick="setStudentId('+id+');" class="student-chair jquery-draggable" style="left:50%;top:50%;"><div id="student-info-'+id+'" class="student-info"></div></div>';
                    $('body').append(htmlChair);
                },
                saveData: function(){
                  if(temp_student_id != -1){
                      temp_div = $('#jquery-draggable-'+temp_student_id);
                      $.post("{{ action('RoomController@save_new_student') }}", {_token:'{{ csrf_token() }}', student_id:temp_student_id, pos_x:temp_div.position().left, pos_y:temp_div.position().top, room:room}, function(result){

                      });
                  }
                },
                showStudentInfo: function(){
                    alert('sdgsg');
                },
                hideStudentInfo: function(){
                    alert('sdgsg');
                }
            }
            fnScript.onLoad();
        });

        function showStudentInfo(student_id){
            $('#student-info-'+student_id).show();
        }
        function hideStudentInfo(student_id){
            $('#student-info-'+student_id).hide();
        }
        function setStudentId (student_id){
            temp_student_id = student_id;
            $('.student-chair').css('box-shadow', '');
            $('#jquery-draggable-'+temp_student_id).css('box-shadow', '0px 0px 3px 3px '+glow_color);
        }
    </script>
@endsection