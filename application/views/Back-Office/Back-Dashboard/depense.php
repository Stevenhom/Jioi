
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
              <h5 class="card-title">Ajout Catégorie</h5>

              <!-- Horizontal Form -->
              <form  class="row g-3" method="post" action="<?php echo site_url("Back-Office/Depense_Controller/depense_trait");?>" enctype="multipart/form-data">
                  
              <div>
                    <tr>
                      <td>Categorie<select name="type">
                          <option value="">...</option>
                          <?php  for ($i=0; $i < sizeof($categorie); $i++) { ?>  
                          <option value="<?php echo $categorie[$i]['id_type']; ?>"><?php echo $categorie[$i]['label']; ?></option>
                          <?php }  ?> 
                        </select>    
                      </td>
                    </tr>
                  </div>
              
              
              <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-7">
                      <input type="text" name="name" class="form-control" id="inputText" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-7">
                      <input type="text" name="code" maxlength='3' class="form-control" id="inputText" required>
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

          <div class="col-lg-10">
                  <BIG>Liste de Catégorie</BIG>
                  <table>
                          <tr>
                            <th>Type</th>
                            <th>Nom</th>
                            <th>Code</th>
                          </tr>
                          <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
                          <tr>
                            <td><?php echo $datas[$i]['type']; ?></td>
                            <td><?php echo $datas[$i]['nom']; ?></td>
                            <td><?php echo $datas[$i]['code']; ?></td>
                      
                        </tr>
                          <?php }  ?> 
                    </table>

                  </div>




        </div>


        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Effectuer mouvement</h5>

              <!-- Horizontal Form -->
              <form  class="row g-3" method="post" action="<?php echo site_url("Back-Office/Depense_Controller/depense_trait2");?>" enctype="multipart/form-data">
                  

                  <div>
                    <tr>
                      <td>Code<select name="code_categorie">
                          <option value="">...</option>
                          <?php  for ($i=0; $i < sizeof($categorie2); $i++) { ?>  
                          <option value="<?php echo $categorie2[$i]['id_categorie']; ?>"><?php echo $categorie2[$i]['code']; ?> (<?php echo $categorie2[$i]['nom']; ?>)</option>
                          <?php }  ?> 
                        </select>    
                      </td>
                    </tr>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Montant</label>
                    <div class="col-sm-7">
                      <input type="number" step="0.01" min='0'  name='montant' class="form-control" id="inputText" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                      <input type="date" name="daty" class="form-control" id="inputText" required>
                    </div>
                  </div>

                  <div>
                    <tr>
                      <td>Code Discipline<select name="code_disciplines">
                          <option value="">...</option>
                          <?php  for ($i=0; $i < sizeof($discipline); $i++) { ?>  
                          <option value="<?php echo $discipline[$i]['id_disciplines']; ?>"><?php echo $discipline[$i]['code']; ?> (<?php echo $discipline[$i]['nom']; ?>)</option>
                          <?php }  ?> 
                        </select>    
                      </td>
                    </tr>
                  </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Valider</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                <?php if ($this->session->flashdata('success2')) { ?>
                        <div class="alert alert-success">
                            <center><?php echo $this->session->flashdata('success2'); ?></center>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

          <div class="col-lg-10">
                  <BIG>Liste de Mouvement</BIG>
                  <table>
                          <tr>
                            <th>Type</th>
                            <th>Nom</th>
                            <th>Code catégorie</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Discipline</th>
                            <th>Code discipline</th>
                          </tr>
                          <?php  for ($i=0; $i < sizeof($datas2); $i++) { ?>
                          <tr>
                            <td><?php echo $datas2[$i]['type']; ?></td>
                            <td><?php echo $datas2[$i]['nom']; ?></td>
                            <td><?php echo $datas2[$i]['code_categorie']; ?></td>
                            <td><?php echo $datas2[$i]['montant']; ?> Ar</td>
                            <td><?php echo $datas2[$i]['daty']; ?></td>
                            <td><?php echo $datas2[$i]['discipline']; ?></td>
                            <td><?php echo $datas2[$i]['code_discipline']; ?></td>
                            
                        </tr>
                          <?php }  ?> 
                    </table>

                  </div>




        </div>

        
      </div>
      
    </section>

  </main><!-- End #main -->

  