
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

      <div class="col-lg-10">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Calendrier</h5>

              <!-- Horizontal Form -->
              <form  class="row g-3" method="post" action="<?php echo site_url("Front-Office/Calendrier_Controller/calendrier_trait");?>" enctype="multipart/form-data">
                  
                        <div class="row mb-3">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Date</label>
                          <div class="col-sm-10">
                            <input type="datetime-local" name="date_heure" required>
                          </div>
                        </div>


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

                  <div>
                  <tr>
                      <td>Site<select name="site">
                          <option value="">...</option>
                          <?php  for ($i=0; $i < sizeof($site); $i++) { ?>  
                          <option value="<?php echo $site[$i]['id_site']; ?>"><?php echo $site[$i]['nom']; ?></option>
                          <?php }  ?> 
                        </select>    
                      </td>
                    </tr>
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

              <div class="col-lg-12">

                <table>
                        <tr>
                          <th>Date</th>
                          <th>Site</th>
                          <th>Discipline</th>

                        </tr>
                        <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
                        <tr>
                          <td><?php echo $datas[$i]['daty']; ?></td>
                          <td><?php echo $datas[$i]['site_nom']; ?></td>
                          <td><?php echo $datas[$i]['discipline_nom']; ?></td>
                        
                        
                      </tr>
                        <?php }  ?> 
                  </table>

              </div>
            </div>
    </section>

  </main><!-- End #main -->

  