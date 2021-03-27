<?php
$img = Image::make(file_get_contents('http://1.bp.blogspot.com/-Ctv1m-63Q7Q/TozUCb70gQI/AAAAAAAAAfw/UQk-nUN3NHM/s1600/beautiful+nature+scenery-1.jpg' ));
$img->encode('png');
$type = 'png';
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
?>
<img src="{!! $base64 !!}">
