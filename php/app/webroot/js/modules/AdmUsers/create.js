/* (c)Bittion Admin Module | Created: 05/08/2014 | Developer:reyro | JS: AdmUsers/create */
jQuery(document).ready(function() {
//START SCRIPT

//************************************** EXEC MAIN - START **************************************

//    Created: 08/08/2014 | Developer: reyro | Description: .validate extra methos verify unique username
    jQuery.validator.addMethod('usernameUnique', function(value, element) {
        //Extra step validation for Update
        if (jQuery('#AdmUserUsernameHidden').length > 0) {
            if (jQuery('#AdmUserUsernameHidden').val() === value) {
                return true;
            }
        }
        ///////
        var response = fnVerifyUnique('fnVerifyUniqueUsername', value);
        if (response > 0) {
            return false;
        }
        return true;
    }, 'El nombre de usuario ya fue registrado, elija otro');

//    Created: 08/08/2014 | Developer: reyro | Description: .validate extra methos verify unique email
    jQuery.validator.addMethod('emailUnique', function(value, element) {
        //Extra step validation for Update
        if (jQuery('#AdmProfileEmailHidden').length > 0) {
            if (jQuery('#AdmProfileEmailHidden').val() === value) {
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

//    Created: 08/08/2014 | Developer: reyro | Description: validates Create Form
    jQuery("#AdmUserCreateForm").validate({
        onkeyup: false, //avoid requesting ajax every time keyup, only activates on blur and on submit
        submitHandler: function(form) {
            //Replace form submit for:
            fnCreate('create');
        },
        // Rules for form validation
        rules: {
            'data[AdmUser][username]': {
                minlength: 5
                , usernameUnique: true

            },
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
//            'data[AdmUser][email]': {
//                required: 'Please enter your email address',
//                email: 'Please enter a VALID email address'
//            },
        },
        // Do not change code below
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });

//    Created: 08/08/2014 | Developer: reyro | Description: Event click for Create and redirect to Update Profile
    jQuery('#btnCreateUpdatePerfil').click(function() {
        if (jQuery("#AdmUserCreateForm").valid()) {
            fnCreate('create_edit');
        }
    });

//    Created: 08/08/2014 | Developer: reyro | Description: Link Event click for generate a Username 
    jQuery('#linkGenerateUsername').click(function(event) {
        var given_name = jQuery('#AdmProfileGivenName').val();
        var family_name = jQuery('#AdmProfileFamilyName').val();
        if (given_name === '' || family_name === '') {
//            jQuery.smallBox({title: 'Error!', content: 'No se guardaron los datos, intente de nuevo.', color: '#C46A69', iconSmall: 'fa fa-warning bounce animated', timeout: 5000});
            alert('Los campos Nombre(s) y Apellido(s) deben estar llenados');
        } else {
            fnGenerateUsername(given_name, family_name);
        }
        event.preventDefault();

    });
    
//************************************** EXEC MAIN - END **************************************

//    Created: 08/08/2014 | Developer: reyro | Description: function Create a new User | Request:Ajax | Obs: 2 choices: 'create' and 'create and edit'
    function fnCreate(action) {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnCreate',
//            async: false,
            dataType: 'json',
            data: {
                data: jQuery('#AdmUserCreateForm').bittionSerializeObjectJson(),
                action: action
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    if (action === 'create') {
                        bittionShowGrowlMessage(response['status'], response['title'], response['content']);
                        jQuery('#content').prepend('<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a>' + '<strong>NOMBRE COMPLETO:</strong> ' + response['data']['fullname'] + ' <strong>USUARIO:</strong> ' + response['data']['username'] + ' <strong>CONTRASEÑA</strong>: ' + response['data']['password'] + '</div>');
                        jQuery("#AdmUserCreateForm").get(0).reset();
                    } else {
                        location.href = bittionUrlProjectAndController + 'update/id:' + response['data']['id'] + '/tab:profile';
                    }
                }else{
                    bittionShowGrowlMessage(response['status'], response['title'], response['content']);
                }
            },
            error: function(response, status, error) {
                bittionAjaxErrorHandler(response, status, error);
            }
        });
    }

//    Created: 08/08/2014 | Developer: reyro | Description: Universal verify unique function | Request: Ajax
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

//    Created: 08/08/2014 | Developer: reyro | Description: Generate username | Request: Ajax
    function fnGenerateUsername(given_name, family_name) {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnGenerateUsername',
            dataType: 'json',
            data: {given_name: given_name, family_name: family_name
            },
            success: function(response) {
                jQuery('#AdmUserUsername').val(response);
            },
            error: function(response, status, error) {
                bittionAjaxErrorHandler(response, status, error);
            }
        });
    }

//END SCRIPT
});