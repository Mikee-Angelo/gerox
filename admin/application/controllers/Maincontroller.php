<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Maincontroller extends CI_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model('mainmodel');
    }

    //public function index(){
    //    $this->load->view('site'); 
    //}
 
    public function index(){

        if($this->session->userdata('isLoggedIn') == true){
            if($this->session->userdata('level') == 'admin'){
                redirect('admin');
            }
            
            redirect('user');
        }
        $this->form_validation->set_rules('main_id', 'ID/Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

        if($this->form_validation->run() === false){
            $this->load->view('login');
        }else{
            $email = $this->input->post('main_id');
            $password = $this->input->post('password');

            $data = ['authid' => $email, 'password' => $password];
            $result = $this->mainmodel->authLogin($data);

            switch($result['level']){
                case 'admin':
                    $this->session->set_userdata('auth_id', $result['auth_id']);
                    $this->session->set_userdata('name', $result['name']);
                    $this->session->set_userdata('level', $result['level']);    
                    $this->session->set_userdata('isLoggedIn', true);
                    redirect('admin');
                break;

                case 'user':
                    $this->session->set_userdata('id', $result['id']);
                    $this->session->set_userdata('email', $result['authid']);
                    $this->session->set_userdata('name', $result['name']);
                    $this->session->set_userdata('level', $result['level']);    
                    $this->session->set_userdata('isLoggedIn', true);
                    redirect('user');
                break;

                default:
                    $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Please check your Email/Password</div>');
                    $this->load->view('login');
            }
        }
        
    }
    
    public function toForgotPwd(){
        $this->form_validation->set_rules('forgot_email', 'ID / Email', 'trim|required|min_length[8]');

        if($this->form_validation->run() === FALSE){
            $this->load->view('forgot_pwd');
        }else{
            $email = $this->input->post('forgot_email');
            $data = ['email' => $email];

            $init = $this->mainmodel->authIdEmail($data);
            
            if($init == false){
                $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Email/ID not exist</div>');
                redirect('forgot_pwd');
            }else{
                $token = $this->generateToken($init['authid']);
                $initemail = $this->initMail($init, $token);
                var_dump($token);
                if($initemail == false){
                    $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Oops ! Please try again later</div>');
                    redirect('forgot_pwd');
                }else{
                    $this->session->set_userdata($init);
                    redirect('resend_link');
                } 
            }

        }
    }

    public function toResendEmail(){
        if(empty($this->session->userdata('email'))){
            $this->session->destroy();
            $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Oops ! Something went wrong</div>');
            redirect('');
        }
        $this->load->view('resend');
        
        if($this->input->post('rsbtn') == 'rslink'){
            $data['company_name'] = $this->session->company_name;
            $data['email'] = $this->session->email;
            $data['authid'] = $this->session->authid;
            $token = $this->generateToken($data['authid']);
            $initEmail = $this->initMail($data, $token);

            if($initEmail == false){
                $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Oops ! Something went wrong</div>');
            }
        }
    }

    public function toNewPassword(){
        $token['token'] = $this->uri->segment(2,0);
        
        $this->form_validation->set_rules('npwd', 'New Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('cpwd', 'Confirm Password', 'trim|required|min_length[5]');
        if($this->form_validation->run() === false){
            $this->load->view('newpwd', $token);
        }else{
            if($this->input->post('npwd') != $this->input->post('cpwd')){
                $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Password not match</div>');
                redirect('authkey/'.$token);
            }else{
                $timestamp = substr($token['token'], 8);
                $id = substr($token['token'], 0,8);

                $conv_time = date('H:i:s', $timestamp);
                
                if(time() != $timestamp){
                     $data = ['authid' => $id, 'password' => $this->input->post('cpwd')];

                    $init = $this->mainmodel->changePassword($data);

                    if($init == false){
                        $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Something went wrong</div>');
                        redirect('authkey/'.$token);
                    }else{
                        $this->session->sess_destroy();
                        $this->session->set_flashdata('lgErr', '<div class="alert alert-success">You Successfully changed your password</div>');
                        redirect('');
                    }
                }else{
                    $this->session->sess_destroy();
                     redirect('');
                     $this->session->set_flashdata('lgErr', '<div class="alert alert-danger">Expired url token</div>');
                   
                }

            }
        }
    }
    //SENDING EMAIL TO THE USER IF PASSWORD WAS FORGOTTEN
    private function initMail($data, $token){
        $a['data'] = ['title' => 'Test Email']; 
        $test = $this->phpmailer_lib->load();
        $test->isSMTP();
        $test->Mailer = "smtp";
        $test->Port = 25;
        $test->Host = 'mail.gerox.x10host.com';
        $test->SMTPAuth = true;
        $test->Username = 'mail@gerox.x10host.com';
        $test->Password = '12347890';
        

        $test->setFrom('mail@gerox.x10host.com', 'Gerox Enterprises');
        //EMAIL RECIPIENT
        $test->addAddress($data['email']);        
        $test->Subject = 'Change Password';
        $test->isHTML(true);

        $mailContent = "
            <h1>".$data['company_name'].",</h1><br/>
            <p>It looks like you requested a new password</p><br/>
            <p>If that sounds right, you can enter new password by clicking the link below</p><br/>
            <a href='http://admin.gerox.x10host.com/authkey/".$token."'>http://admin.gerox.x10host.com/authkey/".$token."</a>
            ";

        $test->Body = $mailContent;

        if(!$test->Send()){
            return false;      
        }else{
            return true;
        }
    }

    private function generateToken($id){
        date_default_timezone_set('Asia/Manila');
        $cur_time = date('H:i:s');
        $add_time = strtotime($cur_time) + 7200;
        $recipe = $id.''.$add_time;

        return $recipe;
    }

    private function decryptToken($token){

    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('');
    }
########################### ADMIN PAGE ##########################
    public function admin(){

        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }
        $a['data'] = ['title' => 'Admin Dashboard'];
        $template = array(
            'table_open' => '<table id="test" class="table table-striped table-bordered display nowrap" width="100%">');

        $this->table->set_template($template);       
        $this->load->view('admin/template/header',$a);
        $this->load->view('admin/main');
        $this->load->view('admin/template/footer');
    }

    public function adminOrderDash(){

        $filter['filter_data'] = $this->input->post('filter_data');
        $filter['filter_info'] = $this->input->post('filter_noti');

        $fd = $this->mainmodel->showAdminOrder($this->input->post('draw'), 'admin', $filter);
        
        if($fd == true){
            echo json_encode($fd);
        }
    }

    public function showClients(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }
        $a['data'] = ['title' => 'Admin - Clients'];

        $template = array(
            'table_open' => '<table id="adminClientTbl" class="table table-striped table-bordered display nowrap" width="100%">');

        $this->table->set_template($template);
        $this->load->view('admin/template/header',$a);
        $this->load->view('admin/clients');
        $this->load->view('admin/template/client-footer');        
    }

    public function generateId(){
        if($this->input->post('genid') == 1){
            // $genpwd = mt_rand(10001,99999);
            // $x = $this->mainmodel->genIdModel();

            // if($x !== false){
            //     $arr['genid'] = $x;
            //     $arr['genpwd'] = $genpwd;

            //     echo json_encode($arr);
            // }elseif($x == NULL){
            //     $rand = mt_rand(10000000, 99999999);
            //     $y = $this->mainmodel->getIdModel($rand);
            // }
            $rand = mt_rand(10000000, 99999999);
            $x = $this->mainmodel->genIdModel($rand);

            if($x == true){
                $arr['genid'] = $rand;

                echo json_encode($arr);
            }
        }
    }

    public function showAdminClients(){
        $draw = $this->input->post('draw');

        $query = $this->mainmodel->adminClientModel($draw, 'admin');

        if($query !== false){
            echo json_encode($query);
        }else{
            echo json_encode(false);
        }
    }

    public function addAdminClients(){
        $this->form_validation->set_rules('compname', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('compaddr', 'Company Address', 'trim|required');

        if($this->form_validation->run() === true){
            $compid  = $this->input->post('compid');
            $compname = $this->input->post('compname');
            $compaddr = $this->input->post('compaddr');
            $compemail = $this->input->post('compemail');
            
            $data_a = ['company_name' => $compname, 'address' => $compaddr, 'status' => 0]; 
            $data_b = ['authid' => $compid, 'level' => 'user', 'email' => $compemail];
            
            $qa = $this->mainmodel->insertAdminInfos($data_a, $data_b);

            if($qa == true){
                echo json_encode(true);
            }elseif($qa == false){
                echo json_encode(false);
            }elseif($qa == 2){
                echo json_encode(2);
            }
        }
    }

    public function showClientProfile(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }
        $a['data'] = ['title' => 'Clients Profile'];
        
        $data = '';
        $id = $this->uri->segment(2,0);
        $query = $this->mainmodel->showProfileData($id);

        $template = array(
            'table_open' => '<table id="profileOrderTbl" class="table table-striped table-bordered display responsive-table nowrap" width="100%">');

        $init = $this->mainmodel->getPO($id);
        
        if($init != false){
            $data = $init;
        }

        $b['po']= $data;
            
        $this->table->set_template($template);  
        
        $b['c_data'] = $query; 
        $this->load->view('admin/template/header',$a);
        $this->load->view('admin/client-profile',$b);
        $this->load->view('admin/template/adminuserinfo');        
    }

    public function getProfOrdData(){
        $draw = $this->input->post('draw');
        $authId['id'] = $this->input->post('authid');
        $authId['filter_data'] = $this->input->post('filter_data');
        $authId['filter_noti'] = $this->input->post('filter_noti');

        $query = $this->mainmodel->profOrdDataModel($draw, 'admin', $authId);

        if($query !== false){
            echo json_encode($query);
        }else{
            echo json_encode(false);
        }
    }

    //REPORTS PAGE - SHOWING ALL REPORTS
    public function showReports(){
        $a['data'] = ['title' => 'Admin - Reports'];

        $init = $this->mainmodel->getAllCompany();

        $data['company'] = $init;

        $this->load->view('admin/template/header',$a);
        $this->load->view('admin/reports',$data);
        $this->load->view('admin/template/report-footer');        
    }

    public function sumReport(){
        $sd = $this->input->post('sd');
        $company = $this->input->post('company');

        $val = $this->mainmodel->reportsModel($sd, $company); //get all the data for reports
        $mon = $this->mainmodel->getMonthlyReport($sd, $company);
        $year = $this->mainmodel->getYearlyReport($sd, $company);
        echo json_encode(['total' =>$val['total'], 'expense' => $val['expense'], 'net' => $val['net'], 'eachdate' => $val['eachdate'], 'dateGross'=> $val['dateGross'] , 'monthlyGross' => $mon['monthly'], 'monthlyAct' => $mon['monactpri'] , 'yearlyGross' => $year['yearly'] , 'yearLabel' => $year['label']]); 
    }

    //EDIT ORDER INFO
    public function editOrderInfo(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }
        
        $oi = $this->uri->segment(2); //GETTING THE ID TO THE URL
        $e_data = $this->mainmodel->showEditProduct($oi); 
        $data['ei'] = $e_data;
    
        //VALIDATION
        $this->form_validation->set_rules('date_si', 'Date', 'trim|required');
        $this->form_validation->set_rules('si_num', 'SI Number', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim');
        $this->form_validation->set_rules('dby', 'Delivered by', 'trim');
        $this->form_validation->set_rules('epwd', 'Password', 'trim|required');
        
        if($this->form_validation->run() == false){
            $a['data'] = ['title' => 'Admin - Edit Product'];
            $this->load->view('admin/template/header',$a);
            $this->load->view('admin/editproduct', $data);
            $this->load->view('admin/template/edit-info-footer'); 
        }else{

            $date_si = $this->input->post('date_si');
            $si_num = $this->input->post('si_num');
            $remarks = $this->input->post('remarks');
            $dby = $this->input->post('dby');
            $epwd = $this->input->post('epwd');
            $id = $this->session->userdata('id');

            $data = ['date_si' => $date_si, 'si_num' => $si_num, 'remarks' => $remarks, 'dby' => $dby];
            $sec_user = ['admin_id' => $this->session->userdata('auth_id'), 'admin_pwd' => $epwd];
 
            $em = $this->mainmodel->updateProdInfo($sec_user, $oi, $data);

            if($em == true){
                 $this->session->set_flashdata('edit_true', '<div class="alert alert-success">Product successfully updated <a href="'.base_url().'admin">Back to Main Menu</a></div>');
                 redirect('edit-prof-info/'.$oi);
            }elseif($em == 3 ){
                $this->session->set_flashdata('edit_changes', '<div class="alert alert-success">No changes Made <a href="'.base_url().'admin">Back to Main Menu</a></div>');
                redirect('edit-prof-info/'.$oi);    
            }else{
                 $this->session->set_flashdata('edit_false', '<div class="alert alert-danger">Please check you password</div>');
                 redirect('edit-prof-info/'.$oi);
            }
        }
    }

    //GETTING CHECKBOX FOR DELIVERY STATUS
    public function checkbox(){
        $ord_id = $this->input->post('ord_id');
        $cb_val = $this->input->post('cb_val');

        $data = ['order_id' => $ord_id, 'del_status' => $cb_val];

        $output = $this->mainmodel->updateDelStatus($data);

        if($output == false){ 
            echo json_encode('There is something wrong');
        }else{
            echo json_encode(true);
        }
    }

    public function initAdminNoty(){
        $init = $this->mainmodel->initAdminNoty();

        if($init != false){
            echo json_encode($init);
        }else{
            echo json_encode(false);
        }
    }

    public function deleteOrder(){
        $o_id = $this->input->post('del_id');
        $order_pwd = $this->input->post('order_pwd');

        if(!empty($o_id) && !empty($order_pwd)){
            $data = ['oid' => $o_id, 'opwd' => $order_pwd];
            $query = $this->mainmodel->deleteOrder($data);

            if($query == true){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }
        }
    }

    public function editItemStat(){
        $itemId = $this->input->post('data');

        if(!empty($itemId)){
            $data = ['products_id' => $itemId];
            $init =$this->mainmodel->editItemStat($data);

            echo json_encode($init);
        }else{
            echo json_encode(false);
        }
    }

    //Edit each Actual Price
    public function editPrice(){
        $id = $this->input->post('id');
        $eval = $this->input->post('eval');

        if(!empty($id) && !empty($eval)){
            $data = ['products_id' => $id, 'act_pri' => $eval];
            
            $init = $this->mainmodel->editPrice($data);

            if($init == true){
                echo json_encode($data['act_pri']);
            }else{
                echo json_encode(false);
            }
        }else{
            echo json_encode(false);
        }   
    }

    public function showLogs(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }
        

        $a['data'] = ['title' => 'Logs'];

        $template = array(
            'table_open' => '<table id="logstbl" class="table table-striped table-bordered display nowrap" width="100%">'); 

        $this->table->set_template($template); 
        $this->load->view('admin/template/header',$a);
        $this->load->view('admin/logs');
        $this->load->view('admin/template/logs-footer');            
    }

    public function showtblLogs(){
        $draw = $this->input->post('draw');

        $data = $this->mainmodel->showLogs($draw);
        echo json_encode($data);
    }
########################### USER PAGE ##########################
    public function user(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }
        $a['data'] = ['title' => 'User Dashboard'];
        $template = array(
            'table_open' => '<table id="usertbl" class="table table-striped table-bordered display nowrap" width="100%">');
        
        $this->table->set_template($template);       
        $this->load->view('user/template/header',$a);
        $this->load->view('user/main');
        $this->load->view('user/template/footer');
    }

    public function shopNow(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }      
        $data = '';
        $a['data'] = ['title' => 'User - Shop Now'];
        $template = array('<table_open' => '<table id="shopTbl" class="table table-striped table-bordered display nowrap" width="100%">');

        $init = $this->mainmodel->getPO($this->session->userdata('id'));
        
        if($init != false){
            $data = $init;
        }

        $a['po']= $data;

        //SETTING TITLE TO CART PAGE
        $b['data'] = ['title' => 'Shopping Cart'];

        $this->table->set_template($template);       
        $this->load->view('user/template/header',$b);
        $this->load->view('user/shop',$a);
        $this->load->view('user/template/footer');
    }    

    public function genpo(){
        $data = ['cart_po_num' => $this->input->post('genpo'), 'user_id' => $this->input->post('id')];
        $errors = array_filter($data);
        if(!empty($data)){
            $init = $this->mainmodel->genpo($data);
            if($init != false){
                echo json_encode($data['cart_po_num']);
            }
        }else{
            return false;
        }
    }
    //INSERTING DATA TO DATABASE
    public function insertCartData(){

        $this->form_validation->set_rules('ord', 'Order', 'trim|required');
        $this->form_validation->set_rules('qty', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('amnt', 'Amount', 'trim|required');
        $this->form_validation->set_rules('nd', 'Needed Date', 'trim|required');

        //VALIDATION OF SENDING ORDERS TO CART
        if($this->form_validation->run() == true){
            $po = $this->input->post('po');
            $ord = $this->input->post('ord');
            $qty = $this->input->post('qty');
            $amnt = $this->input->post('amnt');
            $nd = $this->input->post('nd');
            $id =  $this->session->userdata('id');
            
            $cart_id = ['user_id'=> $po];
            $cart = ['need_date' => $nd];
            $product = ['cart_order' => $ord, 'cart_quantity' => $qty, 'cart_amount' => $amnt];

            $data = ['cart_id' => $cart_id, 'cart' => $cart, 'product' => $product];
            $i = $this->mainmodel->addCart($data);

            echo json_encode($i);
        }        
    }
    //DELETING DATA FROM CART TO DATABASE
    public function delCartData(){
        $delId = $this->input->post('del_id');
        if(isset($delId)){
            $q = $this->mainmodel->delCartItem($delId);

            if($q == true){
                echo json_encode($q);
            }
        }
    }

    //GETTING AND SETTING UP SERVER-SIDE DATATABLE
    public function getJsonShop(){
        //$id = $this->session->userdata('id');
        $id = $this->input->post('uri');
        $fetch_data = $this->mainmodel->showCart($this->input->post('draw'), 'user',$id);

        echo json_encode($fetch_data);
    }
    //GETTING ALL USERS ORDER SETTING UP SERVER-SIDE DATATABLE
    public function getUserOrder(){
        
        $id = [ 'id' =>$this->session->userdata('id') , 'filter' => $this->input->post('filter_user_order')];

        $fetch_data = $this->mainmodel->showUserOrder($this->input->post('draw'), 'user', $id);

        if($fetch_data){
            echo json_encode($fetch_data);
        }
    }

    //BUY NOW FUNCTION
    public function buyFunction(){
        $ponum = $this->input->post('ponum');

        if(!empty($ponum)){
            $query = $this->mainmodel->insertBuy($ponum);
            
            echo json_encode($query);         
        }
    }

    //SETTINGS PAGE
    public function toSettings(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }

        $b['data'] = ['title' => 'Settings'];

        $this->load->view('user/template/header',$b);
        $this->load->view('user/settings');
        $this->load->view('user/template/footer');

    }

    public function changePwd(){
        if($this->session->userdata('isLoggedIn') !== true){
            redirect('login');
        }
        $b['data'] = ['title' => 'Change Password'];

        $this->form_validation->set_rules('opwd', 'Old Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('npwd', 'New Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('conf_pwd', 'Confirm New Password', 'required|trim|min_length[5]');
        
        if($this->form_validation->run() == false){
            $this->load->view('user/template/header',$b);
            $this->load->view('user/changePwd');
            $this->load->view('user/template/footer');    
        }else{
            $id = $this->session->userdata('id');
            $opwd = $this->input->post('opwd');
            $npwd = $this->input->post('npwd');
            $conf_pwd = $this->input->post('conf_pwd');

            $data = ['id' => $id, 'old' => $opwd, 'new' => $npwd, 'conf' => $conf_pwd];

            $init = $this->mainmodel->updatePwd($data);

            switch($init){
                case 'err_old':
                    $this->session->set_flashdata('change_1', '<div class="alert alert-danger">Wrong old password</div>');
                    redirect('cpwd');
                break;

                case 'err_conf':
                    $this->session->set_flashdata('change_2', '<div class="alert alert-danger">Password mismatch, please check your new password</div>');
                    redirect('cpwd');
                break; 
                
                case 'success':
                    $this->session->set_flashdata('change_3', '<div class="alert alert-success">You successfully changed your password</div>'); 
                    redirect('logout'); 
                break;                   
            }
        }
    }

    public function initUserNoti(){
        $id =$this->session->userdata('id');
        $init = $this->mainmodel->initUserNoti($id);

        echo json_encode($init);
    }
} 