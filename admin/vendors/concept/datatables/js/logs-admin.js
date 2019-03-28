$(document).ready(function(){
    let logstbl = $('#logstbl').DataTable({
        "serverSide": true,
        processing: false,
        "ajax": {
            method: 'POST',
            url: 'http://admin.gerox.x10host.com/showlogs'
        },
        "columnDefs":[
            {
                "targets": 0,
                "data": 1,
                "render": function(data, type, row, meta){
                    return data;
                }
            },
            {
                "targets": 1,
                "data": 2,
                "render": function(data, type, row, meta){
                    return data;
                }
            }
        ]
    });

    setInterval(function(){
        logstbl.ajax.reload(function(){}, false);
    }, 8000);
});