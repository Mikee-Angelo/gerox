<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="page-header">
            <h2 class="pageheader-title">Reports</h2><hr>
        </div> 

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="filter_order">Filter by Month:</label>
                            <input type="month" id="start" class="form-control col-sm-12" name="start"/>
                        </div>                     
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input-select" >Filter by Company</label>
                            <select class="form-control" id="company">
                                <option value='' selected>All</option>
                                <?php 
                                    foreach($company['id'] as $key => $row):
                                ?>
                                    <option value="<?php echo $row;?>"><?php echo $company['name'][$key];?></option> 
                                <?php endforeach; ?> 
                            </select>
                        </div>                  
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="row mt-3">

            <div class="col-sm-4">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="text-muted">Gross Income</h5>
                        <div class="metric-value d-inline-block" id="rep-container">
                            <h1 class="mb-1" id="rep-text">
                            </h1>
                        </div>
                 
                    </div>
                </div>             
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Net Income</h5>
                        <div class="metric-value d-inline-block" id="net-container">
                            <h1 class="mb-1" id="net-text">
                            </h1>
                        </div>                
                    </div>
                </div>  
            </div>

            <div class="col-sm-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Capital</h5>
                        <div class="metric-value d-inline-block" id="expense-container">
                            <h1 class="mb-1" id="expense-text">
                            </h1>
                        </div>                
                    </div>
                </div>             

            </div>         
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Daily Gross Income</h4>
                <canvas id="myChart">
                </canvas>
            </div>
        </div> 

        <div class="card">
            <div class="card-body">
                <h4>Monthly Income</h4>
                <canvas id="myChart1">
                </canvas>
            </div>
        </div> 

        <div class="card">
            <div class="card-body">
                <h4>Year Income</h4>
                <canvas id="myChart2">
                </canvas>
            </div>
        </div> 

    </div>