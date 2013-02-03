<?php


$raw_request = file_get_contents('php://input');
$params      = json_decode($raw_request, true);

$collection = array(
    'name' => $params['collection']['name']
);

// save to mongo
$m   = new Mongo();
$db  = $m->hackathon;
$col = $db->collections;
$col->insert($collection);


// the response 
$json = json_encode($collection);
header("ContentType: application/json");
header("Accept: application/json");
echo $json;