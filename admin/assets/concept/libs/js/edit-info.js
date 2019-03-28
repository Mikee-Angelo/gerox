$(document).ready(function(){
      
    $('#epwd').on('keyup', function(){
        
        if($(this).val().length >= 8){
            $('#e_btn_sbmt').prop('disabled', false);
        }else{
            $('#e_btn_sbmt').prop('disabled', true);
        }
    }); 

});