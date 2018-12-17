<div class="schedule-clean">

    <form class="change_password_form">

        <h4><u>Reset Password</u></h4><br>

        <div class="row mt-1">
            <div class="col-md-6">

                <div class="form-group"><input class="form-control" type="password" id="password_one"
                                               name="change_password_value" placeholder="Enter your New Password"></div>

                <div class="form-group"><input class="form-control" type="password" id="password_repeat"
                                               name="change_password_value_repeat"
                                               placeholder="Re-enter your New Password"></div>
                <div class="form-group">
                    <button class="btn btn-primary ajaxBtnClick" id="change_password_submit"
                            type="button">
                        Submit
                    </button>
                </div>

                <div class="alert mt-2" style="display: none;" id="change_password_form_alert"
                     role="alert"></div>

            </div>
        </div>

</div>

</form>
</div>

<script>
    /* AJAX URL for this page */
    window.changepassswordajax = '<?php echo base_url('callsajax/update_password')?>';
</script>
