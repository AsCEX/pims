<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Procurement and Inventory Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo site_url("assets/bootstrap/css/bootstrap.min.css"); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url("assets/dist/css/AdminLTE.min.css"); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo site_url("assets/dist/css/skins/skin-green.min.css"); ?>">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo site_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"); ?>">

    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo site_url("assets/plugins/daterangepicker/daterangepicker-bs3.css"); ?>">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo site_url("assets/plugins/datepicker/datepicker3.css"); ?>">

    <!-- main css -->
    <link rel="stylesheet" href="<?php echo site_url("assets/dist/css/main-style.css"); ?>">

    <script type="application/javascript">
        var site_url = '<?php echo site_url(); ?>';
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery 2.2.0 -->
    <script src="<?php echo site_url("assets/plugins/jQuery/jQuery-2.2.0.min.js"); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo site_url("assets/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo site_url("assets/plugins/jquery-validator/jquery.validate.min.js"); ?>"></script>
    <script src="<?php echo site_url("assets/plugins/datepicker/bootstrap-datepicker.js"); ?>"></script>

    <!-- InputMask -->
    <script src="<?php echo site_url("assets/plugins/numeric/jquery.numeric.js"); ?>"></script>

    <script>
        $(function(){
            $('input[name=cost], input.cost').numeric();
            $( document ).on( 'focus', ':input', function(){
                $( this ).attr( 'autocomplete', 'off' );
            });

            $('.date-picker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $("form").validate();
        });
    </script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <h3 style="float: left;color: #fff;margin: 10px;">Procurement and Inventory Management System</h3>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="<?php echo site_url('auth/logout'); ?>" class="" >
                            <span class="hidden-xs">Sign Out</span>

                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
