$(document).ready(function(){

    // function initNotification(){
    //     $.post('http://admin.gerox.x10host.com/initnoty', function(d){
    //         var init = JSON.parse(d);
    //         $(".list-group").empty().html();
    //         $.each(init.data, function(i,v){
    //             let timeSuffix = moment(v['date_created']).fromNow();
    //             if(v['nstatus'] == 0){
    //                 $('.notification-list .list-group').append('<a href="http://admin.gerox.x10host.com/admin/notif/'+v['po_num']+'" class="notification-info"><div class="notification-list-user-block"><span class="notification-list-user-name">'+v['company_name']+'</span>ordered a product with PO Number '+v['po_num']+'<div class="notification-date">'+timeSuffix+'</div></div></a>');
    //             }else{
    //                 $('.notification-list .list-group').append('<a href="http://admin.gerox.x10host.com/admin/notif/'+v['po_num']+'" class="notification-info"><div class="notification-list-user-block"><span class="notification-list-user-name">'+v['company_name']+'</span>ordered a product with PO Number '+v['po_num']+'<div class="notification-date">'+timeSuffix+'</div></div></a>');              
    //             }
    //         });
    //     });
    // }
    // initNotification();

    // var interval = setInterval(function(){
        
    //     initNotification(); 
    // }, 5000);
    
});