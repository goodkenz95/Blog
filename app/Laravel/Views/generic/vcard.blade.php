<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$user->name}} VCARD</title>
</head>
<body>
	<img src="data:image/png;base64, {!!base64_encode(QrCode::format('png')->size(1000)->generate("BEGIN:VCARD\nVERSION:3.0\nN:{$user->name}\nFN:{$user->name}\nTEL;CELL:{$user->country_code}{$user->contact_number}\nEMAIL:{$user->email}\nEND:VCARD"))!!}" style="height: 100%; width: 100%">
</body>
</html>