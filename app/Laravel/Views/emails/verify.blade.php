<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validate your account</title>
    <style>
        body{ font-family: 'Calibri', sans-serif; }
    </style>
</head>
<body>
    
    <table style="width: 500px; border: 1px dotted #323232; padding: 15px;">
        <tr>
            <td >
                <table style="width: 100%">
                    <tr style="font-size: 24px;">
                        <td><strong>VALIDATE YOUR ACCOUNT</strong></td>
                    </tr>
                </table>
            </td>
        </tr> 
        <tr>
            <td>
                Please verify your account email address by clicking the button below.<br><br><br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                ---VERIFY EMAIL ADDRESS LINK---
            </td>
        </tr>
        <tr>
            <td style="letter-spacing: 2px; text-align: center; padding: 25px;"><a href="{{route('generic.verify',[$token])}}" style="padding: 10px 15px; background-color: #217a42; color: #e2e2e2; border-radius: 10px; text-decoration: none;" target="_blank"><strong>VALIDATE EMAIL ADDRESS</strong></a></td>
        </tr>
        <tr>
            <td style="text-align: center">
                ---or click the link below---
            </td>
        </tr>
        <tr>
            <td style="letter-spacing: 2px; text-align: center; padding-top:25px;"><a href="{{route('generic.verify',[$token])}}" target="_blank"><strong>{{route('generic.verify',[$token])}}</strong></a></td>
        </tr>
        <tr style="margin-top-top: 50px">
            <td ">Regards,<br>Support Team</td>
        </tr>
    </table>
</body>
</html>