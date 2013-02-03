<?php


$raw_request = file_get_contents('php://input');
$params      = json_decode($raw_request, true);

$errors = array();
if (!@$params['collection']['vendor']) {
  $errors['vendor'] = "You must specify a vendor";
}

if ($errors) {
    $json = json_encode($errors);
    header("Status: 400", true, 400);
    header("ContentType: application/json");
    header("Accept: application/json");
    echo $json;   
    exit;
}


$collection = array(
    'name'          => $params['collection']['name'],
    'description'   => $params['collection']['name'],
    'vendor'        => $params['collection']['vendor']
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