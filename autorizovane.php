<?php 
include("connect.php");
?>
<table style="width: 100%;" border="1">
	<tr>
		<th style="width: 50%;">Od</th>
		<th style="width: 50%;">Číslo karty</th>
	</tr>
<?php
	$karty = mysqli_query($con,"SELECT * FROM autorizovane ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));			
       			echo "<td><i>". htmlspecialchars($casik) . "</i></td>";
			echo '<td><i>' . htmlspecialchars($line['cislo_karty']) .'</i></td>';
			echo "</tr>";
		}  
?> 
</table>
