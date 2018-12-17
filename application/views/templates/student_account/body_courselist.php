<div class="courses-wrapper p-1 shadow-sm mb-2 bg-white rounded">
    <div class="container">
        <h1>Courses</h1>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded">

        <div class="form-group shadow-sm p-3 mb-3 bg-white rounded">
            <input class="form-control" id="myInput" type="text" placeholder="Search Courses">
        </div>


        <div class="row">

            <?php
            $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

            foreach ($courses as $index => $course) {
                $professorId      = $course["faculty_user_id"];
                $professorDetails = $this->student->getUserDetailById($professorId);
                $professorName    = ucwords(strtolower($professorDetails["firstname"] . " " . $professorDetails["lastname"]));

                $courseSlots = $this->courseslots->getSlotsByCourseId($course["id"]);
                ?>

                <div class="col-md-4 <?php echo $index > 2 ? 'mt-2' : ''; ?> ">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><u> <?php echo ucfirst($course["name"]); ?> </u></h5>

                            <p class="card-text"><strong>Professor
                                    : </strong> <?php echo $professorName; ?> </p>

                            <a href="<?php echo base_url('courses/enroll/cid/') . base64_encode($course["id"]); ?>"
                               class="card-link btn btn-primary">Enroll</a>

                            <button class="card-link btn btn-secondary"
                                    data-toggle="collapse"
                                    href="<?php echo ".courselist_collapse_" . $course["id"]; ?>"
                                    role="button" aria-expanded="false"
                                    aria-controls="<?php echo "courselist_collapse_" . $course["id"]; ?>">
                                Details
                            </button>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="collapse <?php echo "courselist_collapse_" . $course["id"]; ?>">
                                        <div class="card card-body">
                                            <p class="card-text"> <?php echo ucfirst($course["description"]); ?> </p>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6>Timings:</h6>

                                                    <?php
                                                    if (is_array($courseSlots) && count($courseSlots) > 0) {
                                                        foreach ($courseSlots as $slot) {
                                                            $slotDays        = explode("-", $slot["day"]);
                                                            $timeSlotStartId = $slot["timeslot_start"];
                                                            $timeSlotEndId   = $slot["timeslot_end"];

                                                            $timeSlotStartValue =
                                                                date("h:i", strtotime($this->courseslots->getTimeBySlotId($timeSlotStartId)));

                                                            $timeSlotEndValue =
                                                                date("h:i", strtotime($this->courseslots->getTimeBySlotId($timeSlotEndId)));
                                                            ?>
                                                            <ul class="list-group"> <?php

                                                                foreach ($slotDays as $slotDay) { ?>

                                                                    <li class="list-group-item">
                                                                        <strong><?php echo $daysOfWeek[$slotDay - 1]; ?> </strong>
                                                                        :

                                                                        <span> <?php echo $timeSlotStartValue; ?>
                                                                            - <?php echo $timeSlotEndValue; ?></span>
                                                                    </li>

                                                                <?php } ?>

                                                            </ul>
                                                        <?php }
                                                    } else { ?>
                                                        <div class="alert alert-warning"
                                                             role="alert">
                                                            No classes found for this course
                                                        </div>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>