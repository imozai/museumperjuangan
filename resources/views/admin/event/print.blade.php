<!DOCTYPE html>
<html>
<head>
	<title>Print PDF - Table Event Museum</title>
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
		<h5>Table Data Event Museum Perjuangan <br> Updated ( {{ date("d-F-Y") }} )</h5>
		</center>

		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>Judul</th>
					<th>Konten</th>
					<th>Tanggal<br>Mulai</th>
					<th>Tanggal<br>Selesai</th>
					<th>Diedit<br>Oleh</th>
				</tr>
			</thead>
			<tbody>
				@foreach($event as $event)
				<tr>
					<td id="title">{{ $event->title }}</td>
					<td id="konten">{{ $event->content }}</td>
					<td>{{ $event->tgl_mulai }}</td>
					<td>{{ $event->tgl_selesai }}</td>
					<td>{{ $event->created_by }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
</body>
</html>