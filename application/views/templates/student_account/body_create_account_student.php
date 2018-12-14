<?php $this->load->view('templates/prelogin_nav'); ?>
<div class="highlight-blue">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Create a Student Account</h2>
        </div>
    </div>
</div>
</div>

<div class="register-photo" style="padding: 50px;margin: 1px;">
    <div class="form-container">
        <div class="image-holder"></div>
        <form method="post" class="student_signup_form">
            <div class="form-group"><input class="form-control" type="text" name="firstname"
                                           placeholder="Firstname"></div>
            <div class="form-group"><input class="form-control" type="text" name="lastname" placeholder="Lastname">
            </div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" id="password_one" name="password" placeholder="Password">
            </div>
            <div class="form-group"><input class="form-control" type="password" id="password_repeat" name="password-repeat"
                                           placeholder="Password (repeat)"></div>
            <div class="form-group">
                <button class="btn btn-primary btn-block ajaxBtnClick" type="button" id="student_signup">Sign Up
                </button>

                <div class="alert mt-2" style="display:none;" id="student_signup_form_alert" role="alert"></div>
            </div>

        </form>
    </div>
</div>