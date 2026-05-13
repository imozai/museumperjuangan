<!DOCTYPE html>
<html>
<head>
	<title>Print PDF - Table Admin Museum</title>
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
		<h5>Table Data Admin Museum Perjuangan - ( {{ date("Y-m-d") }} )</h5>
		</center>

		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>Nama</th>
					<th>Email</th>
					<th>Terdaftar<br>Pada</th>
					<th>Role</th>
				</tr>
			</thead>
			<tbody>
				@foreach($admin as $admin)
				<tr>
					<td id="title">{{ $admin->name }}</td>
					<td id="konten">{{ $admin->email }}</td>
                    <td>{{ $admin->created_at }}</td>
                    @if( $admin->email == 'museumperjuanganjogja@gmail.com')
                    	<td>Master Admin</td>
                    @else
                    	<td>Admin</td>
                    @endif

				</tr>
				@endforeach
			</tbody>
		</table>
</body>
</html>