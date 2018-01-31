@extends('layouts.header')
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> {{$room->room_name}}</h1>
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered vertical-center" style="z-index:1;">
                <img src="{{asset($room->seatplan_image)}}" alt="#" class="seat-image">

                @foreach($all_student as $student)
                    <div id="jquery-draggable-{{$student->$student}}" onMouseOver="showStudentInfo({{$student->$student}});" onMouseOut="hideStudentInfo({{$student->student}});" onClick="setStudentId({{$student->student}});" class="student-chair jquery-draggable department-{{str_replace(['/', ' '],'-',$student->department)}}" style="left:{{$student->pos_x}}px;top:{{$student->pos_y}}px;z-index:1;">
                        <div id="student-info-{{$student->$student}}" class="student-info">{{$student->seat_number}} - {{$student->student_name}}</div>
                    </div>
                @endforeach
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@endsection

@section('page_script')
    <script type="application/x-javascript">
        $('document').ready(function(){
            var x_axis = -1, y_axis = -1, total_draggable = {{ count($all_student) }}, div_pos_x = -1, div_pos_y = -1;
            var glow_color = "black";
            var temp_id, temp_id, temp_student_id = -1;
            var room = "{{$room}}";
            var fnScript = {
                onLoad: function(){
                  $('.add-student-btn').on('click', function(e){
                        e.preventDefault();
                        total_draggable++;
                        div_pos_x = x_axis - 15;
                        div_pos_y = y_axis + 35;
                  });
                },
            }

            fnScript.onLoad();
        });
    </script>
@endsection