<?php
/*Supprimer un materielle*/
if(isset($_GET['supp']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"DELETE FROM `materielle` WHERE `ID_MATER`=".$_GET['supp']."");
	
	header('Location: listeMaterielle.php?supp=true');
}

/*Traitements pour types*/
else if(isset($_GET['suppType']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"DELETE FROM `typemateriel` WHERE `ID_TYPE`=".$_GET['suppType']."");
	
	header('Location: ajouterType.php?supp=true');
}

else if(isset($_POST['modifierType']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"UPDATE `typemateriel` SET LABELLE_TYPE='".$_POST['labelType']."' WHERE ID_TYPE=".$_POST['idType']."");
	
	header('Location: ajouterType.php?modif=true');
}

/*Traitements pour marques*/
else if(isset($_GET['suppMarque']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"DELETE FROM `marque` WHERE `ID_MARQUE`=".$_GET['suppMarque']."");
	
	header('Location: ajouterMarque.php?supp=true');
}

else if(isset($_POST['modifierMarque']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"UPDATE `marque` SET LABELLE_MARQUE='".$_POST['labelMarque']."' WHERE ID_MARQUE=".$_POST['idMarque']."");
	
	header('Location: ajouterMarque.php?modif=true');
}


/*Traitements pour services*/
else if(isset($_GET['suppService']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"DELETE FROM `service` WHERE `ID_SERVICE`=".$_GET['suppService']."");
	
	header('Location: ajouterService.php?supp=true');
}

else if(isset($_POST['modifierService']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"UPDATE `service` SET NOM_SERVICE='".$_POST['nomService']."', CODE_SERVICE='".$_POST['codeService']."' WHERE ID_SERVICE=".$_POST['idService']."");
	
	header('Location: ajouterService.php?modif=true');
}

/*Traitements pour fournisseur*/
else if(isset($_GET['suppFournis']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"DELETE FROM `fournisseur` WHERE `ID_FOURNIS`=".$_GET['suppFournis']."");
	
	header('Location: ajouterFournisseur.php?supp=true');
}

else if(isset($_POST['modifierFournisseur']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"UPDATE `fournisseur` SET NOM_FOURNIS='".$_POST['nomFourniss']."', ADRESSE_FOURNIS='".$_POST['adresseFourniss']."' , EMAIL_FOURNIS='".$_POST['mailFourniss']."' , TELE_FOURNIS='".$_POST['teleFourniss']."' WHERE ID_FOURNIS=".$_POST['idFournis']."");
	
	header('Location: ajouterFournisseur.php?modif=true');
}

/*Traitements pour demande*/
else if(isset($_GET['fixerDemande']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"UPDATE `demande` SET ETAT_DEMANDE=1 WHERE ID_DEMANDE=".$_GET['fixerDemande']."");
	
	header('Location: demande.php?modif=true');
}

/*Traitements pour compte (confirmer)*/
else if(isset($_GET['compte']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"UPDATE `utilisateur` SET CONFIRM_UTILIS=1 WHERE MATRICULE_UTILIS='".$_GET['compte']."'");
	
	header('Location: demandesCompte.php?modif=true');
}

/*Traitements pour compte (blocker)*/
else if(isset($_GET['compteBlock']))
{
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"UPDATE `utilisateur` SET CONFIRM_UTILIS=0 WHERE MATRICULE_UTILIS='".$_GET['compteBlock']."'");
	
	header('Location: demandesCompte.php?block=true');
}

/*Si non*/
else
	header('Location: login.php');
?>