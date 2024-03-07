<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('admin/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('admin/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{--<script src="{{ asset('admin/app-assets/js/scripts/pages/auth-login.js') }}"></script>--}}

<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/moment.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/scripts/parsley.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/core/form.js') }}?v={{time()}}"></script>
<script src="{{ asset('admin/app-assets/js/scripts/axios.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/core/custom.js') }}?v={{time()}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<!-- END: Page JS-->
<script>
    $(document).ready(function () {
        //login form
        $('#loginForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Your password must be at least 6 characters long" // Example: Custom message for minimum length
                }
            }
        });
        //register form
        $('#registerForm').validate({
            rules: {
                employee_name: {
                    required: true,
                },
                employee_code: {
                    required: true,
                },
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    number: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                address: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                zip: {
                    required: true,
                    number: true // Ensure it's a valid number
                },
            },
            messages: {
                employee_name: {
                    required: "Please enter the employee name",
                },
                employee_code: {
                    required: "Please enter the employee code",
                },
                first_name: {
                    required: "Please enter the first name",
                },
                last_name: {
                    required: "Please enter the last name",
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                phone: {
                    required: "Please enter a phone number",
                    number: "Please enter a valid phone number"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Your password must be at least 6 characters long"
                },
                address: {
                    required: "Please enter the address",
                },
                country: {
                    required: "Please select a country",
                },
                state: {
                    required: "Please select a state",
                },
                city: {
                    required: "Please select a city",
                },
                zip: {
                    required: "Please enter a zip code",
                    number: "Please enter a valid zip code"
                },
            }
        });

        $('#country').on('change', function () {
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    url: "{{ route('get-states', ':country') }}".replace(':country', countryId),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#state').empty();
                        $('#state').append('<option value="">Select State</option>');
                        $.each(data, function (key, value) {
                            $('#state').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#state').empty();
                $('#state').append('<option value="">Select State</option>');
            }
        });

        $('#state').on('change', function () {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: "{{ route('get-city', ':state') }}".replace(':state', stateId),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $.each(data, function (key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
            }
        });

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let $form = $('#registerForm');
            const redirect_url = 'admin/auth/login';
            $form.parsley();

            $form.on('submit', function (e) {
                e.preventDefault();
                $form.parsley().validate();
                if ($form.parsley().isValid()) {
                    loaderView();
                    let formData = new FormData($form[0]);
                    axios.post('{{ route("admin.auth.register") }}', formData)
                        .then(function (response) {
                            console.log(response);
                            $form[0].reset();
                            setTimeout(function () {
                                window.location.href = '{{ url('/') }}' + '/' + redirect_url;
                                loaderHide();
                            }, 1000);
                            notificationToast(response.data.message, 'success');
                        })
                        .catch(function (error) {
                            notificationToast(error.response.data.message, 'warning');
                            loaderHide();
                        });
                }
            });

            integerOnly();
        });

    })
    ;

</script>

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>
