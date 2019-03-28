<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="page-header">
            <h2 class="pageheader-title">Orders</h2><hr>
        </div>

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
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <?php 
                        $this->table->set_heading('', 'PO Number', 'Tracking Number','Company Name', 'Total', 'Delivery Status', 'Date SI', 'SI Number', 'Date Needed', 'Purchaser', 'More', 'Status', 'Remarks');

                        echo $this->table->generate();
                    ?>
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
