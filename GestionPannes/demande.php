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

    <title>Demandes | Liste Demandes</title>

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
                            <a>Demande</a>
                        </li>
                        <li class="active">
                            <strong>Liste Demandes</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">

           <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
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
										<strong>Success!</strong> Demande fixée avec succes.
									</div>';
									}
									
									else if($nombre == "false")
									{
										echo '
									 <div class="alert alert-warning fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>ََAttention!</strong> Demande non fixée.
									  </div>';
									}
								}
							?>

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Numéro du Demande</th>
                                    <th data-hide="phone">Demandeur</th>
                                    <th data-hide="all">Description Matérielle</th>
                                    <th data-hide="phone">Matérielle</th>
                                    <th data-hide="phone">Date Demande</th>
                                    <th data-hide="phone">Etat Demande</th>
                                    <th class="text-right" data-sort-ignore="true">Plus d'infos</th>
                                </tr>
                                </thead>
                                <tbody>
								
									<?php
										$con=mysqli_connect("localhost","root","","gestionpannes");
										if (mysqli_connect_errno())
										{
											echo "Impossible de connecter a mysql " . mysqli_connect_error();
										}

										
										$demande = mysqli_query($con,"SELECT * FROM demande");
											
										while($row = mysqli_fetch_array($demande))
										{
											echo "<tr>";
											echo "<td> Demande N° : " .$row['ID_DEMANDE']."</td>";
											
											/*Recuperer le type du demandeur*/
											$demandeur = mysqli_query($con,"SELECT * FROM `utilisateur` WHERE `MATRICULE_UTILIS`='".$row['MATRICULE_UTILIS']."'");
											
											$user = mysqli_fetch_assoc($demandeur);
											
											echo "<td>".$user['NOM_UTILIS']." ".$user['PRENOM_UTILIS']."</td>";
											
											/*Recuperer la materielle*/
											$materielle = mysqli_query($con,"SELECT * FROM `materielle` WHERE `ID_MATER`=".$row['ID_MATER']."");
											$mater = mysqli_fetch_assoc($materielle);
											
											/*Recuperer la marque*/
											$marque = mysqli_query($con,"SELECT * FROM `marque` WHERE `ID_MARQUE`=".$mater['ID_MARQUE']."");
											$marq = mysqli_fetch_assoc($marque);
											
											/*Recuperer la type*/
											$type = mysqli_query($con,"SELECT * FROM `typemateriel` WHERE `ID_TYPE`=".$mater['ID_TYPE']."");
											$typ = mysqli_fetch_assoc($type);
											
											
											echo "<td>".$mater['DESIGNATION_MATER']."</td>";
											
											echo "<td>".$typ['LABELLE_TYPE']." (".$marq['LABELLE_MARQUE'].")</td>";
											
											echo "<td>".$row['DATE_DEMANDE']."</td>";

											/*Recuperer l'etat du demande*/
											
											if($row['ETAT_DEMANDE'] == '1')
												echo "<td><span class='label label-primary'>Fixé</span></td>";
											if($row['ETAT_DEMANDE'] == '0')
												echo "<td><span class='label label-danger'>En Attente</span></td>";
											
											
											echo "<td class='text-right'>
													<div class='btn-group'>
														<span class='btn-white btn btn-xs'><a href='detailsDemande.php?demande=".$row['ID_DEMANDE']."'>Plus infos</a></span>
													</div>
												</td>";
											
											echo "</tr>";
										}
										
										mysqli_close($con);
									?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php include('footer.php'); ?>
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
	
	<!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
	
	<!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
	
	    <!-- FooTable -->
    <script src="js/plugins/footable/footable.all.min.js"></script>
	
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