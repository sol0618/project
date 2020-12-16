<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    
</head>
<body>
<h1>로그인 페이지</h1>

<form class="col-sm-12 form-horizontal" action="/project/login" method="post">

    <div class="form-group">
        <label class="col-sm-2 control-label">* ID</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="id" name="id" placeholder="Id">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* Password</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
    </div>

    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">확인</button>
        <button type="button" class="btn btn-default" onclick="location.href='/project'">취소</button>
    </div>
</form>


</body>
</html>