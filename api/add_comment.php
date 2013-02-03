<?php

$raw_request = file_get_contents('php://input');
$params      = json_decode($raw_request, true);

$errors = array();
if (!@$params['comment']['sample_id']) {
  $errors['sample_id'] = "No sample id given";
}

if ($errors) {
    $json = json_encode($errors);
    header("Status: 400", true, 400);
    header("ContentType: application/json");
    header("Accept: application/json");
    echo $json;   
    exit;
}


$sample_id = $params['comment']['sample_id'];
$comment= array(
    'author'       => $params['comment']['author'],
    'created_at'   => date("Y-m-d H:i:s"),
    'body'         => $params['comment']['body']
);


// save to mongo
$m   = new Mongo();
$db  = $m->hackathon;
$col = $db->samples;
$id = new MongoId($sample_id);
$col->update(array("_id" => $id), array('$push' => array(
    'conversation' => $comment
)));


// the response 
$json = json_encode($comment);
header("ContentType: application/json");
header("Accept: application/json");
echo $json;