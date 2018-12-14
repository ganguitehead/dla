<div class="contact-clean">
    <form class="course_publish_form">
        <h2 class="text-center">Add Course</h2>
        <div class="form-group"><input class="form-control" type="text" name="course_name" placeholder="Course Name">
        </div>
        <div class="form-group">
            <select class="form-control" name="course_dept" id="course_dept">
                <option value="0" disabled selected>Select the department</option>
                <?php foreach ($departments as $department) { ?>
                    <option value="<?php echo $department["id"]; ?>"> <?php echo $department["name"]; ?> </option>
                <?php } ?>
            </select>
            <small class="form-text text-danger" id="course_dept_alert" style="display: none;">Please select a
                department.
            </small>
        </div>

        <div class="form-group"><input class="form-control ajaxFocusOut" type="text" id="course_code_publish"
                                       name="course_code" placeholder="Course Code">
            <small class="form-text text-danger" id="course_code_alert" style="display: none;"></small>
        </div>
        <div class="form-group"><textarea class="form-control" rows="14" name="course_desc"
                                          placeholder="Description"></textarea></div>
        <div class="form-group"><input class="form-control" type="number" name="course_seats_available"
                                       placeholder="Total Seats"></div>

        <div class="form-group">
            <button class="btn btn-primary ajaxBtnClick" id="course_add" type="button">
                Add
            </button>

            <span class="afterAjaxContent"></span>

            <div class="alert mt-2" style="display:none;" id="course_publish_form_alert" role="alert"></div>

        </div>
    </form>
</div>

<script>
    /* AJAX URL for this page */
    window.publishajax = '<?php echo base_url('coursesajax/course_publish')?>';
    window.codecheckajax = '<?php echo base_url('coursesajax/code_check')?>';
</script>

<div class="afterAjaxContentProto">
    <a id="course_publish_addschedule" href="<?php echo base_url('courses/addschedule'); ?>" class="btn btn-warning"
       role="button" aria-pressed="true">Add Schedule</a>
</div>