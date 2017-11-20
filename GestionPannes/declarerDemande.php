<?php
	session_start();
if(isset($_SESSION['nomUserAgent']))
{
	include('config.php');
	
	
	if(isset($_POST['enregistrer']))
	{
		$stmt = $conn->prepare("INSERT INTO `demande`(`MATRICULE_UTILIS`, `ID_MATER`, `DATE_DEMANDE`, `ETAT_DEMANDE`) VALUES (:utilisateur, :materielle,:dateDemande, 0)");
			
			$stmt->bindParam(':utilisateur', $_SESSION['idUser']);
			$stmt->bindParam(':materielle', $_POST['materielle']);
			$stmt->bindParam(':dateDemande', date('Y-m-d H:i:s'));
			$stmt->execute();
			
			header('Location: declarerDemande.php?add=true');
	}

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Demandes | Ajouter Demande</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	
	<script type="text/javascript">
$(document).ready(function()
{
$("#servii").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "autoChoix.php",
data: dataString,
cache: false,
success: function(html)
{
$("#materr").html(html);
}
});

});

});
</script>
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
                            <a>Agent</a>
                        </li>
                        <li>
                            <a>Demandes de Panne</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Matérielle en panne ? <small>Indiquer le dans la liste des matérielles pour le réparer dans le plus tot possible.</small></h5>
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
											<strong>Success!</strong> Demande bien enregistrée.
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
                                <div class="form-group"><label class="col-sm-2 control-label">Service</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="service" id="servii">									
										<?php
											$con = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
											mysql_select_db("gestionpannes", $con) or die('Could not select database.');

											$sql = "SELECT * FROM `service`";

											$service = mysql_query($sql) or die(mysql_error()); //note: use mysql_error() for development only

											echo '<option value="service" selected hidden >Choisir Le Service</option> ';
											
											while($row = mysql_fetch_assoc($service)) {
												$id=$row['ID_SERVICE'];
												$data=$row['NOM_SERVICE'];
												echo '<option value="'.$id.'">'.$data.'</option>';
											 }
										?>
                                    </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-2 control-label">Matérielle</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="materielle" id="materr">	
										<option value="mater" selected hidden >Choisir Le Matérielle</option>									
                                    </select>
                                    </div>
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
				
				
				<!--<div class="col-lg-5">
                    <div class="ibox float-e-margins">
						<div class="ibox-title">
                            <h5>Historique <small>De vos demandes anciennes.</small></h5>
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
														<a class='btn-white btn btn-xs' data-toggle='modal' data-target='#myModa".$row['ID_MARQUE']."''><i class='fa fa-edit'></i></a>
														<a class='btn-white btn btn-xs demo4' id=".$row['ID_MARQUE']."><i class='fa fa-times'></i></a>
													</div>
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
                </div>-->
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

</body>

</html>


<?php
}
else
{
	header('Location: login.php');	
}
?>
