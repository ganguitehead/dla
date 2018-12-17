<div class="login-clean">
    <form method="post" class="login_appform">
        <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
        <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block ajaxBtnClick" type="button" id="login_app">Log In</button>
        </div>

        <div class="alert mt-2" style="display:none;" id="student_login_form_alert" role="alert"></div>

        <a href="<?php echo base_url('forgotpwd'); ?>" class="forgot">Forgot your email or password?</a></form>
</div>