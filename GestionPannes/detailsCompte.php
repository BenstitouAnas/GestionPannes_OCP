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

    <title>Demandes | Détaille Compte</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	
	<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

		<?php include('menu.php'); ?>

        <div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">

				<?php include('notification.php'); ?>
			
			</div>
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>Oui C'est Possible !</h2>
					<ol class="breadcrumb">
						<li>
							<a>Admin</a>
						</li>
						<li>
							<a>Demandes</a>
						</li>
						<li class="active">
							<strong>Détailles Compte</strong>
						</li>
					</ol>
				</div>
				<div class="col-lg-2">

				</div>
			</div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox product-detail">
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-md-7">
								
									<?php
										$con=mysqli_connect("localhost","root","","gestionpannes");
										if (mysqli_connect_errno())
										{
											echo "Impossible de connecter a mysql " . mysqli_connect_error();
										}

										//Recuperer les informations sur la demande
										$users = mysqli_query($con,"SELECT * FROM utilisateur WHERE MATRICULE_UTILIS='".$_GET['compte']."'");

										$user = mysqli_fetch_array($users);
										
										//Le Service
										$service = mysqli_query($con,"SELECT * FROM `service` WHERE `ID_SERVICE`=".$user['ID_SERVICE']."");

										$serv = mysqli_fetch_array($service);
										/*****************************************************************************************************/
										
										echo "<h2 class='font-bold m-b-xs'>Matricule : ".$user['MATRICULE_UTILIS']."</h2><div class='m-t-md'></div>";
										
										echo"<hr><dl class='small m-t-md'>";
										
										echo "<dt>Nom et Prénom</dt>
											  <dd><a href=''>".$user['NOM_UTILIS']." ".$user['PRENOM_UTILIS']."</a></dd><br>";
											  
										echo "<dt>Date Naissance</dt>
											  <dd>".$user['DATENAISSANCE_UTILIS']."</dd><br>";
											
										echo "<dt>Adresse utilisateur</dt>
											<dd>".$user['ADRESSE_UTILIS']."</dd><br>";
											
										echo "<dt>Numéro de téléphone</dt>
											<dd>".$user['TELE_UTILIS']."</dd><br>";
											
										echo "<dt>Email utilisateur</dt>
											<dd>".$user['EMAIL_UTILIS']."</dd><br>";	
										
										echo "<dt>Sérvice D'Afféctation</dt>
											<dd>".$serv['NOM_SERVICE']." (".$serv['CODE_SERVICE']. ")</dd><br>";
										
										
										echo "<dt>Type utilisateur</dt>";
										
											if($user['TYPE_UTILIS'] == "agent")
												echo "<dd>Agent OCP</dd><br>";
											else if($user['TYPE_UTILIS'] == "IT")
												echo "<dd>IT du service informatique</dd><br>";
											else
												echo "<dd>Type non définie</dd><br>";
										
										echo "<dt>Etat du compte</dt>";
										
										if($user['CONFIRM_UTILIS'] == '0')
											echo "<dd>Compte non confirmé </dd><br>
												<a class='btn btn-white btn-sm' href='traitement.php?compte=".$user['MATRICULE_UTILIS']."'>
													<i class='fa fa-check'></i> Confirmer Compte </a> <br>";
													
										else if($user['CONFIRM_UTILIS'] == '1')
											echo "<dd>Compte confirmé </dd><br>
												<a class='btn btn-white btn-sm' href='traitement.php?compteBlock=".$user['MATRICULE_UTILIS']."'>
													<i class='fa fa-check'></i> Blocker Compte </a> <br>";
	
										echo "</dl><hr>";
										
										//mysqli_close($con);
									?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

		<?php include('footer.php'); ?>
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