<?php 

//Entered URL is stored in name2 variable
$name2=$_GET["name"];

//To initialize the CURL request for URL
$ch = curl_init($name2); 

//To get the information about the URL:
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch); 
if(!curl_errno($ch)) 
{ 
 $cinfo = curl_getinfo($ch); 
 echo "<pre>";
 print_r($cinfo);
 echo 'Page loaded in '.$cinfo['total_time'].' seconds'; 
}

//to close the CURL request 
curl_close($ch); 
?>