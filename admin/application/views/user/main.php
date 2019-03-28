<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="page-header">
            <h2 class="pageheader-title">Orders</h2><hr>
        </div>
        
        <div class="form-group">
            <label for="filter_order">Filter :</label>
            <input type="month" id="fltuserorder" class="form-control col-sm-2" name="start"/>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php 
                            $this->table->set_heading('', 'PO Number', 'Total', 'Date Needed', 'Delivery Status');
                            echo $this->table->generate();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

