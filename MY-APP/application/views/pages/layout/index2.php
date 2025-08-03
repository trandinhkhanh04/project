<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('pages/component/head'); ?>
</head>

<body class="body_web">
    <?php $this->load->view('pages/component/loader'); ?>
    <?php $this->load->view('pages/component/header'); ?>
    
    <?php $this->load->view($template); ?>
    

</body>
<?php $this->load->view('pages/component/script'); ?>

</html>