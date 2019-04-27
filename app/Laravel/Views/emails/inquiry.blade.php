<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact Inquiry : {{$subject}}</title>
</head>
<body>
	<p>New inquiry received from {{$name}} [{{Helper::date_only(Carbon::now())}}]</p>

	<p>Inquiry Details</p>

	<table cellpadding="3" cellspacing="0" border="1">
		<tr>
			<td><strong>Name</strong></td>
			<td>{{$name}}</td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td>{{$email}}</td>
		</tr>
		<tr>
			<td><strong>Message</strong></td>
			<td>{{$msg}}</td>
		</tr>
	</table>
</body>
</html>