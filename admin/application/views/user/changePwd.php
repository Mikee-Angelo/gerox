<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="page-header">
            <h2 class="pageheader-title">Change Password</h2><hr>
        </div>

        <div class="card col-sm-6 mx-auto">
            <div class="card-header">
                <?php 
                    echo $this->session->flashdata('change_1'); 
                    echo $this->session->flashdata('change_2'); 
                    echo $this->session->flashdata('change_3'); 
                ?>
                <div class="card-body">
                    <p>Please secure your password to avoid stealing of data and unknown orders in your accounts</p>

                    <?php echo form_open('cpwd'); ?>
                        <div class="form-group">
                            <label for="opwd" class="opwd">Old Password</label>
                            <input id="opwd" type="password" name="opwd" class="form-control <?php echo (form_error('opwd') ? 'is-invalid': '' ) ?>">
                            <div class="invalid-feedback"><?php echo form_error('opwd');?></div>                       
                        </div>
                        
                        <div class="form-group">
                            <label for="npwd" class="opwd">New Password</label>
                            <input id="npwd" type="password" name="npwd" class="form-control <?php echo (form_error('npwd') ? 'is-invalid': '' ) ?>">
                            <div class="invalid-feedback"><?php echo form_error('npwd');?></div>                       
                        </div>

                        <div class="form-group">
                            <label for="conf_pwd" class="conf_pwd">Confirm New Password</label>
                            <input id="conf_pwd" type="password" name="conf_pwd" class="form-control <?php echo (form_error('conf_pwd') ? 'is-invalid': '' ) ?>">
                            <div class="invalid-feedback"><?php echo form_error('conf_pwd');?></div>                       
                        </div>

                        <button type="submit" id="cpwd_btn" class="btn btn-primary btn-block">Submit</button> 
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    