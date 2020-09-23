<?php


$url = 'http://localhost:8000/signup?name=Daniel&age=36';
 
//Use file_get_contents to GET the URL in question.
$contents = file_get_contents($url);
 
//If $contents is not a boolean FALSE value.
if($contents !== false){
    //Print out the contents.
    echo $contents;
}






?>