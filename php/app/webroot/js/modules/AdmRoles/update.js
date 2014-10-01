/* (c)Bittion Admin Module | Created: 19/08/2014 | Developer:reyro | JS: AdmRoles/update */
jQuery(document).ready(function() {
//START SCRIPT
//************************************** EXEC MAIN - START **************************************

//    Created: 19/08/2014 | Developer: reyro | Description: Validates Account User Form
    jQuery("#AdmRoleUpdateForm").validate({
        onkeyup: false, //avoid requesting ajax every time keyup, only activates on blur and on submit
        submitHandler: function(form) {
            //Replace form submit for:
            fnUpdate();
        },
        // Rules for form validation
        rules: {
//            'data[AdmProfile][family_name]': {
//                minlength: 3
//            }
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

//    Created: 19/08/2014 | Developer: reyro | Description: update user account | Request: Ajax
    function fnUpdate() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnUpdate',
            dataType: 'json',
            data: {
                data: jQuery('#AdmRoleUpdateForm').bittionSerializeObjectJson()
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