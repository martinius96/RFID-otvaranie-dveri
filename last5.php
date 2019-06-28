<?php 
include("connect.php");
?>
    <table style="width: 100%;" border="1">
									 <tr>
									 <th style="width: 33.33%;">Čas</th>
									 <th style="width: 33.33%;">Kľúčenka</th>
									 <th style="width: 33.33%;">Výsledok</th>
									 
									 </tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM pokusy ORDER BY id DESC LIMIT 5") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
				$casik = date('d. M H:i:s',strtotime($line['time']));	
				if($line['vysledok']==1){
				echo '<td bgcolor="#2ECC71"><i>'. $casik . '</i></td>';	
				echo '<td bgcolor="#2ECC71"><i>' . $line['cislo_karty']. '</i></td>';
				$vysledok = "Úspešné overenie";
				  echo '<td bgcolor="#2ECC71"><i>' . $vysledok .'</i></td>';
				}else{
					echo '<td bgcolor="#E74C3C"><i>'. $casik . '</i></td>';	
				echo '<td bgcolor="#E74C3C"><i>' . $line['cislo_karty']. '</i></td>';
				$vysledok = "Neúspešné overenie";
				  echo '<td bgcolor="#E74C3C"><i>' . $vysledok .'</i></td>';
				}		
			echo "</tr>";
		}  ?> </tbody></table>