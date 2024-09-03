<?php

$config['partialHeader'] = '<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- plugins:css -->
  <link rel="stylesheet" href="'.$config['assets'].'css/materialdesignicons.min.css">
  <link rel="stylesheet" href="'.$config['assets'].'vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="'.$config['assets'].'css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="'.$config['assets'].'images/favicon.png" />';
$config['partialNavbar'] = '<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo me-5" href="index.html"><img src="'.$config['assets'].'images/logo.svg" class="me-2" alt="logo"/></a>
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="'.$config['assets'].'images/logo-mini.svg" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-format-list-bulleted"></span>
    </button>
    
    <ul class="navbar-nav navbar-nav-right">
        '.( isset($_SESSION['mid']) ? '<li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown"><img src="'.$member['avatar'].'" alt="'.$member['mid'].'"/></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="'.$config['url'].'settings"><i class="mdi mdi-cog"></i>'.$lang['settings'].'</a>
                <a class="dropdown-item" href="'.$config['url'].'logout"><i class="mdi mdi-logout"></i>'.$lang['logout'].'</a>
            </div>
        </li>' : '').'
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"><span class="ti-view-list"></span></button>
    </div>
</nav>';
$config['partialSidebar'] = '<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!--
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="ti-palette menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="'.$config['url'].'"><i class="mdi mdi-logout"></i><span class="menu-title">'.$lang['logout'].'</span></a></li>
        -->
        <li class="nav-item"><a class="nav-link" href="'.$config['url'].'"><i class="mdi mdi-home"></i><span class="menu-title">'.$lang['home'].'</span></a></li>
        <li class="nav-item"><a class="nav-link" href="'.$config['url'].'settings"><i class="mdi mdi-cog"></i><span class="menu-title">'.$lang['settings'].'</span></a></li>
        <li class="nav-item"><a class="nav-link" href="'.$config['url'].'logout"><i class="mdi mdi-logout"></i><span class="menu-title">'.$lang['logout'].'</span></a></li>
    </ul>
</nav>';
$config['partialBody'] = '';
$config['partialScriptDefault'] = '<!-- plugins:js -->
<script src="'.$config['assets'].'vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="'.$config['assets'].'js/off-canvas.js"></script>
<script src="'.$config['assets'].'js/hoverable-collapse.js"></script>
<script src="'.$config['assets'].'js/template.js"></script>
<!-- endinject -->';
$config['partialScript'] = '';

?>