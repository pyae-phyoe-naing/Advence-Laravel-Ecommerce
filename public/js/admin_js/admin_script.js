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
    // Section
    $('.updateSectionStatus').click(function(){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            url:`/admin/update-section-status`,
            type:'POST',
            data:{status:status,section_id:section_id},
            success:function(res){
              if(res['status'] == 0){
                   $('#section-'+res['section_id']).html(" <a class='updateSectionStatus' href='javascript:void(0)'>InActive</a>")
                //  $('#section-'+res['section_id']).text("InActive")
              }else if(res['status'] == 1){
                   $('#section-'+res['section_id']).html(" <a class='updateSectionStatus' href='javascript:void(0)'>Active</a>")
                 // $('#section-'+res['section_id']).text('Active')
              }
            },
            error:function(error){
                console.log('Error ');
            }
        });
    });
});
