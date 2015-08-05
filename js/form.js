var smamo_ct_form,
    checkSuccess = function(target){
    
        if(target.val() === ''){target.removeClass('success').next('label').removeClass('stayup');}
        else if(target.is('input[type="checkbox"], input[type="radio"]')){console.log('not valid field type');}
        else{target.addClass('success').next('label').addClass('stayup');}
    }

var validateEmail = function(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

var formJsInit = function(){
    
        $('form input, form textarea').each(function(){
            checkSuccess($(this));
        });

        autosize($('form textarea:not(.no-autosize)'));

        // Check for allerede udfyldt felter ved sideload
        $('form input, form textarea').each(function(){
            var target = $(this);
            checkSuccess(target);
        });

        // Kosmetisk opdatering ved blur
        $('form input, form textarea').off().on('blur',function(e){
            var target = $(e.target);

            // Fjern error
            target.removeClass('error');

            // Check om feltet er tomt
            checkSuccess(target);

            if(target.is('input[type="email"]') && target.val() !== ''){

                if(!validateEmail(target.val())){

                    target.addClass('error');
                }


            }

        });
    }

jQuery(function($){
    
    var smamo_ct_form = $('#contact-form'),
        smamo_handle_ct_response = function(response){
            
            if(response.error){
                if(!$('#contact-form .error').length){
                    $('#contact-form').append('<div class="error"></div>');
                }
                
                $('#contact-form .error').html(response.error);
            }
            
            if(response.success){
                smamo_ct_form.empty().html(response.success);
            }
        
        smamo_ct_form.removeClass('loading');
            
        };

    if(smamo_ct_form.length){
        formJsInit();
        smamo_ct_form.off().on('click',function(e){
            var t = $(e.target);
            
            
            // Submit button
            if(t.is('a.submit')){
                e.preventDefault();
                
                smamo_ct_form.addClass('loading');
                
                var action = smamo_ct_form.attr('action'),
                    formdata = smamo_ct_form.serialize();
                
                $.ajax({
                    url : action,
                    type : 'POST',
                    data : formdata,
                    dataType : 'json',
                    success : function(response){
                        smamo_handle_ct_response(response);
                    },
                });
                  
            }
        
        });
    }
})