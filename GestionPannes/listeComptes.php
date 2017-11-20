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

    <title>Comptes | Liste Comptes</title>

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
                            <a>Comptes</a>
                        </li>
                        <li class="active">
                            <strong>Liste Des Comptes</strong>
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
										<strong>Success!</strong> Compte blocké avec succes.
									</div>';
									}
									
									else if($nombre == "false")
									{
										echo '
									 <div class="alert alert-warning fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>ََAttention!</strong> Compte non blocké.
									  </div>';
									}
								}
							?>

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Matricule</th>
                                    <th data-hide="phone">Nom</th>
                                    <th data-hide="all">Email utilisateur</th>
                                    <th data-hide="phone">Prénom</th>
                                    <th data-hide="phone">Service</th>
                                    <th data-hide="phone">Type</th>
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

										
										$demande = mysqli_query($con,"SELECT * FROM utilisateur WHERE CONFIRM_UTILIS=1");
											
										while($row = mysqli_fetch_array($demande))
										{
											echo "<tr>";
											
											echo "<td>" .$row['MATRICULE_UTILIS']."</td>";
											
											echo "<td>".$row['NOM_UTILIS']."</td>";
											
											echo "<td>".$row['EMAIL_UTILIS']."</td>";
											
											echo "<td>".$row['PRENOM_UTILIS']."</td>";
											
											/*Recuperer Service*/
											$service = mysqli_query($con,"SELECT * FROM `service` WHERE `ID_SERVICE`=".$row['ID_SERVICE']."");
											$serv = mysqli_fetch_assoc($service);
											
											echo "<td>".$serv['NOM_SERVICE']."</td>";
											
											
											if($row['TYPE_UTILIS'] == "agent")
												echo "<td><span class='label label-primary'>Agent</span></td>";
											else if($row['TYPE_UTILIS'] == "IT")
												echo "<td><span class='label label-warning'>IT</span></td>";
											else
												echo "<td><span class='label label-danger'>Non Défini</span></td>";
											
											
											echo "<td class='text-right'>
													<div class='btn-group'>
														<span class='btn-white btn btn-xs'><a href='detailsCompte.php?compte=".$row['MATRICULE_UTILIS']."'>Plus infos</a></span>
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