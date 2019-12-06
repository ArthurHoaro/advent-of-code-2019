<?php

declare(strict_types=1);

require_once 'Tree.php';
require_once 'Node.php';

$lines = array_filter(explode(PHP_EOL, file_get_contents('demo')));
$lines = array_filter(explode(PHP_EOL, file_get_contents('input')));

$tree = new Tree();
foreach ($lines as $line) {
    list($mass, $orbiter) = explode(')', $line);

    $tree->pushNode($mass, $orbiter);
}

var_dump($tree->countAllDistances());
