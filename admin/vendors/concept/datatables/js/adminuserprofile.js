$(document).ready(function(){
    let rowIds = [];
//CREATING ACCOUNT OF THE USER
function adminFormat(d){

    var trs = '';
    var chk = '';
    $.each(d[8], function(i,v){
        if(v[5] == 1){
            //$('#item-chk').prop('checked', false);
            chk= '<td><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input item-chk" disabled checked="" value="'+v[4]+'"><span class="custom-control-label"></span></label></td>';
        }else{
            //$('#item-chk').prop('checked', true);
            chk= '<td><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input item-chk" value="'+v[4]+'"><span class="custom-control-label"></span></label></td>';
        }
        let product = v[1] * v[2];
        trs +='<tr>'+
        '<td>'+v[0]+'</td>'+
        '<td>'+v[1]+'</td>'+
        '<td>'+v[2]+'</td>'+
        '<td>'+product+'</td>'+
        '<td>'+v[3]+'</td>'+
        chk
        +'</tr>'
    });
    var a = '<div class="table-responsive" padding="10px">'+
    '<table class="table">'+
        '<thead><tr><th scope="col">Item Name</th><th scope="col">Quantity</th><th scope="col">Unit Amount</th><th scope="col">Total Amount</th><th scope="col">Actual Price</th><th scope="col">Status</th></tr>'+
        '</thead>'+
        '<tbody>'+
                trs
        +'</tbody>'+
    '</table>'+
    '</div>'
    ; 

    return a ; 
}
//GENERATING SERVER-SIDE DATATABLES
    var pathArray = window.location.pathname.split('/');

    let profTbl = $('#profileOrderTbl').DataTable({
        "createdRow": function(r ,d ,di){
            let start_date = moment(new Date());
            let end_date= moment(d[7]);
            let diff_date = end_date.diff(start_date, 'days');
            
            if(diff_date >= 0 && diff_date < 3){
                if(d[4]['del_status_id'] == 4){
                    $(r).addClass('table-success');
                }else{
                    $(r).addClass('table-danger'); 
                }
            }else if(diff_date >=3 || diff_date <= -1){
                if(d[4]['del_status_id'] == "1"){
                    $(r).addClass('table-warning');
                    
                }else if(d[4]['del_status_id'] == "2"){
                    $(r).addClass('table-info');
    
                }else if(d[4]['del_status_id'] == "3"){
                    $(r).addClass('table-primary');
    
                }else {
                    $(r).addClass('table-success'); 
                } 
            }
        },
        "rowCallback": function(r, d){
            if(d[5] == ''){
                $('td', r).eq(5).css('background-color', '#FFAB91');
            }
    
            if(d[6] == 0 || d[6] == ''){
                $('td', r).eq(6).css('background-color', '#FFAB91');
            }
    
            $.each(d[8], function(i,v){
                if(v[5] == 0){
                    $('td .btn-status', r).prop('disabled',true);
                }
            });
           },
        "processing": false,     
        "serverSide": true,
        "order": [],
        "ajax":{
            method: 'POST',
            dataType: 'json',
            data: function(data){
                data.authid  = pathArray[2],
                data.filter_data = $('#filter_order').val(),
                data.filter_noti = pathArray[3]           
            },
            url: 'http://admin.gerox.x10host.com/proftbldata'
        },
        rowId: 0,
        "scrollCollapse" : true,
        "scrollX" : true , 
        "columnDefs":[
            {
                "targets": 0,
                "className":'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": '<button class="btn btn-primary btn-xs" style="border-radius:100%" ><i class="fa fa-plus small"></i></button>',
            },
            {
                "targets": 1,
                "data": 0,
                "render": function(data, type, row, meta){
                    return data;
                }
            },
            {
                "targets": 2,
                "data": 10,
                "render": function(data, type, row, meta){
                    return data;   
                }
            },
            {
                "targets": 3,
                "data": 9,
                "render": function(data, type, row, meta){
                    return data;   
                }
            },
            {
                "targets": 4,
                "data" : 4,
                "render": function(data, type, row, meta){
                    return data['del_status_name'];
                }
            },
            
            {
                "targets": 5,
                "data": 5,
                "render": function(data, type, row, meta){
                    return data;   
                }
            },
            {
                "targets": 6,
                "data": 6,
                "render": function(data, type, row, meta){
                    return data;   
                }
            },
            {
                "targets": 7,
                "data": 7,
                "render": function(data, type, row, meta){
                    return data;   
                }
            },
            {
                "targets": 8,
                "data":12,
                "render": function(data, type, row, meta){
                    return data;   
                }
            },
            {
                "targets": -3, 
                "data": 3, 
                "render": function(data, type, row, meta){
                    return '<a href="http://admin.gerox.x10host.com/edit-prof-info/'+data+'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a><button class="btn btn-primary btn-danger btn-xs ml-1 btn-del-order" data-toggle="modal" data-target="#deleteOrder" data-id="'+data+'"><i class="fa fa-trash"></i></button>';
                }
            },
            {
                "targets": -2, 
                "data": 4,
                "render": function(data, type, row, meta){
                    return '<button type="button" class="btn btn-primary btn-xs btn-status" data-toggle="modal" data-target="#delstatus" data-id="'+data['del_status_id']+'">Status</button>';
                }
            }, 
            {
                "targets": -1,
                "data": 11,
                "render": function(data, type, row, meta){
                    return data;   
                }
            },            
        ],       
    });

    //Initiating Child row 
    $('#profileOrderTbl tbody').on('click', 'td.details-control', function(){
        
        var tr = $(this).closest('tr');
        var row = profTbl.row(tr);

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }else{
            if ( profTbl.row( '.shown' ).length ) {
                $('.details-control', profTbl.row( '.shown' ).node()).click();
            }
            row.child( adminFormat(row.data()) ).show();
            tr.addClass('shown');            
        }        

        let currentRowID = "#" + ($(this).closest('tr').attr('id'));
        if ($.inArray(currentRowID, rowIds) !== -1) {
            console.log(rowIds);
            //Row is closed, remove row ID from rowIDs array
            var index = rowIds.indexOf(currentRowID);
            if (index !== -1) rowIds.splice(index, 1);
            rowIds.filter(function (val) {
                return val
            });
        } else {
            //Row is opened, add row ID to rowIDs array
            rowIds.push(currentRowID);
        }

    });

    $('#epwd').on('keyup', function(){
        
        if($(this).val().length >= 8){
            $('#e_btn_sbmt').prop('disabled', false);
        }else{
            $('#e_btn_sbmt').prop('disabled', true);
        }
    }); 

    $(document).on('click', '.item-chk', function(){
        $(this).prop('disabled', true);
        var d = $(this).val();

        // var tr = $(this).closest('tr').parents('tr');
        // var prevtr  =tr.prev('tr')[0];
        // prevtr.addClass('shown');
        $.ajax({
            method: 'post',
            url: 'http://admin.gerox.x10host.com/edititemstat',
            dataType: 'json', 
            data: {
                data : d
            },
            success: function(d){
                if(d){
                    profTbl.ajax.reload(function () {
                        //Iterate through all the open rows and open them again   <--Value is set in the onClickEventListener function
                        profTbl.rows(rowIds).every(function (row, index, array) {
                            profTbl.row(row).child(adminFormat(this.data())).show();
                            this.nodes().to$().addClass('shown');
                        });
                        //Set to false if you don't want the paging to reset after ajax load,otherwise true
                    }, false);    
                }
            }
        })
    });

    //STATUS BUTTON
    $('#profileOrderTbl tbody').on('click', '.btn-status', function(e){
        let x = profTbl.row($(this).parents('tr')).data();
        $('#delstatus').data('ord_id', x[3]);

        switch(x[4]['del_status_id']){
            case '1':
                $('#fd').prop('disabled', false);
            break;

            case '2':
                $('#fd').prop('checked', true);
                $('#ot').prop('disabled', false);
            break;

            case '3':
                $('#fd').prop('checked', true);
                $('#ot').prop('checked', true);
                $('#del').prop('disabled', false);
            break;

            case '4':
                $('#fd').prop('checked', true);
                $('#ot').prop('checked', true);
                $('#del').prop('checked', true);
        }
    });
    
    //GETTING ID OF THE CLICKED STATUS BUTTON
    $('.form-check-input').on('click',function(){
        var data_row = profTbl.row($('tbody .btn-status').closest('tr')).data();
        var ord_id = $('#delstatus').data('ord_id');
        var cb_val = $(this).val();  

        $.ajax({
            url: 'http://admin.gerox.x10host.com/update-del',
            method: 'POST',
            dataType: 'json',
            data: {
                ord_id : ord_id,
                cb_val : cb_val
            },
            success: function(d){
                if(d == true){
                    profTbl.ajax.reload(function () {
                        //Iterate through all the open rows and open them again   <--Value is set in the onClickEventListener function
                        profTbl.rows(rowIds).every(function (row, index, array) {
                            profTbl.row(row).child(adminFormat(this.data())).show();
                            this.nodes().to$().addClass('shown');
                        });
                        //Set to false if you don't want the paging to reset after ajax load,otherwise true
                    }, false);     
                }
            }
        })
    });

    //AUTO PROP CHECKBOX
    $('#fd').on('click', function(){
        $('#fd').prop('disabled', true);
        $('#ot').prop('disabled', false);
    });

    $('#ot').on('click', function(){
        $('#ot').prop('disabled', true);
        $('#del').prop('disabled', false);
    });

    $('#del').on('click', function(){
        $('#del').prop('disabled', true);
    });

    //Fix On Modal
    $('#delstatus').on('hide.bs.modal', function(){
        $('#fd').prop('disabled', true);
        $('#ot').prop('disabled', true);
        $('#del').prop('disabled', true);
        $('#fd').prop('checked', false); 
        $('#ot').prop('checked', false);
        $('#del').prop('checked', false);
    });

    $('#filter_order').on('change', function(){
        profTbl.ajax.reload();
    });

    //Deleting selected data 
    $('#profileOrderTbl tbody').on('click', '.btn-del-order', function(e){
        let x = profTbl.row($(this).parents('tr')).data();
        let ord = x[3];
        $('#deleteOrder').data('del_id', ord);
    });

    $('#authbtn').on('click', function(){
        var delete_id = $('#deleteOrder').data('del_id');
        var order_del = $('#authorder').val();

        if(order_del != ''){
            $.ajax({
                url: 'http://admin.gerox.x10host.com/deleteorder',
                method: 'post',
                dataType: 'json',
                data : {
                    del_id : delete_id,
                    order_pwd : order_del
                },
                beforeSend: function(){

                },
                success: function(d){
                    if(d== true){
                        $('#authorder').val('');
                        $('#deleteOrder').modal('toggle');
                        profTbl.ajax.reload(function () {
                            //Iterate through all the open rows and open them again   <--Value is set in the onClickEventListener function
                            profTbl.rows(rowIds).every(function (row, index, array) {
                                profTbl.row(row).child(adminFormat(this.data())).show();
                                this.nodes().to$().addClass('shown');
                            });
                            //Set to false if you don't want the paging to reset after ajax load,otherwise true
                        }, false);  
                    }
                }
            });
        }
    });

    //AUTO REFRESH TABLE 
    setInterval(function(){
        profTbl.ajax.reload(function () {
            //Iterate through all the open rows and open them again   <--Value is set in the onClickEventListener function
            profTbl.rows(rowIds).every(function (row, index, array) {
                profTbl.row(row).child(adminFormat(this.data())).show();
                this.nodes().to$().addClass('shown');
            });
            //Set to false if you don't want the paging to reset after ajax load,otherwise true
        }, false);  
    }, 5000); 
    
});