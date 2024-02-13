
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Modification</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Formulaire</li>
          <li class="breadcrumb-item active">Modification</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Modifie contenu</h5>
              <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
              <!-- Floating Labels Form -->
              <form class="row g-3" method="post" action="<?php echo site_url('Back-Office/Pays_Controller/form_trait_update?id_pays=' . $datas[$i]['id_pays']); ?>" style="cursor:pointer;" enctype="multipart/form-data">
              
              <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="inputText" value="<?php echo $datas[$i]['nom'] ?>" required>
                    </div>
                  </div>
                  
                <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <center><?php echo $this->session->flashdata('success'); ?></center>
                        </div>
                    <?php } ?>

                <div class="text-center">
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->
              <?php } ?>    
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  