<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Mainmodel extends CI_Model{
    private $c = 'cart';
    private $o = 'orders';
    
    public function authLogin($data){
        $d = ['email' => $data['authid'], 'password' => $data['password']];

        $this->db->where($data);
        $this->db->join('client_info','client_info.info_id = users.info_id');
        $a = $this->db->get('users');

        if($a->num_rows() === 1){
            $row = $a->row();


            if(isset($row)){

                $this->db->set('status', 1);
                $this->db->where('info_id', $row->info_id);
                $this->db->update('client_info');

                $data = ['id' => $row->user_id, 'name' => $row->company_name, 'authid' => $row->email, 'level' => $row->level];

                $log = $row->company_name.' logged in';
                //Logs
                $this->initLog($log);
                return $data;

            }
        }else{
            $admin_data = ['admin_auth' => $data['authid'], 'admin_pwd' => $data['password']];
            $this->db->where($admin_data);
            $admin = $this->db->get('admin');

            if($admin->num_rows() == 1){
                //Logs
                $log = 'Administrator logged in';
                $this->initLog($log);
                return $data = ['name' => 'Administrator' , 'level' => 'admin', 'auth_id' => '1'];
                
            }else{
                $this->db->where($d);
                $this->db->join('client_info','client_info.info_id = users.info_id');
                $a = $this->db->get('users');

                if($a->num_rows() === 1){
                    $row = $a->row();


                    if(isset($row)){
        
                        $this->db->set('status', 1);
                        $this->db->where('info_id', $row->info_id);
                        $this->db->update('client_info');
        
                        $data = ['id' => $row->user_id, 'name' => $row->company_name, 'authid' => $row->email, 'level' => $row->level];
                        //Logs
                        $log = $row->company_name.' logged in';
                        $this->initLog($log);

                        return $data;
                    }               
                }else{
                    return false;
                }
            }
        }
    }

    public function authIdEmail($data){
        $this->db->where($data);
        $this->db->or_where('authid');
        $this->db->join('client_info', 'client_info.info_id = users.info_id');
        $q = $this->db->get('users');

        if($q->num_rows() > 0){
            $row = $q->row();

            if(isset($row)){
                $ndata = ['email' => $row->email, 'company_name' => $row->company_name, 'authid' => $row->authid];
                return $ndata;
            }
        }

        
        return false;
    }

    public function changePassword($data){
        $this->db->where('authid', $data['authid']);
        $this->db->update('users', ['password' => $data['password']]);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    //SETTING QUERY FOR SERVER-SIDE DATATABLES
    private function make_query($db, $lvl= '', $id = ''){
        if(isset($_POST["search"]["value"])){  
            if($lvl == 'user'){
                if($db == 'cart_products'){
                    $table = 'cart_products';
                    $this->db->where('authid', $id);
                    $this->db->join('cart', 'cart.cart_id = cart_products.cart_id');
                    $this->db->join('users', 'users.user_id = cart.user_id');
                    $this->db->like('cart_po_num', $_POST["search"]["value"]);  
                }else{
                    $table = 'order'; 
                    // $this->db->order_by('del_status', 'DESC'); 
                    // $this->db->order_by('date_needed', 'ASC');
                    // $this->db->like('po_num', $_POST["search"]["value"]);

                    $this->db->join('users', 'orders.user_id = users.user_id');
                    $this->db->join('client_info', 'users.info_id = client_info.info_id');
                    $this->db->join('del_status', 'del_status_id = orders.del_status');

                    if(!empty($id['filter'])){
                        $this->db->where(["DATE_FORMAT(date_needed,'%Y-%m')" => $id['filter'], 'users.user_id' => $id['id']] );
                    }else{
                        $this->db->where('users.user_id', $id['id']);
                    }
                    $this->db->order_by('del_status ASC, date_needed ASC');
                    $this->db->like('po_num', $_POST["search"]["value"]);
                      
                }
            }elseif($lvl == 'admin'){
                if($db == 'client_info'){
                    $table = 'company_name';
                    $this->db->select('users.info_id, client_info.info_id, authid, email, company_name, address, status, img, details');
                    $this->db->join('users', 'users.info_id = client_info.info_id');
                    $this->db->order_by('date_created', 'DESC');
                    $this->db->like($table, $_POST["search"]["value"]);
                    
                }elseif($db == 'users'){
                    $table = 'orders';
                    $this->db->where('authid', $id['id']);

                    if(!empty($id['filter_data'])){
                        $this->db->where("DATE_FORMAT(date_needed,'%Y-%m')", $id['filter_data']);  
                    }

                    if(!empty($id['filter_info'])){
                        $this->db->where("po_num", $id['filter_noti']);
                    }

                    
                    $this->db->join('orders', 'users.user_id = orders.user_id');
                    $this->db->join('client_info', 'users.info_id = client_info.info_id');
                    $this->db->join('del_status', 'del_status_id = orders.del_status');
                    $this->db->like('po_num', $_POST["search"]["value"]);

                }else{
                    $table = 'orders ';
                    
                    $this->db->join('users', 'orders.user_id = users.user_id');
                    $this->db->join('client_info', 'users.info_id = client_info.info_id');
                    $this->db->join('del_status', 'del_status_id = orders.del_status');
                    $this->db->order_by('del_status ASC, date_needed ASC');
                    if(!empty($id['filter_data'])){
                        $this->db->where("DATE_FORMAT(date_needed,'%Y-%m')", $id['filter_data']);  
                    }
                    
                    if(!empty($id['filter_info'])){
                        $this->db->where("po_num", $id['filter_info']);
                    }

 
                    if($_POST["search"]["value"] != ''){
                        $this->db->like('po_num', $_POST["search"]["value"]);
                        $this->db->or_like($table, $_POST["search"]["value"]); 
                    }
                } 
            }elseif($db == 'logs'){
                    $this->db->select('*');
            }    
        }   
     
    }

    //CONTRUCTING DATA TABLES
    public function make_datatables($db, $lvl = '', $id = ''){
        $this->make_query($db , $lvl, $id);

        if($this->input->post('length') != -1){  
             $this->db->limit($this->input->post('length'), $this->input->post('start'));  
        }    

        $query = $this->db->get($db);  
        return $query->result();                       
    }

    //GETTING FILTERED DATA TO DATATABLES
    public function get_filtered_data($db){  
        $this->make_query($db);
        $query = $this->db->get($db);  
        return $query->num_rows();  
   }  

   //COUNTING ALL DATA FROM DATABASE TO DATATABLE
   public function get_all_data($db){  
        $this->db->get($db);
        return $this->db->count_all_results();  
   }     

   //UPDATING DELIVERY STATUS
   public function updateDelStatus($data){
        
        $this->db->select('del_status, order_id , po_num ,user_id');
        $this->db->where('order_id', $data['order_id']); 
        $q = $this->db->get('orders');
        $row = $q->row();

        //THIS IF/ELSE DONT ACCEPT DELIVERY STATUS VALUE THAT ARE LOWER THAN ORIGINAL 
        //TO PREVENT SENDING OF LOWER DELIVERY STATUS VALUE
        if(isset($row)){
            if($row->del_status > $data['del_status']){
                return false;
            }else{
                $this->db->where('order_id', $data['order_id']);
                $this->db->update('orders', ['del_status' => $data['del_status']]);

                //Logs
                $log = '';
                if($data['del_status'] == 2){
                    $log = 'PO Number '.$row->po_num.' was updated to for Shipping';
                    
                }elseif($data['del_status'] == 3){
                    $log = 'PO Number '.$row->po_num.' was updated to on Transit';

                }elseif($data['del_status'] == 4){
                    $log = 'PO Number '.$row->po_num.' was updated to on Delivered';
                }

                $this->initLog($log);
                
                //return ($this->db->affected_rows() == 1 ? true : false);
                $notidata = ['noti_del_status' => $data['del_status'], 'noti_user_uid' => $row->user_id, 'nu_po_num' => $row->po_num];
                $this->db->insert('notification_user' , $notidata);

                if($this->db->affected_rows() > 0){ 
                    return true;
                }else{
                    return false;
                }
            }
        }
    
   }
############# ADMIN ###################

   public function showAdminOrder($draw, $lvl,$fd){
        $fd = $this->make_datatables('orders', $lvl, $fd);
 
        $data = [];
        $po_num = [];
        

        
        //GET ALL PO NUMBEr
        foreach($fd as $row){
            $sub_array = [];
            

            $query = $this->db->get('products');
           
            $nd = date_create($row->date_needed);
            $ds = date_create($row->date_si);
            $df2 = '';
            $company = ['comp_id' => $row->authid, 'comp_name' => $row->company_name];
            //$order  = ['order_id' => $row->products_id, 'order_name' => $row->order];
            $delivery = ['del_status_id' => $row->del_status , 'del_status_name' => 
            
            $row->del_status_name];
            if($row->date_si ==  '0000-00-00'){
                $df2 = '';
            }else{
                $df2 = date_format($ds, 'F d, Y');
            }
            
            $sub_array[] = $row->po_num; 
            $sub_array[] = $company;
            $sub_array[] = '';
            $sub_array[] = $row->order_id;
            //$sub_array[] = $row->qty * $row->u_amount;
            $sub_array[] = $delivery;
            $sub_array[] = $df2;
            $sub_array[] = $row->si_num;
            //$sub_array[] = $row->act_pri;
            $sub_array[] = date_format($nd, 'F d, Y');
            
            $sum = [];
            $first_array = [];
            foreach($query->result() as $r){
                if($row->order_id == $r->order_id){
                    $order_array = [];
                    $order_array[] = $r->order;
                    $order_array[] = $r->qty;
                    $order_array[] = $r->u_amount;
                    $order_array[] = $r->act_pri; 
                    $order_array[] = $r->products_id;
                    $order_array[] = $r->item_status;
                    $sum[] = $r->qty * $r->u_amount;
                    $first_array[] = $order_array;
                    
                }
             
            }
            $sub_array[] = $first_array;
            $sub_array[] = array_sum($sum);
            $sub_array[] = $row->tracking_no;
            $sub_array[] = $row->remarks;
            $sub_array[] = $row->dby;
            $data[] = $sub_array; 
        } 


        $output = array(  
            "draw"  => intval($draw),  
            "recordsTotal" =>  $this->get_all_data($this->o),  
            "recordsFiltered" => $this->get_filtered_data($this->o),  
            "data"   =>  $data  
       ); 

       return $output;    
   }

    public function genIdModel($num){
        // $q = $this->db->query("SELECT FLOOR(1000000+(RAND() * 89999999)) as rdnum from users where 'rdnum' not in (SELECT authid from users UNION SELECT admin_auth from admin ) limit 1");
        
        // $row = $q->row();

        // if(isset($row)){
        //     return $row->rdnum;
        // }

        $this->db->where('authid' , $num);
        $x = $this->db->get('users');

        if($x->num_rows() > 0){
            return false;
        }else{
            $this->db->where('admin_auth', $num);
            $y = $this->db->get('admin');

            if($x->num_rows() > 0){
                return false;
            }else{
                return true;
            }
        }

    }

    public function adminClientModel($draw, $lvl){
        $fetch_data = $this->make_datatables('client_info', $lvl);
        $data = [];

        foreach($fetch_data as $row){
            $sub_array = [];
            $status = ($row->status == 1 ? 'Activated': 'Pending');
            $idName = ['comp_id' => $row->authid, 'comp_name' => $row->company_name];
            
            $sub_array[] = $idName;
            $sub_array[] = $row->authid;
            $sub_array[] = $row->address;
            $sub_array[] = $row->email;
            $data[] = $sub_array; 
        }

        $output = array(  
            "draw"  => intval($draw),  
            "recordsTotal" =>  $this->get_all_data('client_info'),  
            "recordsFiltered" => $this->get_filtered_data('client_info'),  
            "data"   =>  $data  
       ); 

       return $output;
    }

    public function insertAdminInfos($data_a, $data_b){
        $this->db->where('email', $data_b['email']);
        $q = $this->db->get('users');

        if($q->num_rows() == 0){
            $query = $this->db->insert('client_info', $data_a);
            $last_id = $this->db->insert_id();
    
            if(isset($last_id)){
                $data_b['info_id'] = $last_id;
                $query_b = $this->db->insert('users', $data_b);

                //Logs
                $log = 'ID: '.$data_b['authid'].'was created for '.$data_a['company_name'];
                $this->initLog($log);
                return ($query_b ? true : false);
            }
        }else{
            return 2;
        }
        
    }

    public function showProfileData($data){
        $this->db->select('users.user_id, client_info.info_id, authid, date_created, company_name, address, img, details, status');
        $this->db->where('authid', $data);
        $this->db->join('client_info', 'users.info_id = client_info.info_id');
        
        $row = $this->db->get('users')->row();

        if(isset($row)){
            return $row;
        }

        return false;
    }

    public function profOrdDataModel($draw, $lvl, $authid){
        
        $fd = $this->make_datatables('users', $lvl, $authid);   
    //     $data = [];

    //     foreach($fetch_data as $row){
    //         $sub_array = [];
    //         $delivery = ['del_status_id' => $row->del_status , 'del_status_name' => $row->del_status_name];

    //         $sub_array[] = $row->po_num;
    //         $sub_array[] = $row->order;
    //         $sub_array[] = $row->qty;
    //         $sub_array[] = $row->u_amount;
    //         $sub_array[] = $row->qty * $row->u_amount;
    //         $sub_array[] = $row->date_needed;
    //         $sub_array[] = $delivery;

    //         $data[] = $sub_array; 
    //     }

    //     $output = array(  
    //         "draw"  => intval($draw),  
    //         "recordsTotal" =>  $this->get_all_data('orders'),  
    //         "recordsFiltered" => $this->get_filtered_data('orders'),  
    //         "data"   =>  $data  
    //    ); 

    //    return $output;

        $data = [];
        $po_num = [];
        
        //GET ALL PO NUMBEr
        foreach($fd as $row){
            $sub_array = [];
            

            $query = $this->db->get('products');
           
            $nd = date_create($row->date_needed);
            $ds = date_create($row->date_si);
            $df2 = '';
            $company = ['comp_id' => $row->authid, 'comp_name' => $row->company_name];
            //$order  = ['order_id' => $row->products_id, 'order_name' => $row->order];
            $delivery = ['del_status_id' => $row->del_status , 'del_status_name' => 
            
            $row->del_status_name];
            if($row->date_si ==  '0000-00-00'){
                $df2 = '';
            }else{
                $df2 = date_format($ds, 'F d, Y');
            }
            
            $sub_array[] = $row->po_num; 
            $sub_array[] = $company;
            $sub_array[] = '';
            $sub_array[] = $row->order_id;
            //$sub_array[] = $row->qty * $row->u_amount;
            $sub_array[] = $delivery;
            $sub_array[] = $df2;
            $sub_array[] = $row->si_num;
            //$sub_array[] = $row->act_pri;
            $sub_array[] = date_format($nd, 'F d, Y');
            
            $sum = [];
            $first_array = [];
            foreach($query->result() as $r){
                if($row->order_id == $r->order_id){
                    $order_array = [];
                    $order_array[] = $r->order;
                    $order_array[] = $r->qty;
                    $order_array[] = $r->u_amount;
                    $order_array[] = $r->act_pri; 
                    $order_array[] = $r->products_id;
                    $order_array[] = $r->item_status;
                    $sum[] = $r->qty * $r->u_amount;
                    $first_array[] = $order_array;
                    
                }
            
            }
            $sub_array[] = $first_array;
            $sub_array[] = array_sum($sum);
            $sub_array[] = $row->tracking_no;
            $sub_array[] = $row->remarks;
            $sub_array[] = $row->dby;
            $data[] = $sub_array; 
        } 


        $output = array(  
            "draw"  => intval($draw),  
            "recordsTotal" =>  $this->get_all_data($this->o),  
            "recordsFiltered" => $this->get_filtered_data($this->o),  
            "data"   =>  $data  
       ); 

       return $output;    

    }
    //SHOWING ALL REPORTS
    public function reportsModel($sd, $company = ''){
        $i_month = date('Y-m', strtotime($sd));

        $a = ['del_status' => 4];
        $data1 = []; //QUANTITY ARRAY
        $data2 = []; //UNIT AMOUNT ARRAY
        $data3 = []; //ACTUAL PRICE ARRAY
        $data4 = []; //DATE NEEDED ARRAY
        $product = []; //PRODUCT ARRAY
        $gross = [];
        $expense = [];
        $net = [];
        $dateGross = []; //GROSS OF EACH DATE OF THE MONTH
        $sumDateGross = []; //SUM OF GROSS EACH DAY
        $eachAmount = [];
        $eachQty = [];
        $eachUAmount = [];
        $eachActPri = [];

        
        //$ud[] = array_unique($data4); //GETTING THE DATE OF UNIQUE DATE 
        //GETTING QUANTITY AND DELIVERY STATUS
        $this->db->select('*');
        $this->db->where($a);
        
        if(!empty($company)){
            $this->db->where(['client_info.info_id' => $company]);
        }

        $this->db->join('products', 'products.order_id = orders.order_id');
        $this->db->join('users', 'users.user_id = orders.user_id');
        $this->db->join('client_info', 'client_info.info_id = users.info_id ');
        $q1 = $this->db->get('orders'); 
 
/******************** THIS SECTION IS FOR REFACTORING OF CODE *********************/

        //GETTING UNIT AMOUNT AND DELIVERY STATUS
        // $this->db->where($a);
        // $this->db->select('u_amount, del_status');
        // $q2 = $this->db->get('orders');
        
        
        //ADDING QUANTITY TO ARRAY
        foreach($q1->result() as $row){
            $data1[] = $row->qty;
            $data2[] = $row->u_amount;
            $data3[] = $row->act_pri;
            $data4[] = $row->date_needed;
        }
        
        //ADDING UNIT AMOUNT TO ARRAY
        // foreach($q2->result() as $row){
        //     $data2[] = $row->u_amount;
        // } 

        //COUNTING THE LENGTH OF DATA 1 AS THE END OF ITERATION
        $len = count($data1);
        
        
        //LOOPING THE DATA OF QUANTITY AND UNIT AMOUNT ARRAY AND MULTIPLY TO GET ITS PRODUCT AND ADD IT TO PRODUCT ARRAY
        for($x = 0 ; $x < $len ; $x++){
            $month = date('Y-m', strtotime($data4[$x]));

            if($data3[$x] != 0 && $i_month == $month ){
                $gross[] =  ($data1[$x] * $data2[$x]) - $data3[$x] ;  
                $net[] = $data1[$x] * $data2[$x]; 
                $expense[] = $data3[$x];
            }
            //$product [] = ($data3)($data1[$x] * $data2[$x]);
        }

        //GET SUM OF DATA OF EACH DATE
        $rep = ['del_status' => 4, 'MONTH(date_needed)'=> date('m', strtotime($sd)), 'act_pri !=' => 0];
        $this->db->where($rep);

        if(!empty($company)){
            $this->db->where(['client_info.info_id' => $company]);
        }

        $this->db->order_by('date_needed', 'ASC');
        $this->db->select('qty, del_status, u_amount, act_pri, date_needed');
        $this->db->join('products', 'products.order_id = orders.order_id');
        $this->db->join('users', 'users.user_id = orders.user_id');
        $this->db->join('client_info', 'client_info.info_id = users.info_id ');
        $q6 = $this->db->get('orders'); 

        $eachDate= [];
        foreach($q6->result() as $row){
            $eachDate[] = $row->date_needed;
            $eachQty[] = $row->qty;
            $eachUAmount[] = $row->u_amount;
            $eachActPri[] = $row->act_pri;
        }

        $ud = array_values(array_unique($eachDate));
        $dnlen = count(array_unique($eachDate));
        $dlen = count($eachDate);   
        
        if(!empty($eachDate)){

            for($x = 0 ; $x < $dnlen ; $x++){
                for($y = 0 ; $y < $dlen; $y++){
                    if($ud[$x] == $eachDate[$y]){
                        $dateGross[$x][] = ($eachQty[$y] * $eachUAmount[$y]) - $eachActPri[$y];
                    }
                }
                $sumDateGross[$x] = array_sum($dateGross[$x]); 
            }
        }

        // $dnlen = count(array_unique($data4)); 
        // $dlen = count($data4);   
        // $ud = array_values(array_unique($data4)); //UNIQUE DATE OF THE MONTH

        // if(!empty($net)){
        //     for($x=0 ; $x < $dnlen ; $x++){
        //         $mod = date('d', strtotime($ud[$x]));
    
        //         for($y=0 ; $y < $dlen; $y++){
        //             $month = date('Y-m', strtotime($data4[$y]));
                    
        //             if($i_month == $month ){
        //                 $exdate = date('d', strtotime($data4[$y]));
                        
        //                 if($mod == $exdate){
                            
        //                     $dateGross[$x][] = ($data1[$y] * $data2[$y]) - $data3[$y];
        //                 }

                        
        //             }
        //         }
        //         //$sumDateGross[$x] = array_sum($dateGross[$x]); 
        //     }
        // }
        // var_dump($ud);
        //SETTING  EVERY DATA TO ARRAY 
        $product['net'] = array_sum($net);
        $product['total'] = array_sum($gross);
        $product['expense'] = array_sum($expense);
        $product['eachdate'] = $sumDateGross;
        $product['dateGross'] = $ud;
/************************ END SECTION ************************/
        return $product;
    }
    
    public function getMonthlyReport($sd, $company = ''){
        $this->db->join('products', 'products.order_id = orders.order_id');
        $this->db->join('users', 'users.user_id = orders.user_id');
        $this->db->join('client_info', 'client_info.info_id = users.info_id ');

        $this->db->where(['act_pri !=' => 0, 'del_status' => 4]);

        if(!empty($company)){
            $this->db->where(['client_info.info_id' => $company]);
        }

        $q1 = $this->db->get('orders'); 
        $mdataDb = [];
        $mactdb = [];
        $sumMonth = [];
        $sumActPri = [];
        $getAll = [];
        $m = date('m');
        for($x= 1; $x<=$m; $x++){
            //GETTING THE NAME OF EVERY MONTH
            $month = date('m', mktime(0,0,0, $x, 1));

            foreach($q1->result() as $row){
                $d = strtotime($row->date_needed);
                $m = date('m',$d);

                if($month == $m){
                    $mdataDb[$x][] = ($row->qty * $row->u_amount) - $row->act_pri;
                    $mactdb[$x][] = $row->act_pri;
                }else{
                    $mdataDb[$x][] = 0;
                    $mactdb[$x][] = 0;
                }
            }
        }

        foreach($mdataDb as $key=>$row){
            $sumMonth[] = array_sum($mdataDb[$key]);
            $sumActPri[] = array_sum($mactdb[$key]);
        }

        $getAll['monthly'] = $sumMonth;
        $getAll['monactpri'] = $sumActPri;
        return $getAll;
    }

    public function getYearlyReport($sd, $company = ''){ 
        $this->db->join('products', 'products.order_id = orders.order_id');
        $this->db->join('users', 'users.user_id = orders.user_id');
        $this->db->join('client_info', 'client_info.info_id = users.info_id ');
        $this->db->where(['act_pri !=' => 0, 'del_status' => 4]);

        if(!empty($company)){
            $this->db->where(['client_info.info_id' => $company]);
        }

        $q1 = $this->db->get('orders'); 
        
        $y = date('Y');
        $year = []; //get all the year 10 years from now
        $yd = [];
        $sy = [];
        $getYear = [];

        for($x = 0; $x < 10 ; $x++){
            
            $year[] = [date('Y', strtotime('+'.$x.' years'))];
            $sumYear = date('Y', strtotime('+'.$x.' years'));

            foreach($q1->result() as $row){
                if((date('Y',strtotime($row->date_needed)) == $sumYear) && ($row->del_status == 4)){
                    $yd[$x][] = ($row->qty * $row->u_amount) - $row->act_pri;
                }else{
                    $yd[$x][] = 0;
                }
            }
        }

        foreach($yd as $key=>$row){
            $sy[] = [array_sum($yd[$key])];
        }

        $getYear['yearly'] = $sy;
        $getYear['label'] = $year;
        return $getYear;
    }
    //SHOW EDITED PRODUCTS 
    public function showEditProduct($id){
        $this->db->join('del_status', 'del_status_id = orders.del_status');
        $this->db->where(['order_id' => $id]);
        $q = $this->db->get('orders');
        
        $row = $q->row();
        $sub_array = [];

        if(isset($row)){
            $sub_array['order_id'] = $row->order_id;
            $sub_array['tracking'] = $row->tracking_no;
            $sub_array['user_id'] = $row->user_id;
            $sub_array['po_num'] = $row->po_num;
            $sub_array['date_si'] = $row->date_si;
            $sub_array['si_num'] = $row->si_num;
            $sub_array['remarks'] = $row->remarks;
            $sub_array['dby'] = $row->dby;
            $sub_array['del_status'] = $row->del_status_name;
            $sub_array['date_needed'] = $row->date_needed;

            $this->db->where('order_id', $id);
            $q1 = $this->db->get('products');

            $sum = [];
            $product = [];
            foreach($q1->result() as $r){
                $pd = [];
                $pd['products_id'] = $r->products_id;
                $pd['order'] = $r->order;
                $pd['qty'] = $r->qty;
                $pd['u_amount'] = $r->u_amount;
                $pd['act_pri'] = $r->act_pri;
                $sum[] = $r->qty * $r->u_amount;
                $product[] = $pd;
            }
            $sub_array['products'] = $product;
            $sub_array['sum'] = array_sum($sum);
        }

        return $sub_array;
    }

    //UPDATING PRODUCT INFORMATION
    public function updateProdInfo($sec_user, $oi, $data){
        $this->db->where($sec_user);
        $q = $this->db->get('admin');

        if($q->num_rows() == 1){
            $this->db->where(['order_id' => $oi]); 
            $this->db->update('orders', $data);

            //Logs
            $this->db->where(['order_id' => $oi]);
            $query = $this->db->get('orders');
            $row = $query->row();

            if(isset($row)){
                $log = 'Date SI and SI Number was updated with PO Number '.$row->po_num;
                $this->initLog($log);
            } 
              
            return ($this->db->affected_rows() > 0 ? true : 3);

        }else{
            return false;
        }

        
    }

    public function initAdminNoty(){
        //UNSEEN NOTIFICATION
        $this->db->join('users', 'notification.noti_user_id = users.user_id');
        $this->db->join('client_info', 'users.info_id = client_info.info_id');
        $this->db->order_by('noti_date_created', 'DESC');
        $q = $this->db->get('notification');
        $data = []; 

        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $timestamp = strtotime($row->noti_date_created) + 46800;
                $unseen_arr['nstatus'] = $row->noty_status;
                $unseen_arr['company_name'] = $row->company_name;
                $unseen_arr['po_num'] = $row->noti_po_num;
                $unseen_arr['date_created'] = date('Y-m-d H:i:s', $timestamp);

                $data['data'][] = $unseen_arr;
            }

        }else{
            return false;
        }
       return $data;
    }
    
    public function deleteOrder($data){
        $this->db->where('admin_pwd', $data['opwd']);
        $q = $this->db->get('admin');

        if($q->num_rows() == 1){
            //Logs
            $this->db->where(['order_id' => $data['oid']]);
            $query = $this->db->get('orders');
            $row = $query->row();

            if(isset($row)){
                $log = 'PO Number '.$row->po_num.' was deleted';
                $this->initLog($log);
            }
 
            $del = $this->db->delete('orders', ['order_id' => $data['oid']]);

            if($del){
                
                $this->db->where('order_id', $data['oid']);
                $delproduct = $this->db->delete('products');

                return true;
            }else{
                return false;
            }   
        }else{
            return false;
        } 

    }

    public function editItemStat($data){
        $this->db->where($data);
        $this->db->update('products', ['item_status' => 1]);

        if($this->db->affected_rows() > 0){
            return true;
        }

        return false;
    }

    //Edit Actual Price
    public function editPrice($data){
        $this->db->where('products_id', $data['products_id']);
        $this->db->update('products', ['act_pri' => $data['act_pri']]);

        //Logs
        $this->db->where('products_id', $data['products_id']);
        $this->db->join('orders', 'orders.order_id = products.order_id');
        $q = $this->db->get('products');
        $row = $q->row();

        if(isset($row)){
            $log= 'Actual Price of '.$row->order.' with PO Number '.$row->po_num.' was changed to '.$data['act_pri'];
            $this->initLog($log);
        }
        
        if($this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function getAllCompany(){
        $this->db->select('company_name, info_id');
        $init = $this->db->get('client_info');
        
        $data = []; 
        foreach($init->result() as $row){
            $data['id'][] = $row->info_id;
            $data['name'][] = $row->company_name;
        }

        return $data;
    }
############## USER ####################
    //Getting PO Number
    public function getPO($data){
        $this->db->where('authid',$data);
        $this->db->join('users', 'users.user_id = cart.user_id');
        $init = $this->db->get('cart');

        if($init->num_rows() > 0){
            $row = $init->row();
            
            if(isset($row)){
                return $row->cart_po_num;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    //ADDING DATA TO CART
    public function addCart($data){
        //Checking user id in cart
        $this->db->where('cart_po_num', $data['cart_id']['user_id']);
        $init = $this->db->get('cart');

        if($init->num_rows() > 0){
            $this->db->where('cart_po_num', $data['cart_id']['user_id']);
            $initUpt = $this->db->update('cart', $data['cart']);
            $row = $init->row();

            if(isset($row)){
                //Inserting data to cart products if it passes all the validation
                $data = ['cart_id' => $row->cart_id, 'cart_order' => $data['product']['cart_order'], 'cart_quantity' => $data['product']['cart_quantity'], 'cart_amount' => $data['product']['cart_amount'], ];
                $this->db->insert('cart_products', $data);

                if($this->db->affected_rows() > 0){
                    return true;
                }
            }
  
        }
    }

    public function genpo($data){
        $mainData = [];
        $this->db->where('cart_po_num', $data['cart_po_num']);
        $qcheck = $this->db->get('cart');
        //Validating po number to cart
        if($qcheck->num_rows() == 0){ 
            $this->db->where('po_num', $data['cart_po_num']);
            $qcheck1 = $this->db->get('orders');  

            //Validating po number to orders
            if($qcheck1->num_rows() == 0){
                $this->db->where(['authid' => $data['user_id']]);
                $qcheck2 = $this->db->get('users');

                if($qcheck2->num_rows() > 0){
                    $usrRow = $qcheck2->row();

                    if(isset($usrRow)){
                        $initE = $this->db->insert('cart', ['cart_po_num' => $data['cart_po_num'], 'user_id' => $usrRow->user_id]);
        
                        if($this->db->affected_rows() > 0){
                             return $data['cart_po_num'];
                        }else{
                            return false;
                        }
                    }
                }
            }else{
                return $mainData['err'] = 'dup_po_main';
            }
        }else{
            return $mainData['err'] = 'dup_po';
        }

    }
    //DELETING DATA FROM CART
    public function delCartItem($id){
        $this->db->where('cart_products_id', $id);
        $q = $this->db->delete('cart_products');

        if($q){
            return true;
        }
        return false;
    }

   //SETTING UP SERVER-SIDE CART DATATABLE
   public function showCart($draw, $lvl, $id){
       
       $fetch_data = $this->make_datatables('cart_products', $lvl, $id);
        $data = [];

        foreach($fetch_data as $row){
            $sub_array = [];
            //$need_date = date_create($row->need_date);
            $sub_array[] = $row->cart_order;
            $sub_array[] = $row->cart_quantity;
            $sub_array[] = $row->cart_amount;
            $sub_array[] = $row->cart_amount * $row->cart_quantity;
            //$sub_array[] = date_format($need_date, 'F m, Y');
            $sub_array[] = $row->need_date;
            $sub_array[] = $row->cart_products_id;
            $data[] = $sub_array; 
        }

        $output = array(  
            "draw"  => intval($draw),  
            "recordsTotal" =>  $this->get_all_data($this->c),  
            "recordsFiltered" => $this->get_filtered_data($this->c),  
            "data"   =>  $data  
       ); 
       return $output;
   }

   //SETTING UP SERVER-SIDE USER ORDER FROM DATABASE 
   public function showUserOrder($draw, $lvl, $id){
        $fetch_data = $this->make_datatables($this->o , $lvl, $id);
        $data = [];

        foreach($fetch_data as $row){
            $sub_array = [];

            $query = $this->db->get('products');

            //$need_date = date_create($row->date_needed);
            $delivery = ['del_status_id' => $row->del_status , 'del_status_name' => $row->del_status_name];
            $sub_array[] = $row->po_num;
            $sub_array[] = $row->date_needed;
            $sub_array[] = $delivery;

            $sum = [];
            $first_array = [];
            foreach($query->result() as $r){
                if($row->order_id == $r->order_id){
                    $order_array = [];
                    $order_array[] = $r->order;
                    $order_array[] = $r->qty;
                    $order_array[] = $r->u_amount;
                    $sum[] = $r->qty * $r->u_amount;
                    $first_array[] = $order_array;
                    
                }
            
            }

            $sub_array[] = $first_array;
            $sub_array[] = array_sum($sum);            
            $data[] = $sub_array; 
        } 

        $output = array(  
            "draw"  => intval($draw),  
            "recordsTotal" =>  $this->get_all_data($this->o),  
            "recordsFiltered" => $this->get_filtered_data($this->o),  
            "data"   =>  $data  
       ); 

       return $output;               
   }

   private function generateTracking(){
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $randomNumber = mt_rand(10000,99999);
        $n = 4;

        for($i = 0; $i < $n; $i++){
            $index  = rand(0, strlen($char) - 1);
            $randomString .= $char[$index];
        }

        $tracking = $randomString.''.$randomNumber;

        $this->db->where('tracking_no', $tracking);
        $q = $this->db->get('orders');

        if($q->num_rows() == 0){
            return $tracking;
        }else{
            return false;
        }
   }

   //BUY NOW FUNCTION 
   public function insertBuy($ponum){
    //Checking PO Number
    $this->db->where('cart_po_num', $ponum);
    $init = $this->db->get('cart');

    if($init->num_rows() > 0){
        $row = $init->row();

        if(isset($row)){
            //Inserting data to orders
            $tracking = '';

            if($this->generateTracking() != false){
                $tracking = $this->generateTracking();
            }
            
            $order = ['tracking_no' => $tracking, 'user_id' => $row->user_id, 'po_num' => $row->cart_po_num,'date_needed' => $row->need_date];
            $this->db->insert('orders', $order);

            if($this->db->affected_rows() > 0){
                //Getting the ID of last inserted PO Number
                
                $this->db->where('po_num', $row->cart_po_num);
                $q1 = $this->db->get('orders');

                if($q1->num_rows() > 0){
                    $row1 = $q1->row();

                    if(isset($row1)){
                        //Checking cart id if it exist in cart products table
                        $this->db->where('cart_id', $row->cart_id);
                        $q2 = $this->db->get('cart_products');
                        
                        //Inserting all the data if cart id exist
                        foreach($q2->result() as $r){
                            $products = ['order_id' => $row1->order_id, 'order' => $r->cart_order, 'qty' => $r->cart_quantity, 'u_amount' => $r->cart_amount];
                            $this->db->insert('products', $products);

                        }
                        //Delete data to cart
                        $this->db->where('user_id', $row->user_id);
                        $this->db->delete('cart');

                        //Delete data to cart products
                        $this->db->where('cart_id', $row->cart_id);
                        $this->db->delete('cart_products');                
                        
                        return true;
                    }
                }
            }
        }
    }else{
        return false;
    }
}
    private function addToNoti($data){
        $this->db->insert('notification', $data);

        if($this->db->affected_rows() > 0){
            return true;
        }

        return false;
    }
   //CHANGE PASSWORD SECTION
   public function updatePwd($data){
       //validate old password
       $old = ['user_id'=> $data['id'], 'password' => $data['old']];
       $this->db->where($old);
       $sql_old = $this->db->get('users');

       if($sql_old->num_rows() == 1){

           if($data['new'] == $data['conf']){
                $this->db->where('user_id', $data['id']);
                $this->db->update('users', ['password' =>$data['conf']]);

                return $this->db->affected_rows() == 1 ? 'success' : '3';
           }else{
                return 'err_conf';
           }    

       }else{
            return 'err_old';
       }     
   }

   //User notification
   public function initUserNoti($id){
        //UNSEEN NOTIFICATION
        //$this->db->select('notification_user.nui, notification.noti_id, notification.noty_status, notification.noti_po_num, users.user_id, client_info.info_id, authid, level, company_name, address, img, details, status');
        $this->db->where('noti_user_uid', $id);
        $this->db->order_by('nu_date_created', 'DESC');
        $q = $this->db->get('notification_user');
        $data = []; 

        if($q->num_rows() > 0){
            foreach($q->result() as $row){
                $timestamp = strtotime($row->nu_date_created)+ 46800;

                $unseen_arr['nuid'] = $row->nuid;
                $unseen_arr['del_status'] = $row->noti_del_status;
                $unseen_arr['date_created'] = date('Y-m-d H:i:s',$timestamp) ;
                $unseen_arr['nu_po_num'] = $row->nu_po_num;

                $data['data'][] = $unseen_arr;
            }

        }else{
            return false;
        }

        return $data;
    }

    private function initLog($content){
        $this->db->insert('logs', ['log_content' => $content]);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function showLogs($draw){
        $fetch_data = $this->make_datatables('logs');
        $arr = [];

        foreach($fetch_data as $row){
            $sub_arr = [];
            
            $sub_arr[] = $row->log_id;
            $sub_arr[] = $row->log_content;
            $sub_arr[] = $row->log_date_created;

            $arr[] = $sub_arr;
        }

        $output = array(  
            "draw"  => intval($draw),  
            "recordsTotal" =>  $this->get_all_data('logs'),  
            "recordsFiltered" => $this->get_filtered_data('logs'),  
            "data"   =>  $arr  
       ); 

       return $output;  
    }
}