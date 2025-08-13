<?php

$color = isset($color) ? $color : '#000';
$vSize = isset($size) ? intval($size) : 12;

?>

<svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $vSize; ?>" height="<?php echo $vSize; ?>" viewBox="0 0 <?php echo $vSize; ?> <?php echo $vSize; ?>" class="circular-chart">
    <path class="circle-bg"
          stroke-width="1"
          fill="<?php echo $color; ?>"
          d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z"/>
    <path fill="<?php echo $color; ?>" d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z"/>
</svg>


