$(function () {
    /* site wide JS file */

    /* AJAX LOADER START AND STOP
    * SHOW THE AJAX LOADER DIV
    * */
    $(document).ajaxStart(function () {
        $('#siteWideajaxLoader').fadeIn();
    });
    $(document).ajaxStop(function () {
        $('#siteWideajaxLoader').fadeOut();
    });

    /* Button click handler for all the AJAX forms */
    $(".ajaxBtnClick").on("click", function () {
        ajaxButtonClick(this);
    });

    function ajaxButtonClick(self) {
        const id = $(self).attr("id");

        switch (id) {
            case 'student_signup':
                student_signup();
                break;

            case 'faculty_signup':
                faculty_signup();
                break;

            case 'login_app':
                login_process();
        }
    }

    function checkPasswordMatch(formClass) {
        var password_one = $(formClass).find("#password_one").val();
        var password_repeat = $(formClass).find("#password_repeat").val();

        if (password_one != password_repeat) {
            return false;
        }
        return true;
    }

    function faculty_signup() {
        $("#faculty_signup_form_alert").fadeOut();

        if (!checkPasswordMatch(".faculty_signup_form")) {
            $("#faculty_signup_form_alert").html("Passwords do not match.");
            $("#faculty_signup_form_alert").removeClass("alert-success").addClass("alert-warning");
            $("#faculty_signup_form_alert").fadeIn();
            return;
        }

        const data = $(".faculty_signup_form").serialize();

        $.ajax({
            url: 'callsajax/faculty',
            data: data,
            type: 'POST',
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response && response.result) {
                    $("#faculty_signup_form_alert").html(response.value);
                    $("#faculty_signup_form_alert").removeClass("alert-warning").addClass("alert-success");
                    $(".faculty_signup_form").trigger("reset");
                } else {
                    $("#faculty_signup_form_alert").html(response.value);
                    $("#faculty_signup_form_alert").removeClass("alert-success").addClass("alert-warning");
                }
                $("#faculty_signup_form_alert").fadeIn();
            }
        });
    }

    function student_signup() {
        $("#student_signup_form_alert").fadeOut();

        if (!checkPasswordMatch(".student_signup_form")) {
            $("#student_signup_form_alert").html("Passwords do not match.");
            $("#student_signup_form_alert").removeClass("alert-success").addClass("alert-warning");
            $("#student_signup_form_alert").fadeIn();
            return;
        }

        const data = $(".student_signup_form").serialize();

        $.ajax({
            url: 'callsajax/student',
            data: data,
            type: 'POST',
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response && response.result) {
                    $("#student_signup_form_alert").html(response.value);
                    $("#student_signup_form_alert").removeClass("alert-warning").addClass("alert-success");
                    $(".student_signup_form").trigger("reset");
                } else {
                    $("#student_signup_form_alert").html(response.value);
                    $("#student_signup_form_alert").removeClass("alert-success").addClass("alert-warning");
                }
                $("#student_signup_form_alert").fadeIn();
            }
        });
    }

    function login_process() {
        $("#student_login_form_alert").fadeOut();

        const data = $(".login_appform").serialize();

        $.ajax({
            url: 'callsajax/login',
            data: data,
            type: 'POST',
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    if (response.result) {
                        location.href = response.redirect;
                    } else {
                        $("#student_login_form_alert").html(response.value);
                        $("#student_login_form_alert").addClass("alert-warning");
                    }
                    $("#student_login_form_alert").fadeIn();
                }
            }
        });
    }
});