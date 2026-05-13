<!DOCTYPE html>
<html>
<head>
	<title>Print PDF - Table Koleksi Museum</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		},
		#title,#konten{
			word-wrap: break-word;
			max-width: 100px;
		}
	</style>
	<center>
		<h5>Table Data Koleksi Museum Perjuangan <br> Updated ( {{ date("d-F-Y") }} )</h5>
		</center>

		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>Nama<br>Koleksi</th>
					<th>Deskripsi</th>
                    <th>Sejarah</th>
                    <th>Lantai</th>
				</tr>
			</thead>
			<tbody>
				@foreach($koleksi as $koleksi)
				<tr>
					<td id="title">{{ $koleksi->name }}</td>
					<td id="konten">{{ $koleksi->description }}</td>
					<td>{{ $koleksi->sejarah }}</td>
                    <td>{{ $koleksi->lantai }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
</body>
</html>