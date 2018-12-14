<div class="schedule-clean">

    <form class="course_student_enroll_form">

        <a href="" id="" class=""> </a>

        <h4><u>Enroll</u></h4>

        <br>

        <div class="row mt-1">
            <div class="col-md-6">

                <div class="form-group">
                    <label for="course_student_enroll_section_name"><strong>Course Name</strong></label>
                    <div id="course_student_enroll_section_name"><?php echo $course['name']; ?></div>
                </div>

                <div class="form-group">
                    <label for="course_student_enroll_seats"><strong>Seats Available</strong></label>
                    <div id="course_student_enroll_seats"><?php echo $course['seats_available']; ?></div>
                </div>

                <?php
                $courseId          = $course["id"];
                $studentId         = $this->session->userdata('user_id');
                $studentIsEnrolled = $this->student->checkIfCourseEnrolled($studentId, $courseId);

                /* Student is already enrolled to the course */
                if ($studentIsEnrolled) { ?>

                    <div class="alert alert-warning" role="alert">
                        You have already enrolled to this course.
                    </div>

                <?php } else {

                    ?>

                    <div class="form-group">
                        <label for="course_student_enroll_section"><strong>Sections</strong></label>
                        <select class="form-control" name="course_student_enroll_section"
                                id="course_student_enroll_section">
                            <option value="0" selected disabled>Select a section</option>
                            <?php foreach ($sections as $section) { ?>
                                <option value="<?php echo $section["id"]; ?>"> <?php echo $section["section_code"]; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <input type="hidden" value="<?php echo $course["id"]; ?>" id="course_student_enroll_course_id"
                           name="course_student_enroll_course_id">

                    <input type="hidden" value="<?php echo $course["seats_available"]; ?>"
                           id="course_student_enroll_course_seats_avbl"
                           name="course_student_enroll_course_seats_avbl">

                    <div class="alert mt-2" style="display: none;" id="course_student_enroll_form_alert"
                         role="alert"></div>

                    <div class="form-group">
                        <button class="btn btn-primary ajaxBtnClick" id="course_student_enroll_finish"
                                type="button">
                            Enroll
                        </button>
                    </div>

                <?php } ?>

            </div>
        </div>
    </form>
</div>

<script>
    /* AJAX URL for this page */
    window.courseenrollajax = '<?php echo base_url('coursesajax/course_enroll_finish')?>';
</script>
