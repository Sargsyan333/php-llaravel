<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Hi {{ $name }},

    <br>
    Please click on the link below or copy it into the address bar of your browser to confirm your email address:
    <br>

    <a href="{{ url('user/verify', $verification_code)}}">Confirm my email address </a>

    <br/>
</div>

</body>
</html>