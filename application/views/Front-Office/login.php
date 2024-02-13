<?php
  	$this->load->helper('url');
    $this->load->helper('url_helper');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Authentification - Evaluation</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo site_url('assets/img/favicon.png');?>" rel="icon">
  <link href="<?php echo site_url('assets/img/apple-touch-icon.png');?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/bootstrap-icons/bootstrap-icons.css');?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/boxicons/css');?>/boxicons.min.css');?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/quill/quill.snow.css');?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/quill/quill.bubble.css');?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/remixicon/remixicon.css');?>" rel="stylesheet">
  <link href="<?php echo site_url('assets/vendor/simple-datatables/style.css');?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo site_url('assets/css/style.css');?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="" class="logo d-flex align-items-center w-auto">
                  <img src="<?php echo site_url('assets/img/logo.png');?>" alt="">
                  <span class="d-none d-lg-block">Cher Gestionnaire</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Connectez-vous</h5>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="<?php echo site_url('Front-Office/SController/authentification');?>" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="yourUsername" value="gestion@gestion" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
                      <input type="password" name="pass" class="form-control" id="yourPassword" value="654321" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    </br>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                    <center><div class="col-6">
                      <input class="btn btn-primary w-100" type="submit" value="Se connecter">
                    </div></center></br>
                    <div class="col-12">
                      <center><p class="small mb-0">Don't have account?</p></center>
                    </div>
                    </br>
                  </form>

                </div>
              </div>

              <center><div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
              </div></center>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>