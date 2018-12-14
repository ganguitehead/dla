<div class="courses-wrapper p-1 shadow-sm mb-2 bg-white rounded">
    <div class="container">
        <h1>Courses</h1>
    </div>

    <div class="container shadow p-3 mb-5 bg-white rounded">

        <div class="form-group shadow-sm p-3 mb-3 bg-white rounded">
            <input class="form-control" id="myInput" type="text" placeholder="Search Courses">
        </div>


        <div class="row">

            <?php foreach ($courses as $index => $course) { ?>

                <div class="col-md-4 <?php echo $index > 2 ? 'mt-2' : ''; ?> ">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><u> <?php echo ucfirst($course["name"]); ?> </u></h5>

                            <p class="card-text"> <?php echo ucfirst($course["description"]); ?> </p>

                            <a href="<?php echo base_url('courses/enroll/cid/') . base64_encode($course["id"]); ?>"
                               class="card-link btn btn-primary">Enroll</a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>