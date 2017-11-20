<?php
	session_start();
if(isset($_SESSION['nomUser']))
{
	include('config.php');
	
	
	if(isset($_POST['enregistrer']))
	{
		$stmt = $conn->prepare("INSERT INTO `marque`(`LABELLE_MARQUE`) VALUES (:labelMarque)");
			
			$stmt->bindParam(':labelMarque', $_POST['labelMarque']);
			$stmt->execute();
			
			header('Location: ajouterMarque.php?add=true');
	}

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Matériel | Ajouter Marque</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

		    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
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
                            <a>Matérielles</a>
                        </li>
                        <li class="active">
                            <strong>Ajouter Marque</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-7">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Gestion Matérielles <small>Ajouter une marque des matérielles.</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
						
									<?php
										if(isset($_GET['add']))
										{
											$nombre = $_GET['add'];
											if($nombre == "true")
											{
											 echo '
											 <div class="alert alert-success fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Success!</strong> Marque ajoutée avec succes.
											</div>';
											}
											
											else if($nombre == "false")
											{
												echo '
											 <div class="alert alert-warning fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>ََAttention!</strong> Marque non ajoutée.
											  </div>';
											}
										}
										
									?>
                            <form method="POST" class="form-horizontal" action="">
                                <div class="form-group"><label class="col-sm-2 control-label">Label Marque</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="labelMarque"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="reset">Annuler</button>
                                        <button class="btn btn-primary" type="submit" name="enregistrer">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
				
				
				<div class="col-lg-5">
                    <div class="ibox float-e-margins">
						<div class="ibox-title">
                            <h5>Gestion Matérielles <small>La liste des marques.</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
						
							<?php
								if(isset($_GET['supp']))
								{
									$nombre = $_GET['supp'];
									if($nombre == "true")
									{
									 echo '
									 <div class="alert alert-success fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Success!</strong> Marque supprimé avec succes.
									</div>';
									}
									
									else if($nombre == "false")
									{
										echo '
									 <div class="alert alert-warning fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>ََAttention!</strong> Marque non supprimé.
									  </div>';
									}
								}
								
								if(isset($_GET['modif']))
								{
									$nombre = $_GET['modif'];
									if($nombre == "true")
									{
									 echo '
									 <div class="alert alert-success fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Success!</strong> Marque modifiée avec succes.
									</div>';
									}
									
									else if($nombre == "false")
									{
										echo '
									 <div class="alert alert-warning fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>ََAttention!</strong> Marque non modifiée.
									  </div>';
									}
								}
							?>

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Numéro</th>
                                    <th data-hide="phone">Labelle Marque</th>
                                    <th class="text-right" data-sort-ignore="true">Action</th>
                                </tr>
                                </thead>
                                <tbody>
								
									<?php
										$con=mysqli_connect("localhost","root","","gestionpannes");
										if (mysqli_connect_errno())
										{
											echo "Impossible de connecter a mysql " . mysqli_connect_error();
										}

										$marque = mysqli_query($con,"SELECT * FROM marque");
										$compteur=1;

										while($row = mysqli_fetch_array($marque))
										{
											echo "<tr>";
											echo "<td>" .$compteur."</td>";
											
											echo "<td>" . $row['LABELLE_MARQUE']."</td>";
											
											echo "<td class='text-right'>
													<div class='btn-group'>
														<a class='btn-white btn btn-xs' data-toggle='modal' data-target='#myModa".$row['ID_MARQUE']."''><i class='fa fa-edit'></i></a>";
												if($_SESSION['typeUser'] == 'admin')	echo	"<a class='btn-white btn btn-xs demo4' id=".$row['ID_MARQUE']."><i class='fa fa-times'></i></a>";
												echo	"</div>
												</td>";
											
											echo "</tr>";
											
											$compteur+=1;
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
							
							<?php
								$con=mysqli_connect("localhost","root","","gestionpannes");
								if (mysqli_connect_errno())
								{
									echo "Impossible de connecter a mysql " . mysqli_connect_error();
								}

								$materielle = mysqli_query($con,"SELECT * FROM marque");

								while($row2 = mysqli_fetch_array($materielle))
								{

										echo "<div class='modal inmodal fade' id='myModa".$row2['ID_MARQUE']."' tabindex='-1' role='dialog'  aria-hidden='true'>
											<div class='modal-dialog modal-lg'>
												<div class='modal-content'>
													<div class='modal-header'>
														<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
														<h4 class='modal-title'>Modifier Un Type</h4>
													</div>
													<form method='POST' class='form-horizontal' action='traitement.php'>
													<div class='modal-body'>
														<div class='ibox float-e-margins'>
															
																<div class='form-group'><label class='col-sm-2 control-label'>Label Marque</label>

																	<div class='col-sm-10'><input type='text' class='form-control' name='labelMarque' value='".$row2['LABELLE_MARQUE']."'></div>
																	<div class='col-sm-10'><input type='hidden' class='form-control' name='idMarque' value='".$row2['ID_MARQUE']."'></div>
																</div>
															
														</div>
													</div>
													<div class='modal-footer'>
														<button type='reset' class='btn btn-white' data-dismiss='modal'>Fermer</button>
														<button type='submit' class='btn btn-primary' name='modifierMarque'>Modifier</button>
													</div>
													</form>
												</div>
											</div>
										</div>";

								}
								
								mysqli_close($con);
							?>
							
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
	
			    <!-- FooTable -->
    <script src="js/plugins/footable/footable.all.min.js"></script>
    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<script>

    $(document).ready(function () {

        $('.demo4').click(function () {
			var id = $(this).attr('id');
            swal({
				title: "Vous etes sur?",
				text: "Cette marque seras supprimer de la base des données !",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Oui, supprimer!",
				cancelButtonText: "Non, annuler!",
				closeOnConfirm: false,
				closeOnCancel: false },
			function (isConfirm) {
				if (isConfirm) {
					swal("Supprimé!", "La marque a été supprimée de la base des données", "success");
					window.location.href='traitement.php?suppMarque='+id+'';
				} else {
					
					swal("Annulé", "Action annulée ", "error");
				}
			});
        });


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
