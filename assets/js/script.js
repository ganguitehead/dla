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

    /* Selectize */
    $(".selectize-me").selectize({
        persist: false,
        maxItems: null,
        allowEmptyOption: true,
        closeAfterSelect: true
    });


    /* Button click handler for all the AJAX forms */
    $(".ajaxBtnClick").on("click", function () {
        ajaxButtonClick(this);
    });

    $(".ajaxFocusOut").on("blur", function () {
        ajaxFocusOut(this);
    });

    $(".chatUserBtn").on("click", function () {
        var chatId = $(this).attr("data-cid");
        var courseName = $(this).find(".courseName_chat_list_item").html();
        getChat(chatId, courseName);
    });

    $("#chatmessage_text").on("keypress", function (e) {
        var key = e.keyCode;

        // If the user has pressed enter
        if (key == 13) {
            message = $(this).val();
            course_id = $(this).attr("data-cid");
            send_chat(message, course_id);

            $("#chatmessage_text").val("").empty().blur();
        }
    });

    function ajaxFocusOut(self) {
        const id = $(self).attr("id");
        const value = $(self).val();

        switch (id) {
            case 'course_code_publish':
                checkCourseCode(value);
                break;
        }
    }

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
                break;

            case 'course_add':
                course_add();
                break;

            case 'course_scheduleadd':
                course_scheduleadd();
                break;

            case 'course_student_enroll_finish':
                course_student_enroll();
                break;
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

    function course_add() {
        $("#course_dept_alert").fadeOut();
        const url = window.publishajax;
        const data = $(".course_publish_form").serialize();
        const form_alert_id = "#course_publish_form_alert";

        if ($(".course_publish_form").find("#course_dept :selected").val() == "0") {
            $("#course_dept_alert").fadeIn();
            return;
        }

        if ($(".course_publish_form").find("#course_add").attr("data-disable") == "true") {
            return;
        }

        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response && response.result) {
                    $(form_alert_id).html(response.value);
                    $(form_alert_id).removeClass("alert-warning").addClass("alert-success");

                    /* Get the Add Schedule button and place it in the form */
                    $(".afterAjaxContent").html($(".afterAjaxContentProto").html());

                    $(".course_publish_form").trigger("reset");
                } else {
                    $(form_alert_id).html(response.value);
                    $(form_alert_id).removeClass("alert-success").addClass("alert-warning");
                }
                $(form_alert_id).fadeIn();
            }
        });
    }

    function checkCourseCode(code) {
        $("#course_code_alert").fadeOut();
        const url = window.codecheckajax;

        if (code.length < 1) {
            $("#course_code_alert").html("Course code is a required field.");
            $("#course_code_alert").fadeIn();
            return;
        }

        $.ajax({
            url: url,
            data: {
                code: code
            },
            type: 'POST',
            cache: false,
            dataType: 'json',
            success: function (response) {
                if (response && response.result) {
                    // Course code is available
                    $("#course_code_alert").html(response.value).removeClass("text-danger").addClass("text-success");
                    $(".course_publish_form").find("#course_add").attr("data-disable", false);
                } else {
                    // Course code is not available
                    $("#course_code_alert").addClass("text-danger").removeClass("text-success").html(response.value);
                    $(".course_publish_form").find("#course_add").attr("data-disable", true);
                }
            }
        });

        $("#course_code_alert").fadeIn();
    }

    function course_scheduleadd() {

        $("#course_addschedule_form_alert").fadeOut();
        var data = $(".course_addschedule_form").serialize();
        var url = window.scheduleaddajax;
        var alert_id = "#course_addschedule_form_alert";

        /* Validate if all the fields are selected */
        var course_select = $("#course_schedule_selectcourse").val();
        var course_days = $("#course_schedule_days").val();
        var schedule_fromtime = $("#course_schedule_fromtime").val();
        var schedule_totime = $("#course_schedule_totime").val();
        var schedule_sectioncode = $("#course_schedule_sectioncode").val();
        error = 0;
        errorText = "";

        if (schedule_sectioncode.length < 1 || schedule_sectioncode == null) {
            error = 1;
            errorText = "Enter the Section Code";
        }

        if (course_select == "null" || course_select == null) {
            error = 1;
            errorText = "Select a Course";
        }

        if (course_days == "null" || course_days == null || course_days.length < 1) {
            error = 1;
            errorText = "Select the schedule days";
        }

        if (schedule_totime == "null" || schedule_totime == null) {
            error = 1;
            errorText = "Select the class end time.";
        }

        if (schedule_fromtime == "null" || schedule_fromtime == null) {
            error = 1;
            errorText = "Select the class start time.";
        }

        if (error == 1) {
            $("#course_addschedule_form_alert").html(errorText).removeClass("alert-success").addClass("alert-warning").fadeIn();
            return;
        }

        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response && response.result) {
                    $(alert_id).html(response.value);
                    $(alert_id).removeClass("alert-warning").addClass("alert-success");

                    /* Reset the form and reset the days selectize input */
                    $(".course_addschedule_form").trigger("reset");
                    $("#course_schedule_days")[0].selectize.clear();
                } else {
                    $(alert_id).html(response.value);
                    $(alert_id).removeClass("alert-success").addClass("alert-warning");
                }
                $(alert_id).fadeIn();
            }
        });

    }

    function course_student_enroll() {
        $("#course_student_enroll_form_alert").fadeOut();
        var data = $(".course_student_enroll_form").serialize();
        var url = window.courseenrollajax;
        var alert_id = "#course_student_enroll_form_alert";
        $(alert_id).fadeOut();

        var course_sectioncode = $("#course_student_enroll_section :selected").val();

        if (course_sectioncode == "0") {
            $(alert_id).html("Please select a Section").removeClass("alert-success").addClass("alert-warning").fadeIn();
            return;
        }

        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response && response.result) {
                    $(alert_id).html(response.value);
                    $(alert_id).removeClass("alert-warning").addClass("alert-success");

                    /* Reset the form */
                    $(".course_student_enroll_form").trigger("reset");
                } else {
                    $(alert_id).html(response.value);
                    $(alert_id).removeClass("alert-success").addClass("alert-warning");
                }
                $(alert_id).fadeIn();
            }
        });

    }

    function getChat(chatId, usergroup_name) {
        var url = window.chatUserSelectAjax;
        var sessionUserId = parseInt(window.sessionUserId);

        $.ajax({
            url: url,
            data: {
                id: chatId
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response.result) {
                    messages = response.value;

                    /* Clear the existing messages */
                    $(".msg_card_body").html("");

                    /* Insert the messages in the Html */
                    for (var messageIndex in messages) {
                        var singleMessage = messages[messageIndex];
                        messageUserId = parseInt(singleMessage.user_id);

                        /* If the message is by the current user - show it to the right end */
                        if (messageUserId == sessionUserId) {
                            var messageProto = $("#new_message_prototype_self").html();
                            messageProto = $.parseHTML(messageProto);

                            $(messageProto).find(".msg_value").html(singleMessage.message);
                            // $(messageProto).find(".msg_time").html(singleMessage.time);
                            $(messageProto).find(".msg_cotainer_sender").html(singleMessage.name);

                            $(".msg_card_body").append(messageProto);
                        } else {
                            var messageProto = $("#new_message_prototype_others").html();
                            messageProto = $.parseHTML(messageProto);

                            $(messageProto).find(".msg_value").html(singleMessage.message);
                            // $(messageProto).find(".msg_time").html(singleMessage.time);
                            $(messageProto).find(".msg_cotainer_sender").html(singleMessage.name);

                            $(".msg_card_body").append(messageProto);
                        }

                    }

                    /* Remove the default group chat */
                    if ($("#default_show_chat").length > 0) {
                        $("#default_show_chat").remove();
                    }

                    $("#group_show_chat").fadeIn();

                    scrollChatBottom();
                }
            }
        });

        /* Set the name and ID in the chat messages box */
        $("#chatmessage_text").attr("data-cid", chatId);
        $("#user_info_selected_chat").html(usergroup_name);
    }

    function send_chat(message, course_id) {
        var url = window.chatUserSendAjax;

        $.ajax({
            url: url,
            global: false,
            data: {
                m: message,
                course: course_id
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response.result) {

                    var singleMessage = response.value;
                    messageUserId = parseInt(singleMessage.user_id);

                    var messageProto = $("#new_message_prototype_self").html();
                    messageProto = $.parseHTML(messageProto);

                    $(messageProto).find(".msg_value").html(singleMessage.message);

                    $(".msg_card_body").append(messageProto);

                    scrollChatBottom();
                }
            }
        });
    }

    function scrollChatBottom() {
        $(".msg_card_body").animate({
            scrollTop: $('.msg_card_body')[0].scrollHeight - $('.msg_card_body')[0].clientHeight
        }, 1000);
    }
});