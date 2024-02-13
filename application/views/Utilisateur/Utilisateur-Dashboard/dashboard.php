
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Layouts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <!-- Ajoutez le formulaire pour le sélecteur de mois -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Dashboard</h5>

              <!-- Tableau Recette Form -->
              <table>
                  <tr>
                      <th>Discipline</th>
                      <th>Recette</th>
                      <th>Dépense</th>
                      <th>Différence</th>
                      <th></th>
                  </tr>
                  <?php  for ($i=0; $i < sizeof($datas); $i++) { ?>
                      <tr>
                          <td><?php echo $datas[$i]['discipline']; ?></td>
                          <td><?php echo $datas[$i]['recette']; ?></td>
                          <td><?php echo $datas[$i]['depense']; ?></td>
                          <td style="color: <?php echo ($datas[$i]['difference'] < 0) ? 'red' : 'green'; ?>">
                              <?php
                              if ($datas[$i]['difference'] < 0) {
                                  echo "(" . abs($datas[$i]['difference']) . ")";
                              } else {
                                  echo $datas[$i]['difference'];
                              }
                              ?>
                          </td>
                          <td> Ar</td>
                      </tr>
                  <?php }  ?> 
              </table>
              
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  