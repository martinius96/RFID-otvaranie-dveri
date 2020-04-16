<ul class="navbar-nav ml-auto">
            
            <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px; background-color: #D35400;">
      Správa prístupov
    </button>
    <div class="dropdown-menu" style="background-color: #C0392B;">
      <a class="dropdown-item nav-item <?php if($stranka=="Index"){ echo 'active';}?>" href="index.php">Prehľad</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Pridat"){ echo 'active';}?>" href="pridat.php">Pridať kartu</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Odobrat"){ echo 'active';}?>" href="odobrat.php">Odstrániť kartu</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Historia"){ echo 'active';}?>" href="historia.php">História</a>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px; background-color: #D35400;">
      Hardvér a softvér
    </button>
    <div class="dropdown-menu" style="background-color: #C0392B;">
      <a class="dropdown-item nav-item <?php if($stranka=="Program"){ echo 'active';}?>" href="program.php">Program</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Zapojenie"){ echo 'active';}?>" href="zapojenie.php">Zapojenie</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Licencia"){ echo 'active';}?>" href="licencia.php">Licencia</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Informacie"){ echo 'active';}?>" href="informacie.php">Informácie</a>
    </div>
  </div>
   <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px; background-color: #D35400;">Zamestnanci</button>
    <div class="dropdown-menu" style="background-color: #C0392B;">
      <a class="dropdown-item nav-item <?php if($stranka=="Evidencia"){ echo 'active';}?>" href="evidencia.php">Evidencia</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Detail"){ echo 'active';}?>" href="detail.php">Detail zamestnanca</a>
    </div>
  </div>
  <div class="dropdown">                                                                                          
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px; background-color: #D35400;">
      RFID vrátnik
    </button>
    <div class="dropdown-menu" style="background-color: #C0392B;">
      <a class="dropdown-item nav-item <?php if($stranka=="Stats"){ echo 'active';}?>" href="statistika.php">Štatistika</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Nastavenia"){ echo 'active';}?>" href="nastavenia.php">Nastavenia</a>
    </div>
  </div>
    <li class="nav-item" id="right">
            <a href="https://www.paypal.me/chlebovec" class="btn btn-success" role="button" style="border-radius: 25px;"><img src="https://image.flaticon.com/icons/svg/888/888870.svg" width=32px height=32px>Podpora</a>
            </li>
          </ul>
