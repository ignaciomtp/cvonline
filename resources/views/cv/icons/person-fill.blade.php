<?php

$color = isset($color) ? $color : '#000';
$vSize = isset($size) ? intval($size) : 12;

?>

<svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $vSize; ?>" height="<?php echo $vSize; ?>" viewBox="0 0 <?php echo $vSize; ?> <?php echo $vSize; ?>" class="circular-chart">
    <path class="circle-bg"
          stroke-width="1"
          fill="<?php echo $color; ?>"
          d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
    
</svg>

