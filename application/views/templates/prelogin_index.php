<?php
if (is_logged_in()) {
    if ($loggedInUserType = getLoggedInUserType()) {
        switch ($loggedInUserType) {
            case 1:
                redirect(base_url() . 'home/');
                break;
            case 2:
                redirect(base_url() . 'phome/');
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<?php $this->load->view('templates/head'); ?>
<body>
<?php $this->load->view('templates/prelogin_nav'); ?>
<?php $this->load->view('templates/body_prelogin_index'); ?>
<?php $this->load->view('templates/footer'); ?>
</body>
</html>

