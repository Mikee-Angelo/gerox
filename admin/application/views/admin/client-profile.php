<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
    
        <div class="card">               
            <div class="card-body">
                <div class="section-block" id="alerts">
                    <h3 class="section-title"><?php echo $c_data->company_name; ?></h3>
                    <p><?php echo $c_data->authid; ?></p>
                </div> 

                <div class="section-block tab-regular">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="card-tab-1" data-toggle="tab" href="#card-1" role="tab" aria-controls="card-1" aria-selected="true">Orders</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="row mx-auto">
                            <div class="col-sm-4">
                            <div class="form-group">
                                <label for="filter_order">Filter :</label>
                                <input type="month" id="filter_order" class="form-control col-sm-12" name="start"/>
                            </div>                
                            </div>
                            <div class="col-sm-8">
                            <h4 class="card-title">Legends:</h4>
                            <div class="d-inline ">
                                <div class="mr-2" style="height:12px; width:12px; float: left; background-color: #faab92"></div> 
                                <p class="mr-3" style="float: left;">Unfilled</p>           
                            </div>

                            <div class="d-inline">
                                <div class="mr-2" style="height:12px; width:12px; float: left; background-color: #f2c4ca"></div> 
                                <p class="mr-3" style="float: left;">Urgent</p>                 
                            </div>

                            <div class="d-inline">
                                <div class="bg-warning mr-2" style="height:12px; width:12px; float: left; background-color: #fcf0ba"></div> 
                                <p class="mr-3" style="float: left;">Pending</p>                 
                            </div>
                            
                            <div class="d-inline">
                                <div class="mr-2" style="height:12px; width:12px; float: left; background-color: #c2e6ca"></div> 
                                <p class="mr-3" style="float: left;">Delivered</p>                 
                            </div>

                            <div class="d-inline">
                                <div class="mr-2" style="height:12px; width:12px; float: left; background-color: #bfe4ea"></div> 
                                <p class="mr-3" style="float: left;">For Shipping</p>                 
                            </div>

                            <div class="d-inline">
                                <div class="mr-2" style="height:12px; width:12px; float: left; background-color: #bbd6fe"></div> 
                                <p class="mr-3" style="float: left;">On Transit</p>                 
                            </div>                
                            </div>                
                            </div>

                        </div>
                    </div>                
                    <div class="tab-pane fade show active" id="card-1" role="tabpanel" aria-labelledby="card-tab-1">
                        <div class="section-block" id="alerts">
                        <?php 
                                    $this->table->set_heading('', 'PO Number', 'Tracking Number', 'Total', 'Delivery Status', 'Date SI', 'SI Number', 'Date Needed', 'Purchaser' ,'More', 'Status', 'Remarks');
                                    echo $this->table->generate();
                                ?>  
                        </div>
                    </div>

                    <div class="tab-pane fade" id="card-2" role="tabpanel" aria-labelledby="card-tab-2">
                        <div class="section-block" id="alerts">

                        </div>                      
                    </div>
                </div> 
            </div>            
        </div>  
    </div>

<div class="modal fade" id="delstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="del-wrapper"> 
      <div class="modal-body" id="del_stat">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" >Status</h5>
      
        <div class="form-check">
            <input type="checkbox" class="form-check-input" value="2" id="fd" disabled/>
            <label for="fd" class="form-check-label">for Shipping</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" value="3" id="ot" disabled/>
            <label for="ot" class="form-check-label">On transit</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" value="4" id="del" disabled/>
            <label for="del" class="form-check-label">Delivered</label>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="del-wrapper"> 
      <div class="modal-body" id="del_stat">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" >Status</h5>
        <div class="form-group">
            <label for="authorder">Please enter your password for authentication</label>
            <input type="password" class="form-control" id="authorder" placeholder="Enter Password">
            <button class="btn btn-primary" id="authbtn" value="">Authenticate</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Some Item</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                    </a>
                </div>

                    <div class="modal-body">
                        <h3>PO Number: <span id="po"><?php echo ($po != '' ? $po : '') ?></span></h3>
       		
                        <div class="input-group">
                                <input type="text" class="form-control col-sm-4" id="inputPNo" placeholder="PO Number" value="<?php echo ($po != '' ? $po : '') ?>" disabled>
                                <div class="input-group-append">
                                    <button type="button" id="generate" class="btn btn-info" disabled="true">Generate</button>
                                </div>
                        </div>    

                        <form action="" id="formShop">
                        <div class="form-group" >
                            <label>Date Needed</label>

                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" id="urgent" name="urgent" class="custom-control-input" value="urgent"><span class="custom-control-label">Urgent (3 days delivery)</span>
                            </label>
                            <input type="date" class="form-control date-inputmask" id="date-mask" placeholder="">
                        </div>
                                                
                        <div class="form-group">
                            <label for="order" class="col-form-label">Order Name</label>
                            <input id="order" type="text" class="form-control" required>
                        </div>  
                                                
                        <div class="form-group">
                            <label for="quantity" class="col-form-label">Quantity</label>
                            <input id="quantity" type="number" class="form-control" required>
                        </div> 

                        <div class="form-group">
                            <label for="amount" class="col-form-label">Unit Amount</label>
                            <input id="amount" type="number" class="form-control" required>
                        </div>      

                        <h4>Subtotal: <span id="total"></span></h4>
                        <button type="button" id="addNew" class="btn btn-info float-right mb-2" data-id="<?php echo $this->session->userdata('id');?>" data-level="<?php echo $this->session->userdata('level');?>"><i class="fas fa-cart-plus mr-1"></i>Add to Table</button>
                        </form>
                         
                        <div class="table-responsive">         
                        <hr>               
                          <table id="shopTbl" class="table table-striped table-bordered display nowrap" width="100%">
                              <thead>
                                  <tr>
                                    <th>Order</th>
                                    <th>Quantity</th>
                                    <th>Unit Amount</th>
                                    <th>Subtotal</th>
                                    <th>Date Needed</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody> 
                              </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-danger ml-2 float-right disabled" id="buyApproved" ><i class="fas fa-plus mr-1"></i>Add Record</a>  
                    </div>
                
            </div>
        </div>
    </div>    
    <div class="section-block fixed-bottom mr-2" id="basicform">                                 
            <a href="#" class=" btn btn-info ml-2 float-right btn-lg" id="shopAdd" data-toggle="modal" data-target="#shopModal"><i class="fas fa-plus mr-1"></i>Add New</a>               
    </div>