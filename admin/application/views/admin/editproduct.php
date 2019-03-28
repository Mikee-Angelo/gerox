<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="page-header">
            <h2 class="pageheader-title">Edit Orders</h2><hr>
        </div>
        <?php 
        echo $this->session->flashdata('edit_true'); 
        echo $this->session->flashdata('edit_false'); 
        echo $this->session->flashdata('edit_changes'); 
        ?>
        <div class="row">
        <div class="col-sm-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Product Info</h3>
                    <dt>PO Number</dt>
                    <dd><?php echo $ei['po_num'];?></dd>

                    <dt>Tracking Number</dt>
                    <dd><?php echo $ei['tracking'];?></dd>

                    <dt>Total</dt>
                    <dd> &#8369; <?php echo $ei['sum']?></dd>

                    <dt>Delivery Status</dt>
                    <dd class="text-<?php echo ($ei['del_status'] == 'pending' ? 'danger': 'success')?>")><?php echo $ei['del_status'];?></dd>
                </div>
            </div> 
            
            <div class="card">
                <div class="card-body">
                     <h3 class="card-title">SI Info</h3>
                    <?php 
                    $oi = $this->uri->segment(2);
                    echo form_open('edit-prof-info/'.$oi); 
                    ?>
                        <div class="form-group">
                            <label for="date_si" class="col-form-label">SI Date</label>
                            <input id="date_si" type="date" name="date_si" class="form-control <?php echo (form_error('date_si') ? 'is-invalid': '' ) ?>" value="<?php echo $ei['date_si']?>">
                            <div class="invalid-feedback"><?php echo form_error('date_si');?></div>
                        </div>

                        <div class="form-group">
                            <label for="si_num" class="col-form-label">SI Number</label>
                            <input id="si_num" type="number" name="si_num" class="form-control <?php echo (form_error('si_num') ? 'is-invalid': '' ) ?>" value="<?php echo $ei['si_num'] ?>">
                            <div class="invalid-feedback"><?php echo form_error('si_num');?></div>
                        </div>

                        <div class="form-group">
                            <label for="input-select" >Delivered By: </label>
                            <select class="form-control" id="dby" name="dby" value="">
                                <option value='Angelo Zapanta' <?php echo ($ei['dby'] == 'Angelo Zapanta' ? 'selected': '');?>>Angelo Zapanta</option>
                                <option value='Jeric Quito' <?php echo ($ei['dby'] == 'Jeric Quito' ? 'selected': '');?>>Jeric Quito</option>
                            </select>
                        </div>    


                        <div class="form-group">
                            <label for="remarks">Remarks: </label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3" ><?php echo $ei['remarks'];?></textarea>
                        </div>                        
                </div>
            </div>   

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Submit</h3>
                    <p>Please retype your password to proceed editing of products</p>
                    <div class="form-group">
                            <label for="epwd" class="col-form-label">Password</label>
                            <input id="epwd" type="password" name="epwd" class="form-control <?php echo (form_error('epwd') ? 'is-invalid': '' ) ?>">
                            <div class="invalid-feedback"><?php echo form_error('epwd');?></div>
                    </div>       

                    <button type="submit" id="e_btn_sbmt" class="btn btn-info btn-block" disabled>Submit</button>             
                </div>
            </div>
             <?php echo form_close(); ?>                               
        </div>

        <div class="col-sm-6 mx-auto">   

            <div class="card" style="height:80vh">
                <div class="card-body">
                <button type="button" class="btn btn-info btn-xs float-right" data-toggle="modal" data-target="#delstatus"><i class="fa fa-edit"></i></button>
                <h3 class="card-title">Products</h3>

                    <div class="product-main-wrapper" style="height:95%; overflow-y: scroll;background-color: #F5F5F5;">
                        <?php 
                            foreach($ei['products'] as $key => $row):
                        ?>
                            <div class="card" style="margin:5px 10px 0px 10px" id="mdata<?php echo $key ?>">
                                <div class="card-body">
                                    <dt class="card-title ">Order Name: <?php echo $row['order']?></dt>
                                    <dd class="float-right">Capital: &#8369; <span id="acw<?php echo $key ?>"><?php echo $row['act_pri']?></span></dd> 
                                    <dd>Amount: &#8369; <?php echo $row['u_amount']?></dd>
                                    <dd>Subtotal: &#8369; <span id="msub<?php echo $key ?>"><?php echo $row['qty'] * $row['u_amount']?></span></dd>
                                    <dd >Gross: &#8369; <span id="mtotal<?php echo $key ?>"><?php echo ( $row['act_pri'] == 0 ? 0 : ($row['qty'] * $row['u_amount']) - $row['act_pri']) ?></span></dd>
                         
                                </div>
                            </div>
                        <?php endforeach;?>                    
                    </div>
                </div>
            </div>  
        </div>
        </div>
    </div>

    <div class="modal fade" id="delstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" height="100px">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="del-wrapper"> 
            <div class="modal-body" id="del_stat">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" >Product Lists</h5>
            
                    <div class="product-wrapper mt-3" id="pw" style="overflow-y:scroll; height:100%">
                        <?php 
                                foreach($ei['products'] as  $key =>$row):
                            ?>
                                <div class="card" style="margin-right: 10px; margin-left: 10px" id="cdata<?php echo $key ?>">
                                    <div class="card-body">
                                        <dt class="card-title ">Order Name: <?php echo $row['order']?></dt>
                                        <dd class="float-right">Capital: &#8369; <span id="actpri<?php echo $key ?>"><?php echo $row['act_pri']?></span></dd> 
                                        <dd>Amount: &#8369; <?php echo $row['u_amount']?></dd>
                                        <dd>Quantity: <?php echo $row['qty']?></dd>
                                        <dd>Subtotal: &#8369; <span id="subtotal<?php echo $key ?>"><?php echo $row['qty'] * $row['u_amount']?></span></dd>
                                        <dd >Gross: &#8369; <span id="maintotal<?php echo $key ?>"<?php echo ( $row['act_pri'] == 0 ? 0 : ($row['qty'] * $row['u_amount']) - $row['act_pri']) ?></span></dd>

                                        <form class="form-inline">
                                            <div class="form-group mb-2">
                                                <input type="number" class="form-control" id="editinfo<?php echo $key ?>" value="<?php echo $row['act_pri'] ?>" placeholder="Enter Capital">
                                            </div>
                                            <button type="button" class="btn btn-primary mb-2 btn-sm" id="button<?php echo $key ?>" value="<?php echo $row['products_id'] ?>">Edit</button>
                                        </form>            
     
                                    </div>
                                </div>
                        <?php endforeach;?>                    
                    </div> 
            </div>
        </div>
    </div>
    </div>    