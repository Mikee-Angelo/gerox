$(document).ready(function(){

    function initNotification(){
        $.post('http://admin.gerox.x10host.com/initusernoti', function(d){
            var init = JSON.parse(d);
            $(".list-group").empty().html();
            $.each(init.data, function(i,v){
                let txtstatus = '';
                let timeSuffix = moment(v['date_created']).fromNow();
                
                if(v['del_status'] == 2){
                    txtstatus = '<span class="notification-list-user-name">PO Number '+v['nu_po_num']+'</span>is ready for shipping';
                }else if(v['del_status'] == 3){
                    txtstatus = '<span class="notification-list-user-name">PO Number '+v['nu_po_num']+'</span>is on transit by Gerox Enterprises';
                }else if(v['del_status'] == 4){
                    txtstatus = '<span class="notification-list-user-name">Gerox Enterprises</span>delivered your item with PO Number '+v['nu_po_num']+', Thank you!';
                }

                if(v['nstatus'] == 0){
                    $('.notification-list .list-group').append('<a href="http://admin.gerox.x10host.com/admin/notif/'+v['nu_po_num']+'" class="notification-info"><div class="notification-list-user-block">'+txtstatus+'<div class="notification-date">'+timeSuffix+'</div></div></a>');
                }else{
                    $('.notification-list .list-group').append('<a href="http://admin.gerox.x10host.com/admin/notif/'+v['nu_po_num']+'" class="notification-info"><div class="notification-list-user-block">'+txtstatus+'<div class="notification-date">'+timeSuffix+'</div></div></a>');              
                }
            });
        });
    }
    initNotification();

    var interval = setInterval(function(){
        
        initNotification(); 
    }, 5000);
    
});