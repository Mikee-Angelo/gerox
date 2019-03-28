<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/industry/img/icon.png" sizes="128x128" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/concept/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url();?>vendors/concept/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/concept/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/concept/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    } 

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <div class="splash-container">
    <?php echo $this->session->flashdata('lgErr'); ?>
        <div class="card ">
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="<?php echo base_url();?>assets/concept/images/newlogo.png" alt="logo"></a></div>
            <div class="card-body">
                <p class="card-title">Please enter your provided email or your id number</p>
                <?php echo form_open('forgot_pwd')?>
                    <div class="form-group">
                        <input class="form-control form-control-lg <?php echo (form_error('forgot_email') ? 'is-invalid' : '');?>" id="main_id" type="text" value="<?php echo set_value('main_id');?>" placeholder="Enter ID or Email" name="forgot_email" autocomplete="off">
                        <div class="invalid-feedback"><?php echo form_error('forgot_email');?></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="forgotbtn">Validate</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="<?php echo base_url();?>vendors/concept/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>vendors/concept/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>