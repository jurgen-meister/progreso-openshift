/* (c)Bittion Admin Module | Created: 20/08/2014 | Developer:reyro | JS: AdmParameters/create */
jQuery(document).ready(function() {
//START SCRIPT
//************************************** EXEC MAIN - START **************************************
//    Created: 20/08/2014 | Developer: reyro | Description: Validates Create Form
    jQuery("#AdmParameterCreateForm").validate({
        onkeyup: false, //avoid requesting ajax every time keyup, only activates on blur and on submit
        submitHandler: function(form) {
            //Replace form submit for:
            fnCreate();
        },
        // Rules for form validation
        rules: {
            'data[AdmParameter][var_integer]': {
                digits: true
            },
            'data[AdmParameter][var_decimal]': {
                number: true
            }
        },
        // Messages for form validation
        messages: {
//            'data[AdmParameter][email]': {
//                required: 'Please enter your email address',
//                email: 'Please enter a VALID email address'
//            },
        },
        // Do not change code below
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });

    jQuery('#AdmParameterKeyParameter').select2();
//************************************** EXEC MAIN - END **************************************

//    Created: 20/08/2014 | Developer: reyro | Description: Function Create a new User | Request:Ajax
    function fnCreate() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnCreate',
//            async: false,
            dataType: 'json',
            data: {
                data: jQuery('#AdmParameterCreateForm').bittionSerializeObjectJson()
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    bittionShowGrowlMessage(response['status'], response['title'], response['content']);
//                    jQuery("#AdmParameterCreateForm").get(0).reset();
                    jQuery('#AdmParameterVarStringShort, #AdmParameterVarStringLong, #AdmParameterVarInteger, #AdmParameterVarDecimal').val('');
                    jQuery('#AdmParameterVarBoolean').prop('selectedIndex', 0);
                } else {
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