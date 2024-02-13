<?php
  $user_id = $this->session->userdata('user_id');
  $email = $this->session->userdata('email');
  $pass = $this->session->userdata('pass');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Evaluation-Utilisateur</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo site_url('assets/img/favicon.png'); ?>" rel="icon">
  <link href="<?php echo site_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet'); ?>">
  <link href="<?php echo site_url('assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet'); ?>">
  <link href="<?php echo site_url('assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet'); ?>">
  <link href="<?php echo site_url('assets/vendor/quill/quill.snow.css" rel="stylesheet'); ?>">
  <link href="<?php echo site_url('assets/vendor/quill/quill.bubble.css" rel="stylesheet'); ?>">
  <link href="<?php echo site_url('assets/vendor/remixicon/remixicon.css" rel="stylesheet'); ?>">
  <link href="<?php echo site_url('assets/vendor/simple-datatables/style.css" rel="stylesheet'); ?>">

  <!-- Template Main CSS File -->
  <link href="<?php echo site_url('assets/css/style.css" rel="stylesheet'); ?>">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

      <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?php echo site_url('assets/img/logo.png');?>" alt="">
        <span class="d-none d-lg-block">Jeux des îles de l'Océan Indien</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


  </header><!-- End Header -->