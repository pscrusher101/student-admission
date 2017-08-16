<link rel="stylesheet" href="registered.css" type="text/css">


<?php
		
		$mysqli = new mysqli('localhost','root','','accounts');
		$sql = 'SELECT username, avatar, boardschool, college, edob, egender, mobilenumber FROM users';
		$result = $mysqli->query($sql);//$result is mysqli result obj


?>

 <div id ="registered">

		<span>all registered users</span>
		<?php
		echo "<table border=1 align = right>
			<tr>
			<th>username</th>
			<th>boardschool</th>
			<th>college</th>
			<th>date of birth</th>
			<th>gender</th>
			<th>contact number</th>
			<th>student photo</th>
						</tr>";
			while($row = $result->fetch_assoc()){

				echo "<tr>";
				echo "<td>" . $row['username'] . "</td>";
				echo "<td>" . $row['boardschool'] . "</td>";
				echo "<td>" . $row['college'] . "</td>";
				echo "<td>" . $row['edob'] . "</td>";
				echo "<td>" . $row['egender'] . "</td>";
				echo "<td>" . $row['mobilenumber'] . "</td>";
				echo "<td>" . "<img src = '$row[avatar]'>" . "</td>";
			}
			echo "</table>";


		?>
</div>   