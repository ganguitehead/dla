<!DOCTYPE html>
<html>
<?php $this->load->view('templates/head'); ?>

<body>

<div class="contaner">

    <div class="row">

        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <div class="text-center">Class Reminder</div>

                    <!--                    <i style="font-size: 50px;color: #1485ee;" class="fas fa-bell"></i>-->

                    <img style="height:100px" src="<?php echo base_url('assets/img/bell-email.jpg'); ?>"/>

                </h5>
                <p class="card-text">
                <p>Dear $username,
                <p>

                    <strong>This is a reminder that your class ( Class Name - Section Name ) </strong>
                <p>is starting in 5 minutes</p>

                </p>
                <a href="#" class="btn btn-primary">Login</a>
            </div>
        </div>

    </div>

</div>

</body>
</html>


