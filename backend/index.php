<?php
//var_dump($_SERVER['DOCUMENT_ROOT']);
//ini_set('display_errors',1);
//echo time();
ob_start();
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION['user_id'])) {
    $_SESSION['back']= $_SERVER['REQUEST_URI'];
    $_SESSION['error']= "Bạn chưa đăng nhập";
    header("location: login.php");
}
include "defined.php";
$mod='';
if(isset($_GET['mod']))
{
    $mod = $_GET['mod'];
}
require_once "model/Backend.php";
$model = new Backend;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin | bicthads.com</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo STATIC_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- font Awesome -->
        <link href="<?php echo STATIC_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->     
        <!-- Theme style -->
        <link href="<?php echo STATIC_URL; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
          <!-- jQuery 2.0.2 -->
        <script src="<?php echo STATIC_URL; ?>js/jquery-1.10.2.js"></script>
	    <script src="js/lazy.js"></script>
        <!-- jQuery UI 1.10.3 -->       
        
           <script src="<?php echo STATIC_URL; ?>js/form.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo STATIC_URL; ?>js/bootstrap.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo STATIC_URL; ?>js/AdminLTE/app.js" type="text/javascript"></script>
 <script src="<?php echo STATIC_URL; ?>js/jquery-ui.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo STATIC_URL; ?>js/AdminLTE/dashboard.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.datetimepicker.js"></script>

        <link href="css/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />    
        <link href="static/css/jquery-ui.css" rel="stylesheet" type="text/css" />   
        <script type="text/javascript" src="js/validate.js"></script> 
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                bicthads.com
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <?php include URL_LAYOUT."top.php"; ?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <?php include URL_LAYOUT."sidebar.php"; ?>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Main content -->
                <section class="content">
                    <?php
                     $act = isset($_GET['act']) ? $_GET['act'] : "";

                    if ($mod=="") include "view/campaign/list.php";
                    else include "view/".$mod.'/'.$act.'.php';

                    ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal --> 
<script type="text/javascript">

$(document).ready(function(){
   
   $("img.lazy").lazyload();
});
</script>
    </body>
</html>