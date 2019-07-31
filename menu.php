<!--          _    _ _______ ____  _____         __  __          _____ _______ _____ _   _        _____ _    _ _      ______ ____   ______      ________ _____ -->
<!--     /\  | |  | |__   __/ __ \|  __ \ _     |  \/  |   /\   |  __ \__   __|_   _| \ | |      / ____| |  | | |    |  ____|  _ \ / __ \ \    / /  ____/ ____|-->
<!--    /  \ | |  | |  | | | |  | | |__) (_)    | \  / |  /  \  | |__) | | |    | | |  \| |     | |    | |__| | |    | |__  | |_) | |  | \ \  / /| |__ | |     -->
<!--   / /\ \| |  | |  | | | |  | |  _  /       | |\/| | / /\ \ |  _  /  | |    | | | . ` |     | |    |  __  | |    |  __| |  _ <| |  | |\ \/ / |  __|| |     -->
<!--  / ____ \ |__| |  | | | |__| | | \ \ _     | |  | |/ ____ \| | \ \  | |   _| |_| |\  |     | |____| |  | | |____| |____| |_) | |__| | \  /  | |___| |____ -->
<!-- /_/    \_\____/   |_|  \____/|_|  \_(_)    |_|  |_/_/    \_\_|  \_\ |_|  |_____|_| \_|      \_____|_|  |_|______|______|____/ \____/   \/   |______\_____|-->                                                                                                                                                                                                                                                                                                              
<ul class="navbar-nav ml-auto">
            
            <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px;">
      Správa prístupov
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item nav-item <?php if($stranka=="Index"){ echo 'active';}?>" href="index.php">Prehľad</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Pridat"){ echo 'active';}?>" href="pridat.php">Pridať kartu</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Odobrat"){ echo 'active';}?>" href="odobrat.php">Odstrániť kartu</a>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px;">
      Hardvér a softvér
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item nav-item <?php if($stranka=="Program"){ echo 'active';}?>" href="program.php">Program</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Zapojenie"){ echo 'active';}?>" href="zapojenie.php">Zapojenie</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Licencia"){ echo 'active';}?>" href="licencia.php">Licencia</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Informacie"){ echo 'active';}?>" href="informacie.php">Informácie</a>
    </div>
  </div>
   <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px;">
      Zamestnanci
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item nav-item <?php if($stranka=="Evidencia"){ echo 'active';}?>" href="evidencia.php">Evidencia</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Reporty"){ echo 'active';}?>" href="reporty.php">Reporty</a>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px;">
      RFID vrátnik
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item nav-item <?php if($stranka=="Stats"){ echo 'active';}?>" href="statistika.php">Štatistika</a>
      <a class="dropdown-item nav-item <?php if($stranka=="Nastavenia"){ echo 'active';}?>" href="nastavenia.php">Nastavenia</a>
    </div>
  </div>
             <li class="nav-item" id="right">
            <a href="https://www.paypal.me/chlebovec" class="btn btn-success" role="button" style="border-radius: 25px;"><img src="https://image.flaticon.com/icons/svg/888/888870.svg" width=32px height=32px>Podpora</a>
            </li>
          </ul>
