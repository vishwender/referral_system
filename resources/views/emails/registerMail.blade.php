<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{$data['title']}}</title>
</head>
<body>
    <p>Hello {{$data['name']}}, welcome to site.</p>
    <p><b>Username:</b>{{$data['email']}}</p>
    <p><b>Password:</b>{{$data['password']}}</p>
    <p>You can add users to your network by sharing your referal link <a href="{{$data['url']}}">Referral Link</a></p>

    <p>Thank You!</p>
</body>
</html>