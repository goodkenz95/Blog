<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$user->name}}</title>
	<style>
	.page-break {
	    page-break-after: always;
	}
	</style>
</head>
<body>
	<table style="width: 100%">
		<tr>
			<td style="text-align: center;">
				
				<div style="color: #262626; top: 45px; font-size: 18px; left: 10px; position: absolute; text-shadow: 1px 1px 3px #333; font-family: 'Helvetica'; width: 310px; border: 0px solid #333; margin-left: 205px; text-align: center">
					<strong>{{$user->name}}</strong>
					<div><span style="font-size: 12px;">({{$user->username}})</span></div>

				</div>
				<img src="data:image/png;base64, {!!base64_encode(QrCode::format('png')->size(1000)->generate("BEGIN:VCARD\nVERSION:4.0\nFN:{{$user->name}}\nTEL;TYPE=work,voice;VALUE=uri:tel:{{$user->contact_umber}}\nEMAIL:{{$user->email}}\nEND:VCARD"))!!}" style="height: 190px; position: absolute; top: 425px; left: 270px;">
				
			</td>
		</tr>
		
	</table>
</body>
</html>