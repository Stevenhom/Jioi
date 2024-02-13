
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
        <div>
          <form method="post" action="<?php echo site_url('Welcome/calendrier_search'); ?>" style="display: flex; align-items: center;">
              <label>Date:</label>
              <input type="date" name="daty" style="margin-right: 10px;">
              
              <label>Discipline:</label>
              <select name="discipline" style="margin-right: 10px;">
                  <option value="">...</option>
                  <?php for ($i = 0; $i < sizeof($discipline); $i++) { ?>  
                      <option value="<?php echo $discipline[$i]['id_disciplines']; ?>"><?php echo $discipline[$i]['nom']; ?></option>
                  <?php } ?> 
              </select>
              
              <button type="submit">Valider</button>
          </form>
        </div>
                <br>
                <br>
        <div class="col-lg-8">

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

  