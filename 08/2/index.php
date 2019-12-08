<?php

declare(strict_types=1);

require_once 'SpaceImageDecoder.php';
require_once 'ImageLayer.php';

//const PROVIDED_WIDTH = 2;
//const PROVIDED_HEIGHT = 2;
const PROVIDED_WIDTH = 25;
const PROVIDED_HEIGHT = 6;

$line = str_split('0222112222120000');
$line = str_split(trim(file_get_contents('input')));
$values = array_map('intval', $line);

$decoder = new SpaceImageDecoder($values, PROVIDED_WIDTH, PROVIDED_HEIGHT);
$image = $decoder->process();

$gd = imagecreatetruecolor(PROVIDED_WIDTH, PROVIDED_HEIGHT);
$white = imagecolorallocate($gd, 255, 255, 255);
$black = imagecolorallocate($gd, 0, 0, 0);

foreach ($image as $y => $row) {
    foreach ($row as $x => $value) {
        echo $value === 0 ? '█' : ' ';
        imagesetpixel($gd, $x, $y, $value === 0 ? $black : $white);
    }
    echo PHP_EOL;
}

imagepng($gd, 'image.png');
