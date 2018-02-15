<script>
    $('document').ready(function() {
        var student = '';
        var seat = '';
        var room = '{{$rooms->room}}';
        var id = '';
        var $table = '';
        $('.inventory-tr').on('click', '.inventory-edit-btn', function(){
            var $this = $(this);
            var tab = $this.data('tab');
            if(tab == 'student'){
                student = $this.data('student');
                seat = $this.data('seat');
                param = {_token:'{{ csrf_token() }}', students:student, seat:seat, room:room, tab:tab}
            }else if(tab == 'specification'){
                specs = $this.data('specification');
                param = {_token:'{{ csrf_token() }}', specifications:specs, tab:tab}
            }else if(tab == 'software'){
                software = $this.data('software');
                param = {_token:'{{ csrf_token() }}', software:software, tab:tab}
            }else if(tab == 'hardware'){
                device = $this.data('device');
                param = {_token:'{{ csrf_token() }}', device:device, tab:tab}
            }

            $.post("{{ action('RoomController@get_individual_details') }}", param, function(result){
                $('#full-new').html(result.html);
                $('#full-new').modal('show');
                FormRepeater.init();
            });
        });

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
            });
        });

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
            });
        });

        $('#full-new').on('click', '.addDevice', function(){ console.log('adddevice');
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
            });
        });

        $('.inventory-tr').on('click', '.inventory-delete-btn', function(){
            id = $(this).data('id');
            $table = $(this).data('table');
            $('#static').modal('show');
        });


        $('#static').on('click', '.confirm-delete' ,function(e) {
            e.preventDefault();
            $.post("{{ action('UserController@delete_by_id') }}", {_token:'{{ csrf_token() }}', table:$table, id:id}, function(result){
                if(result.status == 'ok'){
                    $('#tr-'+$table+'-'+id).remove();
                }
            });
        });

    });
</script>
