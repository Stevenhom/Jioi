
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Gestion</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Layouts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Site</h5>

              <!-- Horizontal Form -->
              <form  class="row g-3" method="post" action="<?php echo site_url("Back-Office/Site_Controller/site_trait");?>" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-7">
                      <input type="text" name="name" class="form-control" id="inputText" required>
                    </div>
                  </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Valider</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <center><?php echo $this->session->flashdata('success'); ?></center>
                        </div>
                    <?php } ?>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

        </div>

        <div class="col-lg-10" >

          <table>
                  <tr>
                    <th>Nom</th>
                  </tr>
                  <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
                  <tr>
                    <td><?php echo $datas[$i]['nom']; ?></td>
                    <td><a href="<?php echo site_url('Back-Office/Site_Controller/update?id_site=' . $datas[$i]['id_site']); ?>" style="cursor:pointer">modifier</a></td>
                    <td><a href="<?php echo site_url('Back-Office/Site_Controller/delete?id_site=' . $datas[$i]['id_site']); ?>" style="cursor:pointer">supprimer</a></td>
                </tr>
                  <?php }  ?> 
            </table>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  