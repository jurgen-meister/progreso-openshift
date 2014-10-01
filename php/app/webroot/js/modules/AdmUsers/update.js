/* (c)Bittion Admin Module | Created: 05/08/2014 | Developer:reyro | JS: AdmUsers/update */
jQuery(document).ready(function() {
//START SCRIPT
    
//************************************** EXEC MAIN - START **************************************
    
//    Created: 09/08/2014 | Developer: reyro | Description: initiate datepicker birthdate (setup with years)
    var initiBirthYear = new Date().getFullYear() - 21;
    jQuery('#AdmProfileBirthdate').datepicker({
        dateFormat: 'dd/mm/yy',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        changeMonth: true,
        changeYear: true,
        defaultDate: new Date(initiBirthYear, 0, 1)
    });

//    Created: 09/08/2014 | Developer: reyro | Description: event click for reset a user's password
    jQuery('#btnResetPassword').click(function() {
        showBittionAlertModal({content: '¿Está seguro de resetear la contraseña para este usuario?', title:'Resetear Contraseña'});
        jQuery('#bittionBtnYes').click(function(event) {
            hideBittionAlertModal();
            event.preventDefault();
            fnResetPassword();
        });
    });

//    Created: 09/08/2014 | Developer: reyro | Description: .validate extra method for validate date (dd/mm/yyyy)
    $.validator.addMethod(
            "date",
            function(value, element) {
                var bits = value.match(/([0-9]+)/gi), str;
                if (!bits)
                    return this.optional(element) || false;
                str = bits[ 1 ] + '/' + bits[ 0 ] + '/' + bits[ 2 ];
                return this.optional(element) || !/Invalid|NaN/.test(new Date(str));
            },
            "Por favor ingrese una fecha en formato dd/mm/yyyy"
            );

//    Created: 09/08/2014 | Developer: reyro | Description: validates Profile Form
    jQuery("#AdmProfileUpdateForm").validate({
        onkeyup: false, //avoid requesting ajax every time keyup, only activates on blur and on submit
        onfocusout: false,
        submitHandler: function(form) {
            //Replace form submit for:
            fnUpdateProfile();
        },
        // Rules for form validation
        rules: {
            'data[AdmProfile][birthdate]': {
                date: true
            },
        },
        // Messages for form validation
        messages: {
        },
        // Do not change code below
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });

//    Created: 09/08/2014 | Developer: reyro | Description: avoid submit in all forms except in Profile Form because of .validate
    jQuery('form').submit(false); // only works for AdmUserForm, 'cause AdmProfileForm is bond with jquery .validate

//    Created: 09/08/2014 | Developer: reyro | Description: validate extra method for validate date (dd/mm/yyyy)
    jQuery('#btnUpdateUserProfile').click(function() {
        if (jQuery("#AdmUserUpdateForm").valid()) {
            fnUpdate();
//            alert('funciona');
        }
    });

//    Created: 09/08/2014 | Developer: reyro | Description: validates Account User Form
    jQuery("#AdmUserUpdateForm").validate({
//        onkeyup: false, //avoid requesting ajax every time keyup, only activates on blur and on submit
//        onfocusout: false,
//        submitHandler: function(form) {
//            //Replace form submit for:
//            fnUpdate();
//        },
        // Rules for form validation
        rules: {
            'data[AdmProfile][email]': {
                emailUnique: true
            },
            'data[AdmProfile][given_name]': {
                minlength: 3
            },
            'data[AdmProfile][family_name]': {
                minlength: 3
            }
        },
        // Messages for form validation
        messages: {
        },
        // Do not change code below
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });

//    Created: 09/08/2014 | Developer: reyro | Description: .validate extra method for Email Unique 
    jQuery.validator.addMethod('emailUnique', function(value, element) {
        //Extra step validation for Update
        if (jQuery('#emailHidden').length > 0) {
            if (jQuery('#emailHidden').val() === value) {
                return true;
            }
        }
        ///////
        var response = fnVerifyUnique('fnVerifyUniqueEmail', value);
        if (response > 0) {
            return false;
        }
        return true;
    }, 'El correo electrónico ya fue registrado');

//************************************** EXEC MAIN - END **************************************

//    Created: 09/08/2014 | Developer: reyro | Description: Universal verify unique function used for email | Request: Ajax
    function fnVerifyUnique(functionName, value) {
        var res = 0;
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + functionName,
            dataType: 'json',
            async: false, //the key for jquery.validation plugin, if it's true it finishes the function rigth there and won't work
            data: {
                value: value
            },
            success: function(response) {
                res = response;
            },
            error: function(response, status, error) {
                bittionAjaxErrorHandler(response, status, error);
            }
        });
        return res;
    }

//    Created: 09/08/2014 | Developer: reyro | Description: update profile | Request: Ajax
    function fnUpdateProfile() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnUpdateProfile',
//            async: false,
            dataType: 'json',
            data: {
                data: jQuery('#AdmProfileUpdateForm').bittionSerializeObjectJson()
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    bittionShowGrowlMessage(response['status'],response['title'],response['content']);
                }else{
                    bittionShowGrowlMessage(response['status'],response['title'],response['content']);
                }
            },
            error: function(response, status, error) {
                bittionAjaxErrorHandler(response, status, error);
            }
        });
    }
    
//    Created: 09/08/2014 | Developer: reyro | Description: reset user's password | Request: Ajax    
    function fnResetPassword() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnResetPassword',
//            async: false,
            dataType: 'json',
            data: {
                id:jQuery('#AdmUserUpdateForm #AdmUserId').val()
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    bittionShowGrowlMessage(response['status'],response['title'],response['content']);
                    jQuery('#content').prepend('<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a><strong>NUEVA CONTRASEÑA: </strong>: ' + response['data'] + '</div>');
                }else{
                    bittionShowGrowlMessage(response['status'],response['title'],response['content']);
                }
            },
            error: function(response, status, error) {
                bittionAjaxErrorHandler(response, status, error);
            }
        });
    }

//    Created: 09/08/2014 | Developer: reyro | Description: update user account | Request: Ajax
    function fnUpdate() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnUpdate',
            dataType: 'json',
            data: {
                data: jQuery('#AdmUserUpdateForm').bittionSerializeObjectJson()
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    bittionShowGrowlMessage(response['status'],response['title'],response['content']);
                }else{
                    bittionShowGrowlMessage(response['status'],response['title'],response['content']);
                }
            },
            error: function(response, status, error) {
                bittionAjaxErrorHandler(response, status, error);
            }
        });
    }


//END SCRIPT
});


