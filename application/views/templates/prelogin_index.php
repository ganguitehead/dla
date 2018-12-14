<?php
if (is_logged_in()) {
    redirect(base_url() . 'home/');
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

