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
            <li class="nav-item <?php if($stranka=="Grafy"){ echo 'active';}?>">
              <a class="nav-link" href="grafy.php">Grafy</a>
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
             <li class="nav-item" id="right">
            <a href="https://www.paypal.me/chlebovec" class="btn btn-success" role="button" style="border-radius: 25px;"><img src="https://image.flaticon.com/icons/svg/888/888870.svg" width=32px height=32px>Podpora</a>
            </li>
          </ul>