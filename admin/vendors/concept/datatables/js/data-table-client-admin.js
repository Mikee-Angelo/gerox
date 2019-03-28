$('#create_profile').on('click', function(){
    $.ajax({
        method: 'POST',
        url: 'http://admin.gerox.x10host.com/genid',
        dataType: 'json',
        data: {
            genid: 1
        },
        beforeSend: function(){

        },
        success: function(data){
            if(data !== ''){
                let genId  = data.genid;

                $('#genuser').val(genId);
            }
        }
    });
});

$('#genuser').on('click', function(){
    var cn = $('#compname').val();

    if(cn.length == 0){
        $('#compname').addClass('is-invalid');

    }
});

$('#createProfile').on('hidden.bs.modal', function(){
    $('#compname').removeClass('is-invalid');
});

var genUserTbl = $('#adminClientTbl').DataTable({
    "createdRow": function(r ,d ,di){

        if(d[3] == 'Activated'){
            $(r).addClass('table-success');
        }
    },
    "processing": false,
    "serverSide": true,
    "order":[],
    "ajax":{
        method: 'post',
        url: 'http://admin.gerox.x10host.com/showadminclients',
    },
    "scrollCollapse" : true,
    "scrollX" : true ,
    "columnDefs":[
        {
            "targets": 0,
            "data": 0,
            "render": function(data, type, row, meta){
                return '<a href="http://admin.gerox.x10host.com/client-profile/'+data['comp_id']+'" class="text-info">'+data['comp_name']+'</a>';
            }
        },
        {
            "targets": 2,
            "data": 3,
            "render": function(data, type, row, meta){
                return data;       
            }
        },
        {
            "targets": -2,
            "data": 2,
            "render": function(data, type, row, meta){
                return data;       
            } 
        },
        {
            "targets": -1,
            "data": 2,
            "render": function(data, type, row, meta){
                return data;       
            }
        }           
    ]      
});

//GENERATE NEW USERS AND INSERT TO DATABASE
$('#genuser').on('click', function(){
    let genuser= $('#genuser').val();
    let name = $('#compname').val();
    let addr = $('#compaddr').val();
    let email = $('#compemail').val();
    $.ajax({
        method: 'POST',
        url: 'http://admin.gerox.x10host.com/insertadminclients',
        dataType: 'json',
        data: {
            compid : genuser,
            compname : name,
            compaddr : addr,
            compemail: email
        },
        beforeSend: function(){

        },
        success: function(data){
            if(data == true){
                genUserTbl.ajax.reload();
                $('#scg').removeClass('d-none');
                $('#genUserForm')[0].reset();
                $('#createProfile').modal('toggle');
            
            }
        }          
    });
});
