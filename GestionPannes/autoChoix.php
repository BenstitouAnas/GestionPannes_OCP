<?php



$con = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
mysql_select_db("gestionpannes", $con) or die('Could not select database.');

if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysql_query("SELECT * FROM materielle WHERE ID_SERVICE='".$id."'");
while($row=mysql_fetch_array($sql))
{
	$marque=mysql_query("SELECT * FROM marque WHERE ID_MARQUE='".$row['ID_MARQUE']."'");
	$marq=mysql_fetch_array($marque);
	
	$type=mysql_query("SELECT * FROM typemateriel WHERE ID_TYPE='".$row['ID_TYPE']."'");
	$typ=mysql_fetch_array($type);
	
$id=$row['ID_MATER'];
$data=$row['NUM_SERIE_MATER'];
$typp='typp';
$marqq='LABELLE_MARQUE';


//echo '<option value="'.$id.'">'.$data." (".$typp.' - '.$marqq.")'</option>';

echo '<option value="'.$id.'">'.$data.' ('.$typ['LABELLE_TYPE'].' - '.$marq['LABELLE_MARQUE'].')</option>';
}
}
?>