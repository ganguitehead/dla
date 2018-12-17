<div class="courses-wrapper p-1 shadow-sm mb-2 bg-white rounded">
    <div class="container">
        <h2>My Courses</h2>
        <hr>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded">

        <?php

        if (!is_array($courses) || (is_array($courses) && count($courses) < 1) || !$courses) { ?>

            <div class="alert mt-2 alert-warning" role="alert">You do not have any courses

                <a href="<?php echo base_url('courses/publish'); ?>"
                   class="btn btn-primary ">Add New Course</a>
            </div>


        <?php } else {

            ?>

            <ol class="list-group">

                <?php
                if (is_array($courses) && count($courses) > 0) {
                    foreach ($courses as $index => $course) { ?>

                        <li class="list-group-item">

                            <strong><?php echo ucfirst($course["name"]); ?> </strong>
                            <hr>

                            <div class="row form-group">
                                <div class="col-md-3">
                                    <a target="_blank" href="https://appear.in/concordiaelearn"
                                       class="card-link btn btn-primary ">Start Class</a>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="videostream_add_document"
                                            data-toggle="collapse"
                                            href="<?php echo ".addDocumentCollapsible_" . $course["id"]; ?>"
                                            role="button"
                                            aria-expanded="false" aria-controls="collapseExample">
                                        Add Document
                                    </button>
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="col-md-12">
                                    <div class="collapse <?php echo "addDocumentCollapsible_" . $course["id"]; ?>"
                                         id="addDocumentCollapsible">
                                        <div class="card card-body">

                                            <div class="alert mt-2" style="display:none;"
                                                 id="<?php echo "form_alert_" . $course["id"]; ?>" role="alert"></div>

                                            <div class="form-group">
                                                <input class="ajaxFileUpload"
                                                       data-cid="<?php echo $course["id"]; ?>"
                                                       type="file"
                                                       id="course_class_file" name="course_class_file"
                                                       placeholder="Add a document">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>

                    <?php }
                } ?>

            </ol>

        <?php } ?>

    </div>
</div>


<script>
    /* AJAX URL for this page */
    window.classDocUpload = '<?php echo base_url('coursesajax/course_doc_upload')?>';
</script>
