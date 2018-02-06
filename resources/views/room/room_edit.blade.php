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

            {{--<select class="form-control" id="form_control_1" name="room">
                <option value=""></option>
                @foreach($schedules_list as $schedule)
                    <option value="{{$schedule->day}}">{{$schedule->day}}</option>
                @endforeach
            </select>--}}
        </div>
    <div class="row">
        <div class="col-md-12 student-box">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered vertical-center" style="z-index:1;">
            {{--<div class="seatplan_img" style="z-index:1;">--}}
                <img src="{{asset($room->seatplan_image)}}" alt="#" class="seat-image">

                @foreach($all_student as $student)
                    <div id="jquery-draggable-{{$student->students}}" onMouseOver="showStudentInfo({{$student->students}});" onMouseOut="hideStudentInfo({{$student->students}});"
                         data-toggle="modal" href="#full-{{$student->students}}"
                         onClick="setStudentId({{$student->students}});" class="student-chair jquery-draggable department-{{str_replace(['/', ' '],'-',$student->department)}}" style="left:{{$student->pos_x}}px;top:{{$student->pos_y}}px;z-index:1;">
                        <div id="student-info-{{$student->students}}" class="student-info">{{$student->seat_number}} - {{$student->student_name}}</div>
                    </div>
                    <!-- /.modal-Student Info -->
                    <div class="modal fade" id="full-{{$student->students}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-globe font-green"></i>
                                                <span class="caption-subject font-green bold uppercase">Add Details</span>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <li class="">
                                                    <a href="#student-tab-{{$student->students}}" data-toggle="tab" aria-expanded="true"> Student </a>
                                                </li>
                                                <li class="">
                                                    <a href="#specification-{{$student->students}}" data-toggle="tab" aria-expanded="false"> Specification </a>
                                                </li>
                                                <li class="">
                                                    <a href="#software-{{$student->students}}" data-toggle="tab" aria-expanded="false"> Software </a>
                                                </li>
                                                <li class="">
                                                    <a href="#hardware-{{$student->students}}" data-toggle="tab" aria-expanded="false"> Hardware </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="student-tab-{{$student->students}}">
                                                    <div class="skin skin-minimal">
                                                        <form action="{{action('RoomController@ajax_save_new_student')}}" class="form-horizontal" id="addStudentForm-{{$student->students}}" novalidate="novalidate" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="form-body">
                                                                    <div class="student-error alert alert-danger hide">
                                                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                                                        <ul class="slist">

                                                                        </ul>
                                                                    </div>
                                                                    <div class="student-success alert alert-success hide">
                                                                        <button class="close" data-close="alert"></button> <p class="msg"></p>
                                                                    </div>
                                                                    <input type="hidden" name="students" value="{{$student->students}}">
                                                                    <input type="hidden" name="seat_number" value="{{$student->seat_number}}">
                                                                    <div class="form-group form-md-line-input">
                                                                        <label class="col-md-3 control-label" for="form_control_1">Student Name
                                                                            <span class="required" aria-required="true">*</span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" class="form-control" placeholder="" name="student_name" value="{{$student->student_name}}">
                                                                            <div class="form-control-focus"> </div>
                                                                            <span class="help-block">enter student name</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group form-md-line-input">
                                                                        <label class="col-md-3 control-label" for="form_control_1">Department
                                                                            <span class="required" aria-required="true">*</span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" class="form-control" placeholder="" name="department" value="{{$student->department}}">
                                                                            <div class="form-control-focus"> </div>
                                                                            <span class="help-block">enter department</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group form-md-line-input">
                                                                        <label class="col-md-3 control-label" for="form_control_1">Course
                                                                            <span class="required" aria-required="true">*</span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" class="form-control" placeholder="" name="course" value="{{$student->course}}">
                                                                            <div class="form-control-focus"> </div>
                                                                            <span class="help-block">enter course</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group form-md-line-input">
                                                                        <label class="col-md-3 control-label" for="form_control_1">Year
                                                                            <span class="required" aria-required="true">*</span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" class="form-control" placeholder="" name="year" value="{{$student->year}}">
                                                                            <div class="form-control-focus"> </div>
                                                                            <span class="help-block">enter year</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <div class="form-actions">
                                                                <button type="button" class="btn green addStudent-btn" data-student="{{$student->students}}">Submit</button>
                                                                <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="specification-{{$student->students}}">
                                                    <div class="skin skin-square">
                                                        <form action="{{action('RoomController@ajax_save_specification')}}" class="form-horizontal"  id="addSpecs-{{$student->students}}" novalidate="novalidate" method="POST">
                                                            {{ csrf_field() }}
                                                            <div class="form-body">
                                                                <div class="student-error alert alert-danger hide">
                                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                                                    <ul class="slist">

                                                                    </ul>
                                                                </div>
                                                                <div class="student-success alert alert-success hide">
                                                                    <button class="close" data-close="alert"></button> <p class="msg"></p>
                                                                </div>
                                                                <input type="hidden" name="students" value="{{$student->students}}">
                                                                <input type="hidden" name="seat_number" value="{{$student->seat_number}}">
                                                                <input type="hidden" name="in_used" value="yes">
                                                                <div class="form-group form-md-line-input">
                                                                    <label class="col-md-3 control-label" for="form_control_1">Unit Type
                                                                        <span class="required" aria-required="true">*</span>
                                                                    </label>
                                                                    <div class="col-md-5">
                                                                        <select class="form-control" id="form_control_1" name="processor">
                                                                            <option value=""></option>
                                                                            @foreach(\App\Specifications::$unitType as $key=>$val)
                                                                                <option value="{{$key}}">{{$val}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="form-control-focus"> </div>
                                                                        <span class="help-block">select unit type</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-md-line-input">
                                                                    <label class="col-md-3 control-label" for="form_control_1">Processor
                                                                    </label>
                                                                    <div class="col-md-5">
                                                                        <input type="text" class="form-control" placeholder="" name="processor" value="{{$student->department}}">
                                                                        <div class="form-control-focus"> </div>
                                                                        <span class="help-block">enter processor</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-md-line-input">
                                                                    <label class="col-md-3 control-label" for="form_control_1">Board
                                                                    </label>
                                                                    <div class="col-md-5">
                                                                        <input type="text" class="form-control" placeholder="" name="board" value="{{$student->course}}">
                                                                        <div class="form-control-focus"> </div>
                                                                        <span class="help-block">enter board</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-md-line-input">
                                                                    <label class="col-md-3 control-label" for="form_control_1">HDD
                                                                    </label>
                                                                    <div class="col-md-5">
                                                                        <input type="text" class="form-control" placeholder="" name="hdd" value="{{$student->year}}">
                                                                        <div class="form-control-focus"> </div>
                                                                        <span class="help-block">enter hdd</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-md-line-input">
                                                                    <label class="col-md-3 control-label" for="form_control_1">Memory
                                                                    </label>
                                                                    <div class="col-md-5">
                                                                        <input type="text" class="form-control" placeholder="" name="memory" value="{{$student->year}}">
                                                                        <div class="form-control-focus"> </div>
                                                                        <span class="help-block">enter memory</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-md-line-input">
                                                                    <label class="col-md-3 control-label" for="form_control_1">Graphics Card
                                                                    </label>
                                                                    <div class="col-md-5">
                                                                        <input type="text" class="form-control" placeholder="" name="graphics_card" value="{{$student->year}}">
                                                                        <div class="form-control-focus"> </div>
                                                                        <span class="help-block">enter graphics card</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-md-line-input">
                                                                    <label class="col-md-3 control-label" for="form_control_1">End of Life
                                                                    </label>
                                                                    <div class="col-md-5">
                                                                        <input class="form-control form-control-inline input-medium date-picker" name="end_of_life" type="text" value="">
                                                                        {{--<input type="text" class="form-control" placeholder="" name="year" value="{{$student->year}}">--}}
                                                                        <div class="form-control-focus"> </div>
                                                                        <span class="help-block">enter end of life</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="software-{{$student->students}}">
                                                    <div class="skin skin-flat">
                                                        <form action="{{action('RoomController@post_schedule')}}" class="form-horizontal mt-repeater form-horizontal" id="form_sample_1" novalidate="novalidate" method="POST">
                                                            {{ csrf_field() }}
                                                            <div data-repeater-list="group-a">
                                                                <div data-repeater-item="" class="mt-repeater-item">
                                                                    <!-- jQuery Repeater Container -->
                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">Software</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][text-input]" class="form-control" value="John Smith">
                                                                    </div>

                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">Purchase Date</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][Brand]" class="form-control" value="LG 22M35">
                                                                    </div>

                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">End of Life</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][Sticker]" class="form-control" value="31646">
                                                                    </div>
                                                                    <div class="mt-repeater-input">
                                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete">
                                                                            <i class="fa fa-close"></i> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" data-repeater-create="" class="btn btn-success mt-repeater-add">
                                                                <i class="fa fa-plus"></i> Add</a>
                                                            <div class="form-actions">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="hardware-{{$student->students}}">
                                                    <div class="skin skin-flat">
                                                        <form action="{{action('RoomController@post_schedule')}}" class="form-horizontal mt-repeater form-horizontal" id="form_sample_1" novalidate="novalidate" method="POST">
                                                            {{ csrf_field() }}
                                                            <div data-repeater-list="group-a">
                                                                <div data-repeater-item="" class="mt-repeater-item">
                                                                    <!-- jQuery Repeater Container -->
                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">Device</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][text-input]" class="form-control" value="John Smith">
                                                                    </div>

                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">Brand</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][Brand]" class="form-control" value="LG 22M35">
                                                                    </div>

                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">Sticker</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][Sticker]" class="form-control" value="31646">
                                                                    </div>
                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">Serial</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][Sticker]" class="form-control" value="31646">
                                                                    </div>
                                                                    <div class="mt-repeater-input">
                                                                        <label class="control-label">End of Life</label>
                                                                        <br>
                                                                        <input type="text" name="group-a[0][Sticker]" class="form-control" value="31646">
                                                                    </div>
                                                                    <div class="mt-repeater-input">
                                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete">
                                                                            <i class="fa fa-close"></i> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" data-repeater-create="" class="btn btn-success mt-repeater-add">
                                                                <i class="fa fa-plus"></i> Add</a>
                                                            <div class="form-actions">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                @endforeach
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@endsection

@section('page_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/form-repeater.js')}}" type="text/javascript"></script>
    <script src="{{asset('global/plugins/jquery-repeater/jquery.repeater.min.js')}}" type="text/javascript"></script>
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
            var fnScript = {
                onLoad: function(){
                  this._ajxAddStudent();
                  this._removeBoxShadow();
                  this._addEditStudent();
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
                        $.post("{{action('RoomController@save_new_student')}}", {_token:'{{ csrf_token() }}', pos_x:div_pos_x, pos_y:div_pos_y, room:room, schedule:schedule}, function(result){
                            temp_student_id = result.id;
                            fnScript._addChair(result.id);
                            $('#jquery-draggable-'+result.id).draggable({
                                stop:function() {fnScript.saveData}
                            });

                        });
                    });
                },
                _addChair: function(student_id){ console.log('char');
                    htmlChair = '<div id="jquery-draggable-'+student_id+'" onMouseOver="showStudentInfo('+student_id+');" onMouseOut="hideStudentInfo('+student_id+');" onClick="setStudentId('+student_id+');" class="student-chair jquery-draggable" style="left:50%;top:50%;"><div id="student-info-'+student_id+'" class="student-info"></div></div>';
                    $('body').append(htmlChair);
                    $('#jquery-draggable-'+student_id).draggable({
                        stop:function() {fnScript.saveData}
                    });
                },
                saveData: function(){
                 if(temp_student_id != -1){
                      temp_div = $('#jquery-draggable-'+temp_student_id);
                      $.post("{{ action('RoomController@save_new_student') }}", {_token:'{{ csrf_token() }}', student_id:temp_student_id, pos_x:temp_div.position().left, pos_y:temp_div.position().top, room:room}, function(result){
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
                    $('.addStudent-btn').on('click', function(e){
                        $sID = $(this).attr('data-student');
                        $form = $('#addStudentForm-'+$sID);
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
                                setTimeout(function(){ $('.student-error').addClass('hide'); }, 3000);
                            }else if(result.status == 'ok'){
                                $('.student-success').removeClass('hide');
                                $('.student-success .msg').html('Student Record is Updated Successfully');
                                setTimeout(function(){ location.reload(); }, 3000);
                             }
                           console.log(result.errors);
                        });
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