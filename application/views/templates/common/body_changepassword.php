<div class="schedule-clean">

    <form class="forgot_password_form">

        <h4><u>Reset Password</u></h4><br>

        <div class="row mt-1">
            <div class="col-md-6">


                <div class="form-group"><input class="form-control" type="text" id="forgot_password_email"
                                               name="forgot_password_email" placeholder="Enter your Email"></div>

                <div class="form-group"><input class="form-control" type="password" id="password_one"
                                               name="forgot_password_value" placeholder="Enter your New Password"></div>

                <div class="form-group"><input class="form-control" type="password" id="password_repeat"
                                               name="forgot_password_value_repeat"
                                               placeholder="Re-enter your New Password"></div>
                <div class="form-group">
                    <button class="btn btn-primary ajaxBtnClick" id="forgot_password_submit"
                            type="button">
                        Submit
                    </button>
                </div>

                <div class="alert mt-2" style="display: none;" id="forgot_password_form_alert"
                     role="alert"></div>

            </div>
        </div>

</div>

</form>
</div>

<script>
    /* AJAX URL for this page */
    window.forgotpassswordajax = '<?php echo base_url('callsajax/forgot_password')?>';
</script>
