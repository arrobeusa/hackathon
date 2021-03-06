<?php

$raw_request = file_get_contents('php://input');
$params      = json_decode($raw_request, true);

$errors = array();
if (!@$params['sample']['collection_id']) {
  $errors['collection_id'] = "No collection id given";
}

if ($errors) {
    $json = json_encode($errors);
    header("Status: 400", true, 400);
    header("ContentType: application/json");
    header("Accept: application/json");
    echo $json;   
    exit;
}


$sample = array(
    'name'          => $params['sample']['name'],
    'description'   => $params['sample']['name'],
    'collection_id' => $params['sample']['collection_id']
);


// save to mongo
$m   = new Mongo();
$db  = $m->hackathon;
$col = $db->samples;
$col->insert($sample);


// the response 
$json = json_encode($sample);
header("ContentType: application/json");
header("Accept: application/json");
echo $json;