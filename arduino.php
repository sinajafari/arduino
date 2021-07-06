<?php
/*
 Proxy For ZeusTg Arduino library by Zeus
 Sisoog.com
*/
$data = json_decode(file_get_contents('php://input'), true);

if(!isset($_GET['bot']) || !isset($_GET['api']))
    die('<center><h1>ZTg Proxy by sisoog.com</h1></center>');


$requrl = "https://api.telegram.org/" . $_GET['bot'] . "/" . $_GET['api'];

$data_string = json_encode($data);

//Setup cURL
$ch = curl_init();

//The site we'll be sending the POST data to.
curl_setopt($ch, CURLOPT_URL, $requrl);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our POST data.
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string );

//Tell cURL that we want to receive the response that the site
//gives us after it receives our request.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);      

//Finally, send the request.
$response = curl_exec($ch);

//Close the cURL session
curl_close($ch);

//Do whatever you want to do with the output.
echo $response;