<?php

$color = isset($color) ? $color : '#000';
$vSize = isset($size) ? intval($size) : 12;

$svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 '.$vSize.' '.$vSize.'" class="circular-chart">
    <path class="circle-bg"
          stroke-width="1"
          fill="'.$color.'"
          d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"
          />
</svg>';

$html = '<img src="data:image/svg+xml;base64,'.base64_encode($svg).'" width="'.$vSize.'" height="'.$vSize.'"  />';

echo $html;

?>
