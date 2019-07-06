<!--          _    _ _______ ____  _____         __  __          _____ _______ _____ _   _        _____ _    _ _      ______ ____   ______      ________ _____ -->
<!--     /\  | |  | |__   __/ __ \|  __ \ _     |  \/  |   /\   |  __ \__   __|_   _| \ | |      / ____| |  | | |    |  ____|  _ \ / __ \ \    / /  ____/ ____|-->
<!--    /  \ | |  | |  | | | |  | | |__) (_)    | \  / |  /  \  | |__) | | |    | | |  \| |     | |    | |__| | |    | |__  | |_) | |  | \ \  / /| |__ | |     -->
<!--   / /\ \| |  | |  | | | |  | |  _  /       | |\/| | / /\ \ |  _  /  | |    | | | . ` |     | |    |  __  | |    |  __| |  _ <| |  | |\ \/ / |  __|| |     -->
<!--  / ____ \ |__| |  | | | |__| | | \ \ _     | |  | |/ ____ \| | \ \  | |   _| |_| |\  |     | |____| |  | | |____| |____| |_) | |__| | \  /  | |___| |____ -->
<!-- /_/    \_\____/   |_|  \____/|_|  \_(_)    |_|  |_/_/    \_\_|  \_\ |_|  |_____|_| \_|      \_____|_|  |_|______|______|____/ \____/   \/   |______\_____|-->                                                                                                                                                                                                                                                                                                              
<ul class="navbar-nav ml-auto">
            <li class="nav-item <?php if($stranka=="Index"){ echo 'active';}?>">
              <a class="nav-link" href="index.php">Prehľad
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item <?php if($stranka=="Pridat"){ echo 'active';}?>">
              <a class="nav-link" href="pridat.php">Pridať kartu</a>
            </li>
            <li class="nav-item <?php if($stranka=="Odobrat"){ echo 'active';}?>"">
              <a class="nav-link" href="odobrat.php">Odobrať kartu</a>
            </li>
			     <li class="nav-item <?php if($stranka=="Program"){ echo 'active';}?>">
              <a class="nav-link" href="program.php">Program</a>
            </li>
            <li class="nav-item <?php if($stranka=="Stats"){ echo 'active';}?>">
              <a class="nav-link" href="statistika.php">Štatistika</a>
            </li>
            <li class="nav-item <?php if($stranka=="Zapojenie"){ echo 'active';}?>">
              <a class="nav-link" href="zapojenie.php">Zapojenie</a>
            </li>
            <li class="nav-item <?php if($stranka=="Licencia"){ echo 'active';}?>">
              <a class="nav-link" href="licencia.php"><font color="red"><b>Licencia</b></font></a>
            </li>
             <li class="nav-item" id="right">
            <a href="https://www.paypal.me/chlebovec" class="btn btn-success" role="button" style="border-radius: 25px;"><img src="https://image.flaticon.com/icons/svg/888/888870.svg" width=32px height=32px>Podpora</a>
            </li>
          </ul>
