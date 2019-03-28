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
    <title>New Password</title>
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
        <div class="card">
        <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="<?php echo base_url();?>assets/concept/images/newlogo.png" alt="logo"></a><span class="splash-description">New Password.</span>
        <div class="card-body">
                <?php echo form_open('authkey/'.$token)?>
                    <div class="form-group">
                        <input class="form-control form-control-lg <?php echo (form_error('npwd') ? 'is-invalid' : '');?>" id="npwd" type="password" value="<?php echo set_value('npwd');?>" placeholder="New Password" name="npwd" autocomplete="off" minlength="5">
                        <div class="invalid-feedback"><?php echo form_error('npwd');?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg <?php echo (form_error('cpwd') ? 'is-invalid' : '');?>" id="cpwd" type="password" value="<?php echo set_value('cpwd');?>" placeholder="Confirm Password" name="cpwd" autocomplete="off" minlength="5">
                        <div class="invalid-feedback"><?php echo form_error('cpwd');?></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="npbtn">Confirm</button>
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