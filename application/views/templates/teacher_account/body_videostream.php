<div class="courses-wrapper p-1 shadow-sm mb-2 bg-white rounded">
    <div class="container">
        <h1>My Courses</h1>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded">

        <?php
        if (!is_array($courses) && count($courses) < 1) { ?>

            <div class="alert mt-2 alert-warning" role="alert">You do not have any courses.</div>

        <?php } else {

            ?>


            <ul class="list-group">

                <?php
                if (is_array($courses) && count($courses) > 0) {
                    foreach ($courses as $index => $course) { ?>

                        <li class="list-group-item">

                            <strong><?php echo ucfirst($course["name"]); ?> </strong>

                            <a target="_blank" href="https://appear.in/concordiaelearn"
                               class="card-link btn btn-primary float-right">Start Class</a>

                        </li>

                    <?php }
                } ?>

            </ul>

        <?php } ?>

    </div>
</div>