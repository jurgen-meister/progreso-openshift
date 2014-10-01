/* (c)Bittion Admin Module | Created: 14/08/2014 | Developer:reyro | JS: AdmModules/create */
jQuery(document).ready(function() {
//START SCRIPT
//************************************** EXEC MAIN - START **************************************
//    Created: 14/08/2014 | Developer: reyro | Description: Validates Create Form
    jQuery("#AdmModuleCreateForm").validate({
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
//            'data[AdmModule][email]': {
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

//    Created: 14/08/2014 | Developer: reyro | Description: Function Create a new User | Request:Ajax | Obs: 2 choices: 'create' and 'create and edit'
    function fnCreate() {
        jQuery.ajax({
            type: 'POST',
            url: bittionUrlProjectAndController + 'fnCreate',
//            async: false,
            dataType: 'json',
            data: {
                data: jQuery('#AdmModuleCreateForm').bittionSerializeObjectJson()
            },
            success: function(response) {
                if (response['status'] === 'SUCCESS') {
                    bittionShowGrowlMessage(response['status'],response['title'],response['content']);
                    jQuery("#AdmModuleCreateForm").get(0).reset();
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