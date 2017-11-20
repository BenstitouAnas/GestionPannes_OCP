<?php
	session_start();
	
	include('config.php');
if(isset($_SESSION['nomUser']))
{
	
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OCP | Gestion Pannes</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="">

    <div id="wrapper">

		<?php include("menu.php"); ?>

        <div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
			<?php include('notification.php'); ?>
			</div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Oui C'est Possible !</h2>
                    <ol class="breadcrumb">
                        <li>
                           <a>Admin</a>
                        </li>
                        <li class="active">
                            <strong>Home</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="middle-box text-center animated fadeInRightBig">
                    <h3 class="font-bold">Application Gestion Pannes</h3>
                    <div class="error-desc">
                        Cette application web sert à gérer les demmandes des pannes des matérielles, ainssi que les types, les marques et les fournisseurs des matérielles.
                        <br/><a href="index.php" class="btn btn-primary m-t">Bienvenue</a>
                    </div>
                </div>
            </div>
			
			 <div class="footer">
                <?php include('footer.php'); ?>
            </div>
			

        </div>
		
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>


</body>

</html>


<?php
}
else
{
	header('Location: login.php');	
}
?>