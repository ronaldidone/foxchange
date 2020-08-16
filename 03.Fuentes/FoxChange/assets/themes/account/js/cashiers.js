$(document).ready(function() {

    

    setInterval(function(){
        var idtrans =$("#transId").val();
        refresh_chat_messages(idtrans);
    
    }, 5000);

    function refresh_chat_messages(idtrans){
        
            var postData = {
                csrf_name   : csrf_hash,
                'id_trans'    : idtrans                
            };
            
           
            //alert ("trans("+idtrans+") msg("+texto+") "+csrf_name+"("+csrf_hash+")");
            //alert("test");
            var url =config.baseURL + "/ajax/get_transaccion_chat/"
            $.ajax({
                type     : 'POST',
                url      : url,
                data     : postData,
                dataType : 'text',
                async    : true,
                success  : function(results) {
                   $("#messagelist").html(results);
                },
                error    : function(error) {
                   // alert("Error " + error.status + ": " + error.statusText);
                }
            });
    }

    //alert("Hola test");
    $("#inputMsgChat").on('keypress',function(e) {
        if(e.which == 13) {
            
            var texto = $(this).val();
            var idtrans = $("#transId").val();
            var postData = {
                csrf_name   : csrf_hash,
                'id_trans'    : $("#transId").val(),
                'msgtrans'    : $(this).val()
            };
            
           
            //alert ("trans("+idtrans+") msg("+texto+") "+csrf_name+"("+csrf_hash+")");
            //alert("test");
            var url =config.baseURL + "/ajax/register_chat_message/"
            $.ajax({
                type     : 'POST',
                url      : url,
                data     : postData,
                dataType : 'text',
                async    : true,
                success  : function(results) {
                   $("#messagelist").html(results);
                   $(this).val("");
                },
                error    : function(error) {
                   // alert("Error " + error.status + ": " + error.statusText);
                }
            });
           

        }    
    });
});