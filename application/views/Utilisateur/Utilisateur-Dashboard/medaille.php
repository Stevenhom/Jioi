
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
                <br>
                <br>
        <div class="col-lg-8">

        <table>
              <tr>
                  <th>Classement</th>
                  <th>Pays</th>
                  <th>Or</th>
                  <th>Argent</th>
                  <th>Bronze</th>
                  <th>Total</th>
              </tr>
              <?php for ($i = 0; $i < sizeof($datas); $i++) { ?>
                  <tr>
                      <td><?php echo $i + 1 ?></td>
                      <td><?php echo $datas[$i]['pays']; ?></td>
                      <td><span class="gold-medal"><?php echo $datas[$i]['or_count']; ?></span></td>
                      <td><span class="silver-medal"><?php echo $datas[$i]['argent_count']; ?></span></td>
                      <td><span class="bronze-medal"><?php echo $datas[$i]['bronze_count']; ?></span></td>
                      <td><?php echo $datas[$i]['total_medailles']; ?></td>
                  </tr>
              <?php } ?>
          </table>

          <style>
              .gold-medal {
                  color: orange;
              }

              .silver-medal {
                  color: gray;
              }

              .bronze-medal {
                  color: #8B4513; /* Marron */
              }
          </style>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  