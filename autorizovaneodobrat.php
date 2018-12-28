<?php 
include("connect.php");
?>
<table style="width: 100%;" border="1">
									 <tr>
									 <th style="width: 33.33%;">Autorizované od</th>
									 <th style="width: 33.33%;">Číslo karty</th>
									 <th style="width: 33.33%;">Akcia</th>
 </tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM autorizovane ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
				$casik = date('d. M H:i:s',strtotime($line['time']));			
       echo "<td><i>". $casik . "</i></td>";
				  echo '<td><i>' . $line['cislo_karty'] .'</i></td>';
				  echo "<td><a href='zmazat.php?".$line['id']."' class='btn btn-danger'>Zmazať</a></td>";
			echo "</tr>";
		}  ?> </tbody></table>
