  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?php echo site_url('Back-Office/SController/home');?>">
          <i class="bi bi-grid"></i>
          <span>Menu</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Assistance</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Pays_Controller/pays');?>">
              <i class="bi bi-circle"></i><span>Pays</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Discipline_Controller/discipline');?>">
              <i class="bi bi-circle"></i><span>Discipline</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Athletes_Controller/athletes');?>">
              <i class="bi bi-circle"></i><span>Athlète</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo site_url('Back-Office/Site_Controller/site');?>">
              <i class="bi bi-circle"></i><span>Site</span>
            </a>
          </li>
        </ul>


      </li><!-- End Forms Nav -->



      <li class="nav-item">


        <li class="nav-item">
          <a href="<?php echo site_url('Back-Office/Depense_Controller/depense');?>">
            <i class="bi bi-circle"></i><span>Catégorie</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo site_url('Back-Office/Import_Controller/import');?>">
            <i class="bi bi-circle"></i><span>Importation</span>
          </a>
        </li>


      </li><!-- End Forms Nav -->


    </ul>

  </aside><!-- End Sidebar-->