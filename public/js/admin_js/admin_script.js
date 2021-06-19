$(document).ready(function(){

    // Check Admin Password is correct or not
    $('#current_pwd').keyup(function(){
        $('.text').html('');
        var current_pwd = $('#current_pwd').val();

        $.ajax({
            url:`/admin/check-current-pwd`,
            type:'POST',
            data:{current_pwd : current_pwd},
            success: function(response){
                if(response == 'false'){
                    $('#chkCurrentPwd').html('<font color="red">လက်ရှိစကား၀ှက်မှားနေပါသည်။</font>')
                }else if(response == 'true'){
                    $('#chkCurrentPwd').html('<font color="green">လက်ရှိစကား၀ှက်မှန်ကန်ပါသည်။</font>')

                }
            },
            error:function(){
                console.log('error');
            }
        })
    });
});
