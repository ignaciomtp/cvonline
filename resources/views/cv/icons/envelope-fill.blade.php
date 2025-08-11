<?php

$color = isset($color) ? $color : '#000';
$vSize = isset($size) ? intval($size) : 12;


$svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 '.$vSize.' '.$vSize.'" class="circular-chart">
    <path class="circle-bg"
          stroke-width="1"
          fill="'.$color.'"
          d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"
          />
</svg>';

$html = '<img src="data:image/svg+xml;base64,'.base64_encode($svg).'" width="'.($vSize + 10).'" height="'.$vSize.'" />';

echo $html;

?>
