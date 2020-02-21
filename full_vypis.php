<?php 
include("connect.php");
?>
<table style="width: 100%;" border="1">
	<thead>
  <tr>
		<th style="width: 25%;">Čas</th>
		<th style="width: 25%;">Kľúčenka</th>
		<th style="width: 25%;">Výsledok</th>
		<th style="width: 25%;">Meno</th>							 
	</tr></thead><tbody>           
<?php
 	$karty = mysqli_query($con,"SELECT * FROM pokusy ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));	
			if($line['vysledok']==1){
				echo '<td bgcolor="#2ECC71"><i>'. htmlspecialchars($casik) . '</i></td>';	
				echo '<td bgcolor="#2ECC71"><i>' . htmlspecialchars($line['cislo_karty']) . '</i></td>';    
				$vysledok = "Úspešné overenie";
				echo '<td bgcolor="#2ECC71"><i>' . htmlspecialchars($vysledok) .'</i></td>';
        $zamestnanec = mysqli_query($con,"SELECT meno FROM `zamestnanci` WHERE `cislo_karty`='".$line['cislo_karty']."'") or die(mysqli_error($con));
        $line2 = mysqli_fetch_assoc($zamestnanec);
        echo '<td bgcolor="#2ECC71"><b>' . htmlspecialchars($line2['meno']) . '</b></td>';
			}else{
				echo '<td bgcolor="#E74C3C"><i>'. htmlspecialchars($casik) . '</i></td>';	
				echo '<td bgcolor="#E74C3C"><i>' . htmlspecialchars($line['cislo_karty']) . '</i></td>';
				$vysledok = "Neúspešné overenie";
				echo '<td bgcolor="#E74C3C"><i>' . htmlspecialchars($vysledok) .'</i></td>';
        $zamestnanec = mysqli_query($con,"SELECT meno FROM `zamestnanci` WHERE `cislo_karty`='".$line['cislo_karty']."'") or die(mysqli_error($con));
        $line2 = mysqli_fetch_assoc($zamestnanec);
        echo '<td bgcolor="#E74C3C"><b>' . htmlspecialchars($line2['meno']) . '</b></td>';
			}		
	echo "</tr>";
		}  ?> 
</tbody></table>
