$(function(){
  $('.fa-ellipsis-h').click(function(){
  	$(this).parent().find('.action-box').toggleClass('show');
  });

//answeers checkboxs only can check one at the same time
    $('.radio-checks input[type="checkbox"]').on('change', function() {
        $('.radio-checks input[type="checkbox"]').not(this).prop('checked', false);
    });

  $('#btn-login').click(function(e){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    e.preventDefault();
        var formData = {
            pin: $('#pin').val(),
            name: $('#name').val(),
            _token: $('input[name="_token"]').val()
        };
        
        $.ajax({
            type: "POST",
            url: "/authByPin",
            data: formData,
            dataType: 'json',
            success: function (data) {
              if(data.length == 0){
                alert('No user found, Please check the data');
              }
              else{
                if(data[0].users.length > 0){
                    $('#g_name').replaceWith("<span id='g_name'>"+data[0].name+"</span>");
                    $('#st_name').replaceWith("<span id='g_name'>"+data[0].users[0].name+"</span>");
                    $('#s_level').replaceWith("<span id='s_level'>"+data['level']+"</span>");

                    $('#class_id').val(data[0].id);
                    $('#email2').val(data[0].users[0].email);
                    $('#password2').val('1234');
                    $('#loginStdModal').modal('show');
                }
                else{
                    alert('No user found, Please check the data');
                }
              }
             
            },
            error: function (data) {
                console.log(data);
            }
        });
  });

});

