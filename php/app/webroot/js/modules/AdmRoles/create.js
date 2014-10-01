/* (c)Bittion Admin Module | Created: 19/08/2014 | Developer:reyro | JS: AdmRoles/create */
jQuery(document).ready(function() {
//START SCRIPT
//************************************** EXEC MAIN - START **************************************
//    Created: 19/08/2014 | Developer: reyro | Description: Validates Create Form
    jQuery("#AdmRoleCreateForm").validate({
        onkeyup: false, //avoid requesting ajax every time keyup, only activates on blur and on submit
        submitHandler: function(form) {
            //Replace form submit for:
            fnCreate();
        },
        // Rules for form validation
        rules: {
//			'data[AdmProfile][given_name]': {
//                minlength: 3
//            },            			
        },
        // Messages for form validation
        messages: {
//            'data[AdmRole][email]': {
//                required: 'Please enter your email address',
//                email: 'Please enter a VALID email address'
//            },
        },
        // Do not change code below
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });
//************************************** EXEC MAIN - END **************************************

//    Created: 19/08/2014 | Developer: reyro | Description: Function Create a new User | Request:Ajax
    function fnCreate() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnCreate',
//            async: false,
            dataType: 'json',
            data: {
                data: jQuery('#AdmRoleCreateForm').bittionSerializeObjectJson(),
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    bittionShowGrowlMessage(response['status'], response['title'], response['content']);
                    jQuery("#AdmRoleCreateForm").get(0).reset();
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