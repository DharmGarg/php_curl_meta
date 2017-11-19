<?php

//Entered URL is stored in name1 variable
$name1=$_GET["name"];      

//Function to get the contents of URL    
function file_get_contents_curl($url)     
{
	
	//To initialize the CURL request
    $ch = curl_init();          
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$html = file_get_contents_curl($name1);

/*parsing begins here:
To create an object of DOMDocument*/
$doc = new DOMDocument();       
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;
$metas = $doc->getElementsByTagName('meta');
for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
}

//To print the title, description and keywords of the URL
echo "Title: $title". '<br/><br/>';
echo "Description: $description". '<br/><br/>';
echo "Keywords: $keywords". '<br/><br/>';

$regex='|<a.*?href="(.*?)"|';
preg_match_all($regex,$html,$parts);
$links=$parts[1];
	
//checks for each links as link
foreach($links as $link){
echo "Internal and External Links".": ". $link."<br>";
}

//Refer to url2.php to get other attributes of URL	
include("url2.php");
?>