$(document).ready(function() {

    var a = $('.product-wrapper button').length;

    function checkbtn(){

        for(var x = 0 ; x<a ; x++){

            $('#button' + x ).on('click', function(){
                var idn = $(this).attr('id');
                var sidn = idn.substr(6);
                var inid = "#editinfo" + sidn;
                var bval = $(this).val();
                var inval = $(inid).val();
                var ac = "#actpri" + sidn;
                var acw = "#acw" + sidn;
                var sbt = "#subtotal" + sidn;
                var mt = "#maintotal" + sidn;
                var mtt = "#maintotal" + sidn;
                var cd = "#cdata" + sidn;
                var msub = "#msub" + sidn;
                var mtotal = "#mtotal" + sidn;
                var mdd = "#mdata" + sidn;

                $.ajax({
                    method: 'post',
                    url: 'http://admin.gerox.x10host.com/eprodprice',
                    dataType: 'json',
                    data:{
                        id: bval,
                        eval: inval,
                    },
                    success: function(d){
                        var diff = $(sbt).text() - d;
                        if(d != false){
                            $(ac).text(d);
                            $(acw).text(d);
                            $(mt).text(diff);
                            $(mtotal).text(diff);
                            
                            if($(mtt).text() > 0){
                                $(cd).removeClass('bg-danger');
                                $(cd).addClass('bg-success');
                                $(cd).addClass('text-white');

                                $(mdd).removeClass('bg-danger');
                                $(mdd).addClass('bg-success');
                                $(mdd).addClass('text-white');

                            }else{                            
                                $(cd).removeClass('bg-success');
                                $(cd).addClass('bg-danger');
                                $(cd).addClass('text-white');

                                $(mdd).removeClass('bg-success');
                                $(mdd).addClass('bg-danger');
                                $(mdd).addClass('text-white');
                            }
                            
                        }
                        
                    }
                });
            });

        }
    }
    
    function changeColor(){

        //var idn = $(this).attr('id');
        //var sidn = idn.substr(6);
        for(var x = 0 ; x<a ; x++){
            var idn = $('#button' + x).attr('id');
            var x = idn.substr(6);
            var mtt = "#mtotal" + x;
            var cd = "#cdata" + x;
            var mdd = "#mdata" + x;

            console.log(mtt);
            if($(mtt).text() > 0){
                $(mdd).removeClass('bg-danger');
                $(mdd).addClass('bg-success');
                $(mdd).addClass('text-white');

                $(cd).removeClass('bg-danger');
                $(cd).addClass('bg-success');
                $(cd).addClass('text-white');                    
            }else{
                $(mdd).removeClass('bg-success');
                $(mdd).addClass('bg-danger');
                $(mdd).addClass('text-white');

                $(cd).removeClass('bg-success');
                $(cd).addClass('bg-danger');
                $(cd).addClass('text-white');
            }
        }
    }
    changeColor();
    checkbtn();
});