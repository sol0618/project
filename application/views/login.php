<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <link href="/application/views/css/member.css" rel="stylesheet">
</head>
<body style="background-color: gainsboro">
<div class="registration-form" style="margin-bottom: 4.2%">
    <h2 style="margin-left: 48%; margin-bottom: 1%">로그인</h2>

    <form class="col-sm-12 form-horizontal" action="/project/login" method="post">
        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="id" name="id" placeholder="ID">
        </div>
        <div class="form-group">
            <input type="password" class="form-control item" id="password" name="password" placeholder="Password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Login</button>
        </div>
    </form>

    <div class="social-media">
        <h5>Sign up with social media</h5>
        <a href="https://kauth.kakao.com/oauth/authorize?client_id=26965564b7dccc230e5c0ce1979a7f51&redirect_uri=http://dmsthf590.com/project/kakaoLogin&response_type=code">
            <img src="/application/views/img/kakao_login.png" alt="카카오 로그인">
        </a>
    </div>
</div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="/application/views/vendor/jquery/jquery.min.js"></script>
<script src="/application/views/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>