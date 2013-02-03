<?php

$m   = new Mongo();
$db  = $m->hackathon;
$col = $db->samples;

$sample = array('name' => 'my first sample');

$col->insert($sample);