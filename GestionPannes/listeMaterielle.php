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

    <title>Matériel | Liste Matérielles</title>

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
                            <a>Matérielle</a>
                        </li>
                        <li class="active">
                            <strong>Liste Matérielle</strong>
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
								if(isset($_GET['supp']))
								{
									$nombre = $_GET['supp'];
									if($nombre == "true")
									{
									 echo '
									 <div class="alert alert-success fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Success!</strong> Matériel supprimé avec succes.
									</div>';
									}
									
									else if($nombre == "false")
									{
										echo '
									 <div class="alert alert-warning fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>ََAttention!</strong> Matériel non supprimé.
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

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Numéro de Série</th>
                                    <th data-hide="phone">Type Matérielle</th>
                                    <th data-hide="all">Désignation</th>
                                    <th data-hide="phone">Marque</th>
                                    <th data-hide="phone">Location</th>
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

										$materielle = mysqli_query($con,"SELECT * FROM materielle");

										while($row = mysqli_fetch_array($materielle))
										{
											echo "<tr>";
											echo "<td>" . $row['NUM_SERIE_MATER']."</td>";
											
											/*Recuperer le type du materielle*/
											$type = mysqli_query($con,"SELECT * FROM `typemateriel` WHERE `ID_TYPE`=".$row['ID_TYPE']."");
											
											$row2 = mysqli_fetch_assoc($type);
											echo "<td>" .$row2['LABELLE_TYPE']."</td>";
											
											echo "<td>" . $row['DESIGNATION_MATER']."</td>";
											
											/*Recuperer la marque*/
											$marque = mysqli_query($con,"SELECT * FROM `marque` WHERE `ID_MARQUE`=".$row['ID_MARQUE']."");
											
											$row3 = mysqli_fetch_assoc($marque);
											echo "<td>" .$row3['LABELLE_MARQUE']."</td>";

											/*Recuperer le statut du materielle*/
											
											if($row['LOCATION'] == '1')
												echo "<td><span class='label label-primary'>Oui</span></td>";
											if($row['LOCATION'] == '0')
												echo "<td><span class='label label-danger'>Non</span></td>";
											/*if($row['LOCATION'] == 'F')
												echo "<td><span class='label label-warning'>Chef Projet</span></td>";*/
											
											echo "<td class='text-right'>
													<div class='btn-group'>
														<span class='btn-white btn btn-xs'><a href='detailsMaterielle.php?mater=".$row['ID_MATER']."'>Plus infos</a></span>
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