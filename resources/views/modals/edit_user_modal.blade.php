    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">

                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">Edit User Details</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{ action('UserController@post_edit_user') }}" class="form-horizontal" id="editUserForm" novalidate="novalidate" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$user->id}}"/>
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Name
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="" name="name" value="{{$user->name}} "required autofocus>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">enter user name</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Email
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="" name="email" value="{{$user->email}}" required autofocus>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">enter user email</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-checkboxes">
                                    <label class="col-md-3 control-label" for="form_control_1">Status
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="md-checkbox-inline">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox1_3" name="status" value="1" class="md-check" {{($user->status == 1) ? 'checked' : '' }}>
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
                                        <button type="submit" class="btn green">Update</button>
                                        <button type="button" class="btn default user-delete" data-userid="{{$user->id}}">Delete</button>
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
