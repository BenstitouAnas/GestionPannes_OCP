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

    <title>Matériel | Détaille Matériel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	
	<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
	
	
	    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">

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
							<a>Matériel</a>
						</li>
						<li class="active">
							<strong>Détailles Matériel</strong>
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

										//Recuperer les informations sur le materielle
										$materielle = mysqli_query($con,"SELECT * FROM materielle WHERE ID_MATER=".$_GET['mater']."");

										$mater = mysqli_fetch_array($materielle);
										
										echo "<h2 class='font-bold m-b-xs'>".$mater['NUM_SERIE_MATER']."</h2><small>".$mater['DESIGNATION_MATER']."</small><div class='m-t-md'></div>";
										
										echo"<hr>

											<dl class='small m-t-md'>";
											
										//Le type 	
										$type = mysqli_query($con,"SELECT * FROM `typemateriel` WHERE `ID_TYPE`=".$mater['ID_TYPE']."");

										$typ = mysqli_fetch_array($type);
										
										
										echo "<dt>Type Matérielle</dt>
											<dd>".$typ['LABELLE_TYPE']."</dd><br>";
										
										//La marque
										$marque = mysqli_query($con,"SELECT * FROM `marque` WHERE `ID_MARQUE`=".$mater['ID_MARQUE']."");

										$marqu = mysqli_fetch_array($marque);
										
										echo "<dt>Marque du Matérielle</dt>
											<dd>".$marqu['LABELLE_MARQUE']."</dd><br>";
											
											
										$fournisseur = mysqli_query($con,"SELECT * FROM `fournisseur` WHERE `ID_FOURNIS`=".$mater['ID_FOURNIS']."");

										$fournis = mysqli_fetch_array($fournisseur);
										
										echo "<dt>Fournisseur Du Matérielle</dt>
											<dd><a href=''>".$fournis['NOM_FOURNIS']."</a></dd><br>
											";
											
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
											
										//Le Service
										$service = mysqli_query($con,"SELECT * FROM `service` WHERE `ID_SERVICE`=".$mater['ID_SERVICE']."");

										$serv = mysqli_fetch_array($service);
										
										echo "<dt>Service D'Affectation</dt>
											<dd>".$serv['NOM_SERVICE']." (".$serv['CODE_SERVICE']. ")</dd><br>";
											
											echo "<h4>Déscription du Matérielle</h4>

												<div class='small text-muted'>".$mater['DESIGNATION_MATER']."<br/></div>";	
															

										echo "</dl>
										<hr>";
										
										//mysqli_close($con);
									?>
                                    

                                    <div>
                                        <div class="btn-group">
                                           <?php echo "<a class='btn btn-white btn-sm' href='modifierMaterielle.php?modif=".$mater['ID_MATER']."'>
												<i class='fa fa-edit'></i> Modifier
											</a>
                                            <a class='btn btn-white btn-sm' href='Traitement.php?supp=".$mater['ID_MATER']."'>
												<i class='fa fa-times'></i> Supprimer
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
	
	<!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
	
	<!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
	
	<script>
		 $(document).ready(function() {
            $('.footable').footable();
        });
    </script>
	
</body>

</html>

<?php
}
else
{
	header('Location: login.php');	
}
?>