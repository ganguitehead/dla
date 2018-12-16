<div class="courses-wrapper p-1 shadow-sm mb-2 bg-white rounded">
    <div class="container">
        <h1>My Courses</h1>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded">

        <ul class="list-group">

            <?php foreach ($courses as $index => $course) {
                $courseDetail = $this->course->getCourseById($course['course_id']);
                ?>

                <li class="list-group-item">

                    <strong><?php echo ucfirst($courseDetail["name"]); ?> </strong>

                    <a target="_blank" href="https://appear.in/concordiaelearn"
                       class="card-link btn btn-primary float-right">Join Class</a>

                </li>

            <?php } ?>

        </ul>

    </div>
</div>