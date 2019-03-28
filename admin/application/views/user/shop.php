<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="page-header">
            <h2 class="pageheader-title">Shop Now</h2><hr>    
            <!-- Button trigger modal -->
        </div>
        <div class="section-block" id="basicform">
       		
            <div class="input-group">
                    <input type="text" class="form-control col-sm-4" id="inputPNo" placeholder="PO Number" value="<?php echo ($po != '' ? $po: '') ?>" disabled>
                    <div class="input-group-append">
                        <button type="button" id="generate" class="btn btn-primary" disabled="true">Generate</button>
                    </div>
            </div>             
        </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php 
                            $this->table->set_heading('Order', 'Quantity', 'Unit Amount', 'Subtotal', 'Date Needed', 'Action');
                            // if(!empty($data)){
                            //     foreach($data as $d){ 
                            //         $sub = $d['quantity'] * $d['amount'];
                            //         $this->table->add_row($d['order'], $d['quantity'], $d['amount'], $sub, '<button class="btn btn-sm btn-danger del" data-del="'.$d['cart_id'].'">Delete</div>');
                                    
                            //     }
                                
                            // }
                            echo $this->table->generate();
                        ?>
                    </div>
                </div>
            </div>           
    </div>
    <div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Some Item</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <form action="" id="formShop">
                    <div class="modal-body">
                        <h3>PO Number: <span id="po"></span></h3>

                        <div class="form-group" id>
                            <label>Date Needed</label>

                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" id="urgent" name="urgent" class="custom-control-input" value="urgent"><span class="custom-control-label">Urgent (3 days delivery)</span>
                            </label>
                            <input type="date" class="form-control date-inputmask" id="date-mask" placeholder="" min="<?php echo date('Y-m-d')?>" >
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
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="button" id="addNew" class="btn btn-primary" data-id="<?php echo $this->session->userdata('id');?>" data-level="<?php echo $this->session->userdata('level');?>"><i class="fas fa-cart-plus mr-1"></i>Add to Cart</a>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <div class="section-block fixed-bottom mr-2" id="basicform">
            <a href="#" class="btn btn-danger ml-2 disabled float-right btn-lg" id="buyNow" data-toggle="modal" data-target="#buyMainModal"><i class="fas fa-plus mr-1"></i>Buy Now</a>                                   
            <a href="#" class=" btn btn-primary ml-2 float-right btn-lg" id="shopAdd" data-toggle="modal" data-target="#shopModal" disabled><i class="fas fa-plus mr-1"></i>Add New</a>  

            <h4 class="float-right ml-3">Total: <span id="maintotal"></span></h4>                   
    </div>

    <div class="modal fade" id="buyMainModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Terms and Condition</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                        <div class="modal-body" id="mainBuybody">
                            <p>1. The order will be provided by the Gerox enterprise in the date that the client set in the system </p>
                            <p>2. The client can not change the date once it is chosen</p>
                            <p>3. Based on the contract you have 10 days after the order is delivered to pay for your order.</p>
                            <p>4. For the urgent orders, 3 days is the most maximum days for your orders to be delivered. But once the products are complete even its less than three days we could deliver immediately.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            <button type="button" id="buyApproved" class="btn btn-primary"><i class="fas fa-user-plus mr-1"></i>Buy</a>
                        </div>
                </div>
            </div>
        </div>                   