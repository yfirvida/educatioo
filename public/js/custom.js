$(function(){
 /* $('.fa-ellipsis-h').click(function(){
    console.log('click');
  	$(this).parent().find('.action-box').toggleClass('show');
  });*/

  $('.upload-link').click(function(){
        $('input#file').trigger('click');
  });

  $('input#file').change(function(){
    const file = this.files[0];
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            $('#profilePrev').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
  });

  if(!$('#cName').val() || !$('#cDescrip').val()){
    $('#addQ').prop('disabled', true);
    }

    $('#cName, #cDescrip').on('input', function() { 
          var val = $('#cName, #cDescrip').filter(function() {
                return this.value.trim().length !== 0;
        }).length === 0;

        $('#addQ').prop('disabled', val);
    });

//first question checkboxs only can check one at the same time
    $('.first-checks input[type="checkbox"]').on('change', function() {
        $('.first-checks input[type="checkbox"]').not(this).prop('checked', false);
    });

//last question checkboxs only can check one at the same time
    $('.last-checks input[type="checkbox"]').on('change', function() {
        $('.last-checks input[type="checkbox"]').not(this).prop('checked', false);
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
                alert('No user found, Please check the data 111');
              }
              else{
                    $('#g_name').replaceWith("<span id='g_name'>"+data[0].class+"</span>");
                    $('#st_name').replaceWith("<span id='g_name'>"+data[0].name+"</span>");
                    $('#s_level').replaceWith("<span id='s_level'>"+data['level']+"</span>");
                    
                    $('#class_id').val(data[0].classroom_id);
                    $('#course_id').val(data[0].exam_id);
                    $('#email2').val(data[0].email);
                    $('#password2').val('1234');
                    $('#loginStdModal').modal('show');
                }
             
            },
            error: function (data) {
                console.log(data);
            }
        });
  });

});

