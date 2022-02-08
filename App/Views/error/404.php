<!DOCTYPE html>

<html lang="pt">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title><?php echo TITLE; ?> 404</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="http://<?php echo APP_HOST; ?>/public/assets/app/custom/error/error-v2.default.css" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/vendors/custom/vendors/fontawesome5/css/all.min.css" rel="stylesheet" type="text/css" />

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="http://<?php echo APP_HOST; ?>/public/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="http://<?php echo APP_HOST; ?>/public/assets/demo/default/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/demo/default/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/demo/default/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="http://<?php echo APP_HOST; ?>/public/assets/demo/default/skins/aside/dark.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="http://<?php echo APP_HOST; ?>/public/assets/media/logos/favicon-3.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<center>
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v2" style="background-image: url(http://<?php echo APP_HOST; ?>/public/assets/media//error/bg2.jpg);">
                 <a href="javascript: history.go(-1)" title="Clique aqui pra retornar" > 
            <img src="http://<?php echo APP_HOST; ?>/public/assets/media/logos/alanti_logo.png" alt="Coisa Virtual" >
        </a>
            <div class="kt-error_container">
                <span class="kt-error_title2 kt-font-light">
                    <h1><?php echo $varMessage; ?></h1>
                </span>
                <span class="kt-error_desc kt-font-light">
                    <a href="javascript: history.go(-1)" title='Clique aqui pra retornar' > Click aqui para retornar </a>
                </span>
            </div>
        </div>
    </div>

</body>

<!-- end::Body -->

</html>