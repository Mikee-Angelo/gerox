<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">

        <div class="page-header">
            <a href="#" class=" btn btn-info ml-2 float-right btn-lg" id="create_profile" data-toggle="modal" data-target="#createProfile"><i class="fas fa-plus mr-1"></i>Add New</a>    
            <h2 class="pageheader-title">Register Clients</h2><hr>
        </div>

        <div class="alert alert-success d-none" id="scg" role="alert">Client Information Successfully Generated</div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <?php 
                            $this->table->set_heading('Company Name', 'ID', 'Email', 'Address');

                            echo $this->table->generate();
                        ?>                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="createProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Client</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <form action="" id="genUserForm">
                        <div class="modal-body">
                            <h3>ID Number: <span id="genid"></span></h3>
                                                    
                            <div class="form-group">
                                <label for="compname" class="col-form-label">Company Name</label>
                                <input id="compname" type="text" class="form-control" name="compname" required>
                                <div class="invalid-feedback">Enter a Company Name</div>
                            </div>  

                            <div class="form-group">
                                <label for="compemail" class="col-form-label">Email</label>
                                <input id="compemail" type="email" class="form-control" name="compemail" required>
                                <div class="invalid-feedback">Enter a Company Email</div>
                            </div>  

                            <div class="form-group">
                                <label for="compname" class="col-form-label">Address</label>
                                <input id="compaddr" type="text" class="form-control" name="compaddr" required>
                                <div class="invalid-feedback">Enter a Company Address</div>
                            </div>       

                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            <button type="button" id="genuser" value="" class="btn btn-info"><i class="fas fa-user-plus mr-1"></i>Add</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>    