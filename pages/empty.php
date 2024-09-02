<?php

if(empty($_SESSION['session'])){
    include 'login.php';
    exit;
}

include __DIR__ . '/partial.php';

$config['partialBody'] = '<div class="col-md-12 grid-margin"><div class="d-flex justify-content-between align-items-center"><div><h4 class="font-weight-bold mb-0">RoyalUI Dashboard</h4></div></div></div>

<div class="col-md-12 grid-margin">asdasd</div>';
$config['partialScript'] = '';

$config['partial'] .= $config['partialHeader'];
$config['partial'] .= '</head><body><div class="container-scroller">';
$config['partial'] .= $config['partialNavbar'];
$config['partial'] .= '<div class="container-fluid page-body-wrapper">';
$config['partial'] .= $config['partialNavbar'].$config['partialSidebar'];
$config['partial'] .= '<div class="main-panel"><div class="content-wrapper"><div class="row">';
$config['partial'] .= $config['partialBody'];
$config['partial'] .= '</div></div></div>';
$config['partial'] .= '</div></div>';
$config['partial'] .= $config['partialScriptDefault'].$config['partialScript'];
$config['partial'] .= '</body></html>';

$cachedValue = $cache->get('page');

if ($cachedValue) {
    echo base64_decode($cachedValue);
} else {
    $cache->set('page', base64_encode($config['partial']), 600);
	echo $config['partial'];
}

?>