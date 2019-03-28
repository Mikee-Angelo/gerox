$(document).ready(function(){
    var counter = 1 ;
    var pathArray = window.location.pathname.split('/');
//USER SERVER-SIDE DATATABLES
//CHILD TABLE FOR ADMIN TABLE
function userFormat(d){

    var trs = '';
    $.each(d[3], function(i,v){
        let product = v[1] * v[2];
        trs +='<tr>'+
        '<td>'+v[0]+'</td>'+
        '<td>'+v[1]+'</td>'+
        '<td>'+v[2]+'</td>'+
        '<td>'+product+'</td>'

        +'</tr>'
    });
    var a = '<div class="table-responsive">'+
    '<table class="table">'+
        '<thead><tr><th scope="col">Item Name</th><th scope="col">Quantity</th><th scope="col">Unit Amount</th><th scope="col">Total Amount</th></tr>'+
        '</thead>'+
        '<tbody>'+
                trs
        +'</tbody>'+
    '</table>'+
    '</div>'
    ;

    return a ; 
}
//INITIALIZING USER ORDER TABLE
    let userTbl = $('#usertbl').DataTable({
        "createdRow": function(r, d, di){
            //GETTING CURRENT DATE USING MOMENT
            let start_date = moment(new Date());
            let end_date= moment(d[1]);
            let diff_date = end_date.diff(start_date, 'days'); 
            if((diff_date + 1) > 0 && (diff_date + 1) <= 3){
                if(d[2]['del_status_id'] == 4){
                    $(r).addClass('table-success');
                }else{
                    $(r).addClass('table-danger'); 
                }
            }else{
                if(d[2]['del_status_id'] == 1){
                    $(r).addClass('table-warning');
                    
                }else if(d[2]['del_status_id'] == 2){
                    $(r).addClass('table-info');
    
                }else if(d[2]['del_status_id'] == 3){
                    $(r).addClass('table-primary');
    
                }else {
                    $(r).addClass('table-success'); 
                } 
            } 
        },
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            method: 'post',
            url: "http://admin.gerox.x10host.com/userorder",
            "data": function(data){
                data.filter_user_order = $('#fltuserorder').val()
            }
        },
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
                "data" : 0,
                "render": function(data, type, row, meta){
                    return data;
                }
            },
            {
                "targets": 2,
                "data" : 4,
                "render": function(data, type, row, meta){
                    return data;
                }
            },
            {
                "targets": -2,
                "data": 1,
                "render": function(data){
                    return moment(data).format('MMMM DD, YYYY');
                }
            },
            {
                "targets": -1,
                "data" : 2,
                "render": function(data, type, row, meta){
                    return data['del_status_name'];
                }
            }
        ],
        "scrollCollapse" : true,
        "scrollX" : true
    });
    //CLICK CHILD ROW ADMIN DATATABLE
    $('#usertbl tbody').on('click', 'td.details-control', function(){
        var tr = $(this).closest('tr');
        var row = userTbl.row(tr);

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }else{
            row.child( userFormat(row.data()) ).show();
            tr.addClass('shown');            
        }        
    });
//INITIALIZING SHOPPING TABLE
    let shopTbl = $('#shopTbl').DataTable({
        "processing" : true,
        "serverSide": true,
        "order" : [],
        "ajax" :{
            method: 'post',
            url: "http://admin.gerox.x10host.com/jsonShop",
            "dataSrc":  "data",
            data: function(data){
                data.uri = pathArray[2];
            }
        },
        "columnDefs": [
            {
                "targets": -2,
                "data": 4,
                "render": function(data){
                    return moment(data).format('MMMM DD, YYYY');
                }
            },
            {
                "targets": -1,
                "data": 5,
                "render": function(data){
                    return "<button class='btn btn-danger btn-xs btndel' data-id='"+data+"'>Delete</button>"
                }
            },

            {
                "targets": 4,
                "data": null,
                "render": function(data){
                    return data[2] * data[3];
                }
            }
    ],
        "scrollX" : true,
    });

//SETTING TOTAL OF PENDING ITEMS   
    shopTbl.on('xhr', function(){
        var json = shopTbl.ajax.json();
        var product = [];
        var sum = 0;
        
        $.each(json.data, function(i, v){
            product.push(json.data[i][3]);
            sum += product[i];
        });
        if(json.data.length > 0){
            var v = json.data[0][0];
            var d = json.data[0][4];

            var format = moment(d).format("YYYY-MM-DD");
            let today = new Date();
            let dd = today.getDate();
            let mm = null; 
            let yyyy = today.getFullYear();
            let date = yyyy + '-' + mm + '-' + dd;
            let moment_a = moment(d, "YYYY-MM-DD");
            let moment_b = moment(date, "YYYY-MM-DD");
            let diff_date = moment_a.diff(moment_b, 'days');

            if(today.getMonth() < 10){
                mm = '0' + (today.getMonth() + 1);
            }else{
                mm = today.getMonth() + 1;
            }
            $('#inputPNo').prop('disabled', true);
            $('#generate').prop('disabled', true);
            $('#po').val(v);
            $('#shopAdd').removeClass('disabled');
            $('#date-mask').prop('disabled',true);
            $('#date-mask').val(format);

            if(diff_date == 3){
                $('#urgent').prop('checked', true);
                $('#urgent').prop('disabled', true);
                $('#date-mask').css('display', 'none');
            }else{
                $('#urgent').prop('disabled', true);
            }
            
        }else if($('#inputPNo').val().length != ''){
            $('#generate').prop('disabled', true);
            $('#shopAdd').prop('disabled', false);
            
            // if($('#inputPNo').val().length != ''){
            //     $('#shopAdd').removeClass('disabled'); 
            //     $('#inputPNo').prop('disabled', true);
            //     $('#inputPNo').prop('disabled', true);
            // }else{
            //     $('#inputPNo').val('');
            //     $('#inputPNo').prop('disabled', false);
            //     
            //     $('#shopAdd').addClass('disabled');
            //     $('#po').val(''); 
            //     $('#date-mask').prop('disabled',false);
            //     $('#date-mask').val('');  
            //     $('#urgent').prop('checked', false);
            //     $('#urgent').prop('disabled', false);
            //     $('#date-mask').css('display', 'block');  
            // }
        }else{

            $('#inputPNo').val('');
            $('#generate').prop('disabled',false);
            $('#inputPNo').prop('disabled', false);
            $('#po').val('');
            $('#date-mask').prop('disabled',false);
            $('#shopAdd').prop('disabled',false);
            $('#date-mask').val('');  
            $('#urgent').prop('checked', false);
            $('#urgent').prop('disabled', false);
            $('#date-mask').css('display', 'block'); 
        }

        $('#maintotal').html(sum);

        if(json.data.length > 0){
            $('#buyApproved').removeClass('disabled');
        }else{
            $('#buyApproved').addClass('disabled');
        }
    });

    $('#date-mask').on('change', function(){
        var dateinput = $(this).val().length;
      
        if(dateinput != 0){
            let now = moment();

            if(now.diff($(this).val(), "days") < -2){
                $('#urgent').prop('disabled', false);
                $('#urgent').prop('checked', false);
            }else{
                $('#urgent').prop('disabled', true);
                $('#urgent').prop('checked', true);
            }
        }else{
            $('#urgent').prop('disabled', false);
        }
    });
    //When clicking generate with valid input
    $('#generate').on('click', function(){
        if($('#inputPNo').val() != ''){
            $('#shopAdd').prop('disabled', false);
        }
    });
//BUY NOW BUTTON FUNCTION
    $(document).on('click', '#buyApproved', function(){
        var ponum = $('#inputPNo').val();

        $.ajax({
            method: 'POST',
            url: 'http://admin.gerox.x10host.com/buynow',
            dataType: 'json',
            data: {
                ponum: ponum
            },
            success:function(data){
                if(data == true){
                    shopTbl.draw();
                    $('#inputPNo').val('');
                    $('#po').html('');
                    $('#formShop').prepend('<div class="alert alert-success alert-dismissible fade show" id="shopAlert" role="alert">You successfully added an item<a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a></div>');
                    $('#buyMainModal').modal('toggle');
                }
            }

        });
    });

//ADDING TO CART BUTTON FUNCTION
    $('#addNew').on('click', function(e){
        e.preventDefault();

        let ord = $('#order').val();
        let qty = $('#quantity').val();
        let amnt = $('#amount').val();
        let po = $('#inputPNo').val();
        let need_date = $('#date-mask').val();
        let id = $(this).data('id');
        let level = $(this).data('level');
        let total = qty * amnt;

        
        if( ord !== '' || qty !== '' || amnt !== '' || need_date !== ''){
            $.ajax({
                method: 'POST',
                url: "http://admin.gerox.x10host.com/insertcart",
                dataType: 'json',
                data:{
                    id: id,
                    lvl : level,
                    po : po,
                    ord: ord,
                    qty: qty,
                    amnt: amnt,
                    nd : need_date
                },
                beforeSend: function(){
                    $(this).addClass('disabled');
                },
                success: function(data){
                    if(data){
                        $('#formShop')[0].reset();
                        $('#total').html('');
                        $('#date-mask').css('display', 'block');
                        shopTbl.ajax.reload();
                    }                                             
                }
            });
        }
    });

//SETTING PO NUMBER 
    $('#generate').on('click', function(){
        let i = $('#inputPNo').val();

        if(i !== ''){
            $('#shopAdd').removeClass('disabled');
            $(this).addClass('disabled');
            $('#inputPNo').prop('disabled', true);
            $('#po').html(i);

            $.ajax({
                url: 'http://admin.gerox.x10host.com/genpo',
                method: 'post',
                dataType: 'json',
                data: {
                    genpo : i,
                    id: pathArray[2]
                },
                success: function(d){
                  if(d == 'dup_po_main'){
                    $('#inputPNo').val('');
                    $('#generate').prop('disabled', false);
                    $('#inputPNo').prop('disabled', false);
                    $('#shopAdd').prop('disabled', true);
                    $('#modal-body').prepend('<div class="alert alert-danger alert-dismissible fade show" id="shopAlert" role="alert">PO Number has been acquired<a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a></div>');
                  }else if(d == 'dup_po'){
                    $('#inputPNo').val('');
                    $('#generate').prop('disabled', false);
                    $('#inputPNo').prop('disabled', false);
                    $('#shopAdd').prop('disabled', true);
                    $('#modal-body').prepend('<div class="alert alert-danger alert-dismissible fade show" id="shopAlert" role="alert">PO Number has been acquired<a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a></div>');
                  }else{
                    $('#inputPNo').val(d);
                  }
                    
                }
            });
        }
    });

    $('#amount').on('input', function(){
        let qty = $('#quantity').val();
        let amnt = $(this).val();
        let total = qty * amnt;

        $('#total').html(total);
    });  

//DELETING SELECTED ITEM ON CART
    $(document).on('click', '.btndel', function(){
        let delId = $(this).data('id');
        $.ajax({
            method: 'POST',
            url: "http://admin.gerox.x10host.com/delcart",
            dataType: 'json',
            data: {
                del_id: delId
            },
            beforeSend: function(){
            },
            success: function(data){
                if(data){
                    shopTbl.ajax.reload();
                }
            }            
        });
    });

    //CALENDAR FIX
    $('#urgent').on('click', function(){
        if($(this).prop('checked') == true){
            let start_date = moment(new Date());
            let d = start_date.add(3, 'days');

            let new_date = moment(d).format('YYYY-MM-DD');
            $('#date-mask').val(new_date);
            $('#date-mask').css('display', 'none');
        }else{
            $('#date-mask').css('display', 'block');
        }
    });

    //FILTERING DATE ON DATATABLE
    $('#fltuserorder').on('change', function(){
        userTbl.ajax.reload();
    });
});