<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <div class="page-header">
            <h2 class="pageheader-title">Logs</h2><hr>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <?php 
                            $this->table->set_heading('Logs', 'Timestamp');
                            echo $this->table->generate();
                        ?>                    
                </div>
            </div>
        </div>
                
