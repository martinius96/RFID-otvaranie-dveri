<?php 
include("connect.php");
?>
<table style="width: 100%;" border="1">
	<tr>
		<th style="width: 33.33%;">Od</th>
		<th style="width: 33.33%;">Číslo karty</th>
    <th style="width: 33.33%;">Meno</th>
	</tr>
<?php
	$karty = mysqli_query($con,"SELECT * FROM autorizovane ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));			
       			echo "<td><i>". $casik . "</i></td>";
			echo '<td><i>' . $line['cislo_karty'] .'</i></td>';
      $zamestnanec = mysqli_query($con,"SELECT meno FROM `zamestnanci` WHERE `cislo_karty`='".$line['cislo_karty']."'") or die(mysqli_error($con));
        $line2 = mysqli_fetch_assoc($zamestnanec);
        echo '<td><i>' . htmlspecialchars($line2['meno']) . '</i></td>';
			echo "</tr>";
}  
?> 
</table>
