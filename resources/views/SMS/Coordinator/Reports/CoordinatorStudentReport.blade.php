<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Student Report</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
		}

		table, th, td {
			border: 1px solid black;
			padding: 5px;
		}
		tr:nth-child(even) {background-color: #f2f2f2}
		th {
			background-color: #DD4B39;
			color: white;
		}
	</style>
</head>
<body>
	<center><b>REPUBLIC OF THE PHILIPPINES</b><br>
		<small>QUEZON CITY<br>
			City Councilor<br>
		</small>
		<big>
			<i>Office of Councilor Hero Clarence M. Bautista</i><br>
		</big></center><br><br><br>
		<b>November 7. 2016<br><br><br>
			Mr. Rogelio L. Reyes</b><br>
			HEAD SCHOLARSHIP AND YOUTH DEVELOPMENT PROGRAM<br>
			7th Floor, Civic Center Building A<br>
			Quezon City Hall Compound<br>
			Quezon City<br><br>
			Dear Mr. Reyes,<br><br>
			Transmitted herewith is the list of names applying under my Scholarship Program. 
			<br><br>
			<table width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Student</th>
						<th>School</th>
					</tr>
				</thead>
				<?php
				$ctr = 0;
				?>
				@foreach ($application as $applications)
				<?php
				$ctr++;
				?>
				<tbody>
					<tr>
						<td>{{$ctr}}</td>
						<td>{{$applications->last_name}}, {{$applications->first_name}} {{$applications->middle_name}}</td>
						<td>{{$applications->description}}</td>
					</tr>
				</tbody>
				@endforeach
			</table>
			<br>
			<br>
			COUNCILOR HERO CLARENCE M. BAUTISTA<br>
			City Councilor Quezon City<br>
			4th District
		</body>
		</html>