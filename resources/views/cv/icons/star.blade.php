<?php

$color = isset($color) ? $color : '#000';
$vSize = isset($size) ? intval($size) : 12;


?>

<img src="{{ URL::asset('storage/icons/star.png') }}" width="{{ $vSize }}" height="{{ $vSize }}"   />
