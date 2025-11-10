<?php


$exif = exif_read_data('testeb.jpg', 'IFD0');

echo '<pre>';
print_r($exif);
echo '<pre>';
