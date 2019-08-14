<?php 
include("connect.php");
?>
<table style="width: 100%;" border="1">
									 <tr>
									 <th style="width: 33.33%;">Od</th>
									 <th style="width: 33.33%;">Číslo karty</th>
									 <th style="width: 33.33%;">Akcia</th>
 </tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM neautorizovane GROUP BY cislo_karty") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));			
       echo "<td><i>". htmlspecialchars($casik) . "</i></td>";
				  echo '<td><i>' . htmlspecialchars($line['cislo_karty']) .'</i></td>';
				 echo "<td><a href='pridaj.php?".htmlspecialchars($line['cislo_karty'])."' class='btn btn-success'>Pridať</a></td>";
			echo "</tr>";
		}  ?> </tbody></table>
