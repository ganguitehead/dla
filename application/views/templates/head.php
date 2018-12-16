<!-- URL Helper for all the pages - helps in writing the base_url() function -->
<?php $this->load->helper('url'); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>dla_register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.min.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <!--    <link rel="stylesheet" href="assets/css/fontawesome.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" />

</head>

<!-- Loader for AJAX Requests -->
<div id="siteWideajaxLoader"></div>

<style>
    #siteWideajaxLoader {
        display: none;
        background: url(<?php echo base_url('assets/img/dla_loader.gif'); ?>) 50% 50% no-repeat rgb(249, 249, 249);
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
    }
</style>