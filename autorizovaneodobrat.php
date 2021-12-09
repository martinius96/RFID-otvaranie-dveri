<?php 
include("connect.php");
?>
<table style="width: 100%;" border="1">
	<tr>
		<th style="width: 20%;">Autorizované od</th>
		<th style="width: 20%;">Číslo karty</th>
		<th style="width: 20%;">Akcia<img src="https://i.imgur.com/zMsp0cr.png" width="20px" height="20px" data-toggle="tooltip" data-placement="right" title="Deaktivácia karty - zneplatnenie karty, ponechanie v systéme!"></th>
  		<th style="width: 20%;">Akcia<img src="https://i.imgur.com/zMsp0cr.png" width="20px" height="20px" data-toggle="tooltip2" data-placement="right" title="Výmaz karty - zneplatnenie karty, vymazanie zo systému!"></th>
  		<th style="width: 20%;">Meno</th>
	</tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM autorizovane ORDER BY id DESC") or die(mysqli_error($con));
	while($line = mysqli_fetch_assoc($karty)){
		echo "<tr>";
		$casik = date('d. M H:i:s',strtotime($line['time']));			
       		echo "<td><i>". $casik . "</i></td>";
		echo '<td><i>' . htmlspecialchars($line['cislo_karty']).'</i></td>';
    		echo "<td><a href='deaktivovat.php?".htmlspecialchars($line['cislo_karty'])."' class='btn btn-info'>Deaktivovať</a></td>";
		echo "<td><a href='zmazat.php?".htmlspecialchars($line['cislo_karty'])."' class='btn btn-danger'>Zmazať</a></td>";
    		$zamestnanec = mysqli_query($con,"SELECT meno FROM `zamestnanci` WHERE `cislo_karty`='".$line['cislo_karty']."'") or die(mysqli_error($con));
        	$line2 = mysqli_fetch_assoc($zamestnanec);
        	echo '<td>' . htmlspecialchars($line2['meno']) . '</td>';
		echo "</tr>";
	}  
?> 
</table>
  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
  $('[data-toggle="tooltip2"]').tooltip();   
});
</script>
