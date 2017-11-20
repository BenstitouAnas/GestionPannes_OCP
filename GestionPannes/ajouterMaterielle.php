<?php
	session_start();
	
	include('config.php');
if(isset($_SESSION['nomUser']))
{
	
	if(isset($_POST['enregistrer']))
	{	
		$achat = strtotime($_POST["dateAchat"]);
		$dateAchat = date('Y-m-d',$achat);
		
		$FinGarantie = strtotime($_POST["dateFinGarantie"]);
		$dateFinGarantie = date('Y-m-d',$FinGarantie);
		
		$MiseService = strtotime($_POST["dateMiseService"]);
		$dateMiseService = date('Y-m-d',$MiseService);
		
		
		$stmt = $conn->prepare("INSERT INTO `materielle`(`ID_MARQUE`, `ID_SERVICE`, `ID_TYPE`, `ID_FOURNIS`, `NUM_SERIE_MATER`, `DESIGNATION_MATER`, `DATE_ACHAT_MATER`, `FIN_GARANTIE_MATER`, `LOCATION`, `DATE_MISE_EN_SERVICE`) VALUES (:marque,:service,:type,:fournisseur,:numeroSerie,:designation,:dateAchat,:dateFinGarantie,:location,:dateMiseService)");
			
			$stmt->bindParam(':numeroSerie', $_POST['numeroSerie']);
			$stmt->bindParam(':designation', $_POST['designation']);
			$stmt->bindParam(':marque', intval($_POST['marque']));
			$stmt->bindParam(':type', $_POST['type']);
			$stmt->bindParam(':fournisseur', $_POST['fournisseur']);
			$stmt->bindParam(':dateAchat', $dateAchat);
			$stmt->bindParam(':dateFinGarantie', $dateFinGarantie);
			$stmt->bindParam(':service', $_POST['service']);
			$stmt->bindParam(':dateMiseService', $dateMiseService);
			$stmt->bindParam(':location', $_POST['location']);
			
			$stmt->execute();
			
			header('Location: ajouterMaterielle.php?add=true');
	}

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Matériel | Ajouter Matériel</title>

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
                            <a>Matériel</a>
                        </li>
                        <li class="active">
                            <strong>Ajouter Matériel</strong>
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
                            <h5>Gestion Matériel <small>Ajouter un matériel.</small></h5>
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
												<strong>Success!</strong> Matériel ajouté avec succes.
											</div>';
											}
											
											else if($nombre == "false")
											{
												echo '
											 <div class="alert alert-warning fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>ََAttention!</strong> Matériel non ajouté.
											  </div>';
											}
										}
									?>
                            <form method="POST" class="form-horizontal" action="">
                                <div class="form-group"><label class="col-sm-2 control-label">Numéro Série</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="numeroSerie"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-2 control-label">Designation</label>

                                    <div class="col-sm-10"><textarea type="text" class="form-control" name="designation"></textarea></div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								
								
								
								<div class="form-group"><label class="col-sm-2 control-label">Marque</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="marque">									
										<?php
											$con = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
											mysql_select_db("gestionpannes", $con) or die('Could not select database.');

											$sql = "SELECT * FROM `marque`";

											$service = mysql_query($sql) or die(mysql_error()); //note: use mysql_error() for development only

											echo '<option value="marque" selected hidden >Choisir La Marque</option> ';
											
											while($row = mysql_fetch_assoc($service)) {
											 echo '<option   value="'.$row['ID_MARQUE'].'">'.$row['LABELLE_MARQUE'].'</option>';
											 }
										?>
                                    </select>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-2 control-label">Type</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="type">									
										<?php
											$con = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
											mysql_select_db("gestionpannes", $con) or die('Could not select database.');

											$sql = "SELECT * FROM `typemateriel`";

											$service = mysql_query($sql) or die(mysql_error()); //note: use mysql_error() for development only

											echo '<option value="type" selected hidden >Choisir Le Type</option> ';
											
											while($row = mysql_fetch_assoc($service)) {
											 echo '<option   value="'.$row['ID_TYPE'].'">'.$row['LABELLE_TYPE'].'</option>';
											 }
										?>
                                    </select>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-2 control-label">Fournisseur</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="fournisseur">									
										<?php
											$con = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
											mysql_select_db("gestionpannes", $con) or die('Could not select database.');

											$sql = "SELECT * FROM `fournisseur`";

											$service = mysql_query($sql) or die(mysql_error()); //note: use mysql_error() for development only

											echo '<option value="fournisseur" selected hidden >Choisir Le Fournisseur</option> ';
											
											while($row = mysql_fetch_assoc($service)) {
											 echo '<option   value="'.$row['ID_FOURNIS'].'">'.$row['NOM_FOURNIS'].'</option>';
											 }
										?>
                                    </select>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
																
								<div class="form-group" id="data_3" ><label class="col-sm-2 control-label">Date Achat</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date m-b"><span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input type="text" class="form-control" placeholder="Date Achat" name="dateAchat"></div>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group" id="data_3" ><label class="col-sm-2 control-label">Date Fin Garantie</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date m-b"><span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input type="text" class="form-control" placeholder="Date Fin Garantie" name="dateFinGarantie"></div>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group"><label class="col-sm-2 control-label">Service</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="service">									
										<?php
											$con = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
											mysql_select_db("gestionpannes", $con) or die('Could not select database.');

											$sql = "SELECT * FROM `service`";

											$service = mysql_query($sql) or die(mysql_error()); //note: use mysql_error() for development only

											echo '<option value="service" selected hidden >Choisir Le Service</option> ';
											
											while($row = mysql_fetch_assoc($service)) {
											 echo '<option   value="'.$row['ID_SERVICE'].'">'.$row['NOM_SERVICE'].'</option>';
											 }
										?>
                                    </select>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group" id="data_3" ><label class="col-sm-2 control-label">Date Mise en Service</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date m-b"><span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input type="text" class="form-control" placeholder="Date Mise en Service" name="dateMiseService"></div>
                                    </div>
                                </div>
								<div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-2 control-label">Matérielle en Location<br></label>

                                    <div class="col-sm-10">
                                        <div class="i-checks"><label class=""> <div class="iradio_square-green" style="position: relative;"><input type="radio" name="location" value="0" checked style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Non  </label></div>
										
                                        <div class="i-checks"><label class=""> <div class="iradio_square-green" style="position: relative;"><input type="radio" name="location" value="1"  style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Oui </label></div>
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
	
	<script>
	
		$(document).ready(function () {
			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
		});
		
		$('#data_3 .input-group.date').datepicker({
			startView: 2,
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			autoclose: true
        });
			
		$("#form").validate({
			 rules: {
				 password: {
					 required: true,
					 minlength: 3
				 },
				 url: {
					 required: true,
					 url: true
				 },
				 number: {
					 required: true,
					 number: true
				 },
				 min: {
					 required: true,
					 minlength: 6
				 },
				 max: {
					 required: true,
					 maxlength: 4
				 }
			 }
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