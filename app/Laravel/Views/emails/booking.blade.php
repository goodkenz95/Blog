<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Booking Inquiry from {{$name}}</title>
</head>
<body>
	<p>New booking received from {{$name}} [{{Helper::date_only(Carbon::now())}}]</p>

	<p>Booking Details</p>

	<table>
		<tr>
			<td>Name</td>
			<td>{{$name}}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{$email}}</td>
		</tr>
		<tr>
			<td>Contact Number</td>
			<td>{{$contact_number}}</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>{{$address}}</td>
		</tr>
	</table>
</body>
</html>