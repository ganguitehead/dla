<div class="courses-wrapper p-1 shadow-sm mb-2 bg-white rounded">
    <div class="container">
        <h2>My Courses</h2>
        <hr>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded">

        <ul class="list-group">

            <?php foreach ($courses as $index => $course) {
                $courseDetail = $this->course->getCourseById($course['course_id']);
                $fileName = $this->course->getCourseFileName($course['course_id']);
                ?>

                <li class="list-group-item">

                    <strong><?php echo ucfirst($courseDetail["name"]); ?> </strong>
                    <hr>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <a target="_blank" href="https://appear.in/concordiaelearn"
                               class="card-link btn btn-primary ">Join Class</a>
                        </div>

                        <?php
                        if ($fileName && strlen($fileName) > 0) {
                            ?>
                            <div class="col-md-3">
                                <a href="<?php echo base_url('assets/course_files/') . $fileName; ?>"
                                   download>
                                    <button class="btn btn-primary" type="button">
                                        View Document
                                    </button>
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                </li>

            <?php } ?>

        </ul>

    </div>
</div>