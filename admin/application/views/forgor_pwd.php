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
    <title>Login</title>
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
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="<?php echo base_url();?>assets/concept/images/newlogo.png" alt="logo"></a><span class="splash-description">Plase enter your user information.</span></div>
            <div class="card-body">
                <?php echo form_open('')?>
                    <div class="form-group">
                        <input class="form-control form-control-lg <?php echo (form_error('main_id') ? 'is-invalid' : '');?>" id="main_id" type="number" value="<?php echo set_value('main_id');?>" placeholder="ID" name="main_id" autocomplete="off" maxlength="7">
                        <div class="invalid-feedback"><?php echo form_error('main_id');?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg <?php echo (form_error('password') ? 'is-invalid' : '');?>" id="password" type="password" name="password" placeholder="Password">
                        <div class="invalid-feedback"><?php echo form_error('password');?></div>
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="signin">Sign in</button>
                <?php echo form_close(); ?>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
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