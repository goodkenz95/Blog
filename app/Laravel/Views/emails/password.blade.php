<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password reset request details</title>
    <style>
        body{ font-family: 'Calibri', sans-serif; }
    </style>
</head>
<body>
    
    <table style="width: 500px; border: 1px dotted #323232; padding: 15px;">
        <tr>
            <td ">
                <table style="width: 100%">
                    <tr style="font-size: 24px;">
                        <td><strong>PASSWORD RESET DETAILS</strong></td>
                    </tr>
                </table>
            </td>
        </tr> 
        <tr>
            <td ">
                Seems like you requested to change your password. You can do this through the button below.<br><br><br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                ---RESET PASSWORD LINK---
            </td>
        </tr>
        <tr>
            <td style="letter-spacing: 2px; text-align: center; padding: 25px;"><a href="{{route('generic.reset_password',[$token])}}" style="padding: 10px 15px; background-color: #217a42; color: #e2e2e2; border-radius: 10px; text-decoration: none;" target="_blank"><strong>RESET PASSWORD</strong></a></td>
        </tr>
        <tr>
            <td style="text-align: center">
                ---or click the link below---
            </td>
        </tr>
        <tr>
            <td style="letter-spacing: 2px; text-align: center;"><a href="{{route('generic.reset_password',[$token])}}" target="_blank"><strong>{{route('generic.reset_password',[$token])}}</strong></a></td>
        </tr>
        <tr style="margin-top-top: 40px;">
            <td "><br><br><br>Please ignore this message if you didn't request and send a report to our contact us form.<br><br><br></td>
        </tr>
        <tr style="margin-top-top: 50px">
            <td ">Regards,<br>Support Team</td>
        </tr>
    </table>
</body>
</html>