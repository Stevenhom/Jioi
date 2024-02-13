
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Gestion</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
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
              <h5 class="card-title">Résultat collectif</h5>

                <!-- Horizontal Form -->
                <form  class="row g-3" method="post" action="<?php echo site_url("Front-Office/Resultat_Controller/resultat_trait");?>" enctype="multipart/form-data">

                    <div>
                    <tr>
                        <td>Discipline<select name="discipline">
                            <option value="">...</option>
                            <?php  for ($i=0; $i < sizeof($discipline); $i++) { ?>  
                            <option value="<?php echo $discipline[$i]['id_disciplines']; ?>"><?php echo $discipline[$i]['nom']; ?></option>
                            <?php }  ?> 
                          </select>    
                        </td>
                      </tr>
                    </div>

                    <div >
                    <tr>
                        <td>Pays<select name="pays">
                            <option value="">...</option>
                            <?php  for ($i=0; $i < sizeof($pays); $i++) { ?>  
                            <option value="<?php echo $pays[$i]['id_pays']; ?>"><?php echo $pays[$i]['nom']; ?></option>
                            <?php }  ?> 
                          </select>    
                        </td>
                      </tr>
                    </div>

                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Rang</label>
                      <div class="col-sm-3">
                        <input type="number" name="rang" class="form-control" min='1' max='7' required>
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

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Résultat individuel</h5>

                <!-- Horizontal Form -->
                <form  class="row g-3" method="post" action="<?php echo site_url("Front-Office/Resultat_Controller/resultat_trait2");?>" enctype="multipart/form-data">

                    <div >
                    <tr>
                        <td>Athlete<select name="athlete">
                            <option value="">...</option>
                            <?php  for ($i=0; $i < sizeof($discipline2); $i++) { ?>  
                            <option value="<?php echo $discipline2[$i]['id_athletes']; ?>"><?php echo $discipline2[$i]['nom']; ?> (<?php echo $discipline2[$i]['discipline']; ?>)</option>
                            <?php }  ?> 
                          </select>    
                        </td>
                      </tr>
                    </div>

                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Rang</label>
                      <div class="col-sm-3">
                        <input type="number" name="rang" class="form-control" min='1' max='7' required>
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

        <div class="col-lg-6">

          <table>
                  <tr>
                    <th>Discipline</th>
                    <th>Pays</th>
                    <th>Rang</th>
                    <th>Médaille</th>
                  </tr>
                  <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
                  <tr>
                    <td><?php echo $datas[$i]['discipline_nom']; ?></td>
                    <td><?php echo $datas[$i]['pays_nom']; ?></td>
                    <td><?php echo $datas[$i]['rang']; ?></td>
                    <td><?php echo $datas[$i]['medaille']; ?></td>
                </tr>
                  <?php }  ?> 
            </table>

          </div>
      </div>
    </section>

  </main><!-- End #main -->

  