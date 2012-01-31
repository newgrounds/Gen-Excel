<?php

// load library
require 'php-excel/php-excel.class.php';

// get the database information
$username="";
$password="";
// this is the name of the database
$database="";

// connect to database and get values for array
// change LOCATION to the IP of the database
mysql_connect("LOCATION",$username,$password);
@mysql_select_db($database) or die( "Unable to select database.");

// change TABLENAME
$query="SELECT * FROM TABLENAME";
$result=mysql_query($query);
$num=mysql_numrows($result);

$data = array(
		// CHANGE THE CATEGORIES -- this is an example for a sign up form
        1 => array ('Firstname', 'Lastname', 'Street', 'City', 'State', 'Zip', 'Email', 'How You Heard', 'Code', 'Verified', '# of Downloads'),
		array()
		);

$i=0;
while ($i < $num) {
	$data[] = array(
		// CHANGE THE CATEGORIES
		mysql_result($result,$i,"firstname"),
        mysql_result($result,$i,"lastname"),
		mysql_result($result,$i,"street"),
		mysql_result($result,$i,"city"),
		mysql_result($result,$i,"state"),
		mysql_result($result,$i,"zip"),
		mysql_result($result,$i,"email"),
		mysql_result($result,$i,"hear"),
		mysql_result($result,$i,"code"),
		mysql_result($result,$i,"verified"),
		mysql_result($result,$i,"downloads"));
	$i++;
}

mysql_close();

// generate file (constructor parameters are optional)
$xls = new Excel_XML('UTF-8', false, 'TABLETITLE');
$xls->addArray($data);
$xls->generateXML('FILETITLE');

?>