/* (c)Bittion Admin Module | Created: 20/08/2014 | Developer:reyro | JS: AdmParameters/update */
jQuery(document).ready(function() {
//START SCRIPT
//************************************** EXEC MAIN - START **************************************

//    Created: 20/08/2014 | Developer: reyro | Description: Validates Account User Form
    jQuery("#AdmParameterUpdateForm").validate({
        onkeyup: false, //avoid requesting ajax every time keyup, only activates on blur and on submit
        submitHandler: function(form) {
            //Replace form submit for:
            fnUpdate();
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
        },
        // Do not change code below
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });

//************************************** EXEC MAIN - END **************************************

//    Created: 20/08/2014 | Developer: reyro | Description: update user account | Request: Ajax
    function fnUpdate() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnUpdate',
            dataType: 'json',
            data: {
                data: jQuery('#AdmParameterUpdateForm').bittionSerializeObjectJson()
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    bittionShowGrowlMessage(response['status'], response['title'], response['content']);
                } else {
                    bittionShowGrowlMessage(response['status'], response['title'], response['content']);
                }
            },
            error: function(response, status, error) {
                bittionAjaxErrorHandler(response, status, error);
            }
        });
    }
//END SCRIPT
});