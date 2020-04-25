<?php 
include("connect.php");
?>
<table style="width: 100%;" border="1">
									 <tr>
									 <th style="width: 25%;">Od</th>
									 <th style="width: 25%;">Číslo karty</th>
									 <th style="width: 25%;">Akcia<img src="https://image.flaticon.com/icons/svg/788/788893.svg" width="20px" height="20px" data-toggle="tooltip2" data-placement="right" title="Aktivácia karty - Zápis karty do zoznamu oprávnených kariet pre vstup!"></th>
                   <th style="width: 25%;">Meno</th>
 </tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM neautorizovane GROUP BY cislo_karty") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));			
       echo "<td><i>". htmlspecialchars($casik) . "</i></td>";
				  echo '<td><i>' . htmlspecialchars($line['cislo_karty']) .'</i></td>';
				 echo "<td><a href='pridaj.php?".htmlspecialchars($line['cislo_karty'])."' class='btn btn-success'>Pridať</a></td>";
         $zamestnanec = mysqli_query($con,"SELECT meno FROM `zamestnanci` WHERE `cislo_karty`='".$line['cislo_karty']."'") or die(mysqli_error($con));
        $line2 = mysqli_fetch_assoc($zamestnanec);
        echo '<td>' . htmlspecialchars($line2['meno']) . '</td>';
			echo "</tr>";
		}  ?> </tbody></table>
        <script>
$(document).ready(function(){
  $('[data-toggle="tooltip2"]').tooltip();   
});
</script>
