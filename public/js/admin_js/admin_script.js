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
    // Section ***********************
    $('.updateSectionStatus').on('click',function(){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            url:`/admin/update-section-status`,
            type:'POST',
            data:{status:status,section_id:section_id},
            success:function(res){
              if(res['status'] == 0){
                   toastr.info('InActive');
                   $('#section-'+res['section_id']).html(" <a class='updateSectionStatus' href='javascript:void(0)'>InActive</a>")
                //  $('#section-'+res['section_id']).text("InActive")
              }else if(res['status'] == 1){
                  toastr.info('Active');
                   $('#section-'+res['section_id']).html(" <a class='updateSectionStatus' href='javascript:void(0)'>Active</a>")
                 // $('#section-'+res['section_id']).text('Active')
              }
            },
            error:function(error){
                console.log('Error ');
            }
        });
    });
    // Category ***********************
      $('.updateCategoryStatus').on('click',function(){
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        $.ajax({
            url:`/admin/update-categories-status`,
            type:'POST',
            data:{status:status,category_id:category_id},
            success:function(res){

              if(res['status'] == 0){
                   toastr.info('InActive');
                   $('#category-'+res['category_id']).html(" <a class='updateCategoryStatus' href='javascript:void(0)'>InActive</a>")
              }else if(res['status'] == 1){
                  toastr.info('Active');
                   $('#category-'+res['category_id']).html(" <a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>")
              }
            },
            error:function(error){
                console.log('Error ');
            }
        });
    });
    // Append Category Level
     $('#section_id').change(function(){
         var section_id = $(this).val();
         $.ajax({
             method:'post',
             url:'/admin/append-categories-level',
             data:{section_id:section_id},
             success:function(res){
                $('#appendCategoriesLevel').html(res);
             },
             error:function(){
                 console.log('Something wrong!');
             }
         })
     })
});
