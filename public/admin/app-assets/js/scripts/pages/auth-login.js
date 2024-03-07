$(function () {
    'use strict';

    var pageLoginForm = $('.auth-login-form');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (pageLoginForm.length) {
        pageLoginForm.validate({
            /*
            * ? To enable validation onkeyup
            onkeyup: function (element) {
                $(element).valid();
            },*/
            /*
            * ? To enable validation on focusout
            onfocusout: function (element) {
                $(element).valid();
            }, */
            rules: {
                'login-email': {
                    required: true,
                    email: true
                },
                'login-password': {
                    required: true
                }
            },
            messages: {
                'login-email': {
                    required: 'Please enter your email address.',
                    email: 'Please enter a valid email address.'
                },
                'login-password': {
                    required: 'Please enter your password.'
                }
            },
            errorElement: 'span',
            errorClass: 'invalid-feedback',
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });
    }
});
