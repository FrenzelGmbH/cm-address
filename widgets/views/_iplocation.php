<?php

use yii\helpers\Html;
use kartik\icons\Icon;

$center = new dosamigos\leaflet\types\LatLng(['lat' => $latitude-0.0001, 'lng' => $longitude-0.0001]);
$iplocation = new dosamigos\leaflet\types\LatLng(['lat' => $latitude, 'lng' => $longitude]);

$layer = new dosamigos\leaflet\layers\TileLayer([
     //'urlTemplate' => 'http://{s}.tile.cloudmade.com/c78ff4e5762545188f82a9a4cd552d54/997/256/{z}/{x}/{y}.png',
     'urlTemplate' => 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
     'map' => 'BlogMap'.str_replace('.', '', $latitude),
     'clientOptions' =>[
        'attribution' => 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
     ]
]);

$leafLet = new dosamigos\leaflet\LeafLet([
  'center' => $center,
  'zoom' => $options['zoom'],
  'TileLayer' => $layer,
  'name' => 'BlogMap'.str_replace('.', '', $latitude)
]);

// Initialize plugin
$makimarkers = new dosamigos\leaflet\plugins\makimarker\MakiMarker(['name' => 'makimarker']);
$leafLet->installPlugin($makimarkers);

// generate icon through its icon
$marker = new dosamigos\leaflet\layers\Marker([
  'latLng' => $iplocation,
  'icon' => $leafLet->plugins->makimarker->make("pitch",['color' => "#b0b", 'size' => "m"]),
  'popupContent' => 'IP Location'
]);

$leafLet->addLayer($marker);

echo dosamigos\leaflet\widgets\Map::widget([
  'leafLet' => $leafLet,
  'height'  => $options['height']
]);

?>
