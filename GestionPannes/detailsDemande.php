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

    <title>Demandes | Détaille Demande</title>

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
							<strong>Détailles Demande</strong>
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
						
							<?php
								if(isset($_GET['modif']))
								{
									$nombre = $_GET['modif'];
									if($nombre == "true")
									{
									 echo '
									 <div class="alert alert-success fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Success!</strong> Matériel modifié avec succes.
									</div>';
									}
									
									else if($nombre == "false")
									{
										echo '
									 <div class="alert alert-warning fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>ََAttention!</strong> Matériel non modifié.
									  </div>';
									}
								}
							?>

                            <div class="row">
                                <!--<div class="col-md-5">


                                    <div class="product-images">

                                        <div>
                                            <div class="image-imitation">
                                                <img alt="image" class="img-circle" src="img/it.png" />
                                            </div>
                                        </div>
                                    </div>

                                </div>-->
                                <div class="col-md-7">
								
									<?php
										$con=mysqli_connect("localhost","root","","gestionpannes");
										if (mysqli_connect_errno())
										{
											echo "Impossible de connecter a mysql " . mysqli_connect_error();
										}

										//Recuperer les informations sur la demande
										$demande = mysqli_query($con,"SELECT * FROM demande WHERE ID_DEMANDE=".$_GET['demande']."");

										$dmnd = mysqli_fetch_array($demande);
										
										//Le demandeur
										$demandeur = mysqli_query($con,"SELECT * FROM `utilisateur` WHERE `MATRICULE_UTILIS`='".$dmnd['MATRICULE_UTILIS']."'");

										$demandeurr = mysqli_fetch_array($demandeur);
										
										//Recuperer les informations sur le materielle							
										$materielle = mysqli_query($con,"SELECT * FROM materielle WHERE ID_MATER=".$dmnd['ID_MATER']."");

										$mater = mysqli_fetch_array($materielle);
										
										//Le type 	
										$type = mysqli_query($con,"SELECT * FROM `typemateriel` WHERE `ID_TYPE`=".$mater['ID_TYPE']."");

										$typ = mysqli_fetch_array($type);
										
										//La marque
										$marque = mysqli_query($con,"SELECT * FROM `marque` WHERE `ID_MARQUE`=".$mater['ID_MARQUE']."");

										$marqu = mysqli_fetch_array($marque);
										
										//Le Service
										$service = mysqli_query($con,"SELECT * FROM `service` WHERE `ID_SERVICE`=".$mater['ID_SERVICE']."");

										$serv = mysqli_fetch_array($service);
										
										//Le Fournisseur
										$fournisseur = mysqli_query($con,"SELECT * FROM `fournisseur` WHERE `ID_FOURNIS`=".$mater['ID_FOURNIS']."");

										$fournis = mysqli_fetch_array($fournisseur);
										
										/*****************************************************************************************************/
										
										echo "<h2 class='font-bold m-b-xs'>Demande N° : ".$dmnd['ID_DEMANDE']."</h2><div class='m-t-md'></div>";
										
										echo"<hr><dl class='small m-t-md'>";
										
										echo "<dt>Demandeur</dt>
											  <dd><a href=''>".$demandeurr['NOM_UTILIS']." ".$demandeurr['PRENOM_UTILIS']."</a></dd><br>";
											  
										echo "<dt>Date Demande</dt>
											  <dd>".$dmnd['DATE_DEMANDE']."</dd><br>";
											
										echo "<dt>Matérielle en Panne</dt>
											<dd>".$typ['LABELLE_TYPE']." (".$marqu['LABELLE_MARQUE'].")</dd><br>";
											
										echo "<dt>Fournisseur du Matérielle</dt>
											<dd>".$fournis['NOM_FOURNIS']."</dd><br>";
											
										echo "<dt>Déscription du Matérielle</dt>
											<dd>".$mater['DESIGNATION_MATER']."</dd><br>";	
										
										echo "<dt>Sérvice D'Afféctation</dt>
											<dd>".$serv['NOM_SERVICE']." (".$serv['CODE_SERVICE']. ")</dd><br>";
										
										if($mater['FIN_GARANTIE_MATER'] != '1970-01-01')
										{
											echo "<dt>Durée Garantie</dt>
											<dd><strong>De :</strong> ".$mater['DATE_ACHAT_MATER']." (Date d'achat) <strong>- A :</strong> ".$mater['FIN_GARANTIE_MATER']."</dd><br>";
										}
										
										else
											echo "<dt>Date Achat Matérielle</dt>
											<dd><strong>Le :</strong> ".$mater['DATE_ACHAT_MATER']."</dd><br>";
												
										echo "<dt>Matérielle de location</dt>";
										
											if($mater['LOCATION'] == '0')
												echo "<dd>Non</dd><br>";
											else
												echo "<dd>Oui</dd><br>";
										
										echo "<dt>Etat de la Demande</dt>";
										
											if($dmnd['ETAT_DEMANDE'] == '0')
												echo "<dd>Demande non fixée</dd><br>
													<a class='btn btn-white btn-sm' href='traitement.php?fixerDemande=".$dmnd['ID_DEMANDE']."'>
														<i class='fa fa-check'></i> Fixer </a> <br>";
											else
												echo "<dd>Demande fixée</dd><br>";
															

										echo "</dl><hr>";
										
										//mysqli_close($con);
									?>
                                    

                                    <div>
                                        <div class="btn-group">
                                           <?php 
										   
										   
										   echo "<a class='btn btn-white btn-sm' href='Message.php?demandeur=".$demandeurr['MATRICULE_UTILIS']."'>
												<i class='fa fa-envelope'></i> Contacter le demandeur
											</a>"; 
											
											echo "<a class='btn btn-white btn-sm' href='Message.php?fournisseur=".$fournis['ID_FOURNIS']."'>
												<i class='fa fa-envelope'></i> Contacter le fournisseur
											</a>";
											?>
                                        </div>
                                    </div>
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