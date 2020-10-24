<?php
$pageName = basename($_SERVER['PHP_SELF']);
if($pageName == "index.php")
	{
	echo "Admin : Masjid Suffah";
	}
if($pageName == "salattimes.php")
	{
	echo "Salat Times";
	}	
if($pageName == "gallery.php")
	{
	echo "Gallery";
	}	
if($pageName == "news.php")
	{
	echo "News";
	}
?>