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
 	$karty = mysqli_query($con,"SELECT * FROM pokusy ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));	
			if($line['vysledok']==1){
				echo '<td bgcolor="#00FF00"><i>'. $casik . '</i></td>';	
				echo '<td bgcolor="#00FF00"><i>' . $line['cislo_karty']. '</i></td>';
				$vysledok = "Overený";
				echo '<td bgcolor="#00FF00"><i>' . $vysledok .'</i></td>';
			}else{
				echo '<td bgcolor="#FF0000"><i>'. $casik . '</i></td>';	
				echo '<td bgcolor="#FF0000"><i>' . $line['cislo_karty']. '</i></td>';
				$vysledok = "Neoverený";
				echo '<td bgcolor="#FF0000"><i>' . $vysledok .'</i></td>';
			}		
	echo "</tr>";
		}  ?> 
</table>
