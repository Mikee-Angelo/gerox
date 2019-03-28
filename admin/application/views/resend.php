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
    <title>Confirmation</title>
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
            <div class="card-body">
                <p class="card-title">Please wait for a moment, if link was not sent to your email. Please click the button to resend the link to email</p>
                <?php echo form_open('resend_link');?>
                <button class="btn btn-primary" name="rsbtn" value="rslnk">Resend to Email</button>
                <?php echo form_close();?>            
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