<?php
if (!is_array($userCourses) || count($userCourses) < 1) {
    ?>
    <div class="text-center">
        <div class="alert col-md-6 text-center mt-2 alert-warning" role="alert">No Courses found in your account.</div>
    </div>
    <?php
} else {
    ?>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center h-100">

            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body contacts_body">
                        <ui class="contacts">

                            <?php
                            if (is_array($userCourses) && count($userCourses) > 0) {
                                foreach ($userCourses as $userCourse) {
                                    $courseDetail = $userCourse;
                                    $courseName   = ucwords($courseDetail["name"]);
                                    ?>

                                    <li class="active chatUserBtn" data-cid="<?php echo $userCourse["id"]; ?>">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont">
                                                <img src="<?php echo base_url('assets/img/default-group.png'); ?>"
                                                     class="rounded-circle user_img">
                                            </div>
                                            <div class="user_info">
                                                <span class="courseName_chat_list_item"> <?php echo $courseName; ?> </span>
                                            </div>
                                        </div>
                                    </li>

                                    <?php
                                }
                            }
                            ?>

                        </ui>
                    </div>

                </div>
            </div>

            <div class="col-md-8 col-xl-6" id="default_show_chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="user_info">
                                <span>Select a group to show messages</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xl-6 chat" id="group_show_chat" style="display:none;">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="<?php echo base_url('assets/img/default-user.png'); ?>"
                                     class="rounded-circle user_img">
                            </div>
                            <div class="user_info">
                                <span id="user_info_selected_chat">Name</span>
                            </div>
                        </div>
                    </div>

                    <!-- Messages container -->
                    <div class="card-body msg_card_body"></div>
                    <!-- Messages container -->

                    <div class="card-footer">
                        <div class="input-group">
                        <textarea data-cid="0" id="chatmessage_text" class="form-control type_msg"
                                  placeholder="Type your message..."></textarea>
                            <div class="input-group-append">
                                <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <script>
        /* AJAX URL for this page */
        window.chatUserSelectAjax = '<?php echo base_url('chatajax/get_chat') ?>';
        window.chatUserSendAjax = '<?php echo base_url('chatajax/send_chat') ?>';
        window.sessionUserId = '<?php echo $this->session->userdata('user_id'); ?>';
    </script>

    <div id="new_message_prototype_self" style="display:none;̥">
        <div class="d-flex justify-content-end mb-4">
            <div class="msg_cotainer_send">
                <span class="msg_value"></span>
                <span class="msg_time"></span>
            </div>
            <small class="msg_cotainer_sender">Sender</small>
        </div>
    </div>

    <div id="new_message_prototype_others" style="display:none;̥">
        <div class="d-flex justify-content-start mb-4">
            <small class="msg_cotainer_sender">Sender</small>
            <div class="msg_cotainer">
                <span class="msg_value"></span>
                <span class="msg_time"></span>
            </div>
        </div>
    </div>

<?php } ?>