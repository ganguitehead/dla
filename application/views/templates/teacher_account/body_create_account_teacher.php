<?php $this->load->view('templates/prelogin_nav'); ?>
<div class="highlight-blue">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Create a Faculty Account</h2>
        </div>
    </div>
</div>

<div class="register-photo" style="padding: 50px;margin: 1px;">
    <div class="form-container">
        <div class="image-holder"></div>
        <form method="post" class="faculty_signup_form">
            <div class="form-group"><input class="form-control" type="firstname" name="firstname"
                                           placeholder="Firstname"></div>

            <div class="form-group"><input class="form-control" type="lastname" name="lastname" placeholder="Lastname">
            </div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group">
                <select class="form-control" name="department">
                    <option value="0" selected>Select a Department</option>
                    <option value="1">Computer Science / Software Engineering</option>
                    <option value="2">Electrical & Electronics</option>
                    <option value="3">Mechanical & Civil Engineering</option>
                </select>
            </div>
            <div class="form-group"><input class="form-control" type="password" id="password_one" name="password" placeholder="Password">
            </div>
            <div class="form-group"><input class="form-control" type="password" id="password_repeat" name="password-repeat"
                                           placeholder="Password (repeat)"></div>
            <div class="form-group">
                <button class="btn btn-primary btn-block ajaxBtnClick" type="button" id="faculty_signup">Sign Up</button>

                <div class="alert mt-2" style="display:none;" id="faculty_signup_form_alert" role="alert"></div>
            </div>

        </form>
    </div>
</div>