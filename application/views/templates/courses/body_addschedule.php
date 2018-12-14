<div class="schedule-clean">

    <form class="course_addschedule_form">

        <h4><u>Add Course Schedule</u></h4><br>

        <?php if (isset($courses) && is_array($courses) && count($courses) > 0) { ?>

            <div class="row mt-1">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="course_schedule_selectcourse">Course</label>
                        <select class="form-control" name="course_schedule_selectcourse"
                                id="course_schedule_selectcourse">
                            <option value="0" selected disabled>Select a Course</option>
                            <?php foreach ($courses as $course) { ?>
                                <option value="<?php echo $course["id"]; ?>"> <?php echo $course["name"]; ?> </option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="course_schedule_days">Days</label>
                        <select class="form-control selectize-me" name="course_schedule_days[]"
                                id="course_schedule_days"
                                multiple>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                        </select>
                    </div>

                    <div class="form-group"><input class="form-control" type="text" id="course_schedule_sectioncode"
                                                   name="course_schedule_sectioncode" placeholder="Section Code">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course_schedule_fromtime">From</label>
                        <select class="form-control" name="course_schedule_fromtime" placeholder="Select a start time"
                                id="course_schedule_fromtime">
                            <option value="0" disabled selected>Select a time</option>
                            <?php foreach ($slots as $slot) { ?>
                                <option value="<?php echo $slot["id"]; ?>"> <?php echo $slot["time_start"]; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="course_schedule_totime">To</label>
                        <select class="form-control" name="course_schedule_totime" placeholder="Select a start time"
                                id="course_schedule_totime">
                            <option value="0" disabled selected>Select a time</option>
                            <?php foreach ($slots as $slot) { ?>
                                <option value="<?php echo $slot["id"]; ?>"> <?php echo $slot["time_start"]; ?> </option>
                            <?php } ?>
                        </select>
                    </div>


                </div>
            </div>


            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="float-right">
                            <button class="btn btn-primary ajaxBtnClick" id="course_scheduleadd" type="button">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert mt-2" style="display:none;" id="course_addschedule_form_alert" role="alert"></div>

        <?php } else { ?>

            <div class="form-group">
                <div class="text-primary">You do not have any courses</div>

                <a id="course_publish_addschedule" href="<?php echo base_url('courses/publish'); ?>"
                   class="btn btn-dark mt-2"
                   role="button" aria-pressed="true">Add a Course</a>
            </div>

        <?php } ?>

    </form>
</div>

<script>
    /* AJAX URL for this page */
    window.scheduleaddajax = '<?php echo base_url('coursesajax/course_addschedule')?>';
</script>
