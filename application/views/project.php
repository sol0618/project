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

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
<h1>실습3</h1>
<h3>github test123</h3>
<h3>2020.12.17</h3>
<h3>브랜치 테스트</h3>
<h3>브랜치 테스트 123</h3>
<br>

<div class="nav pull-right">
    <?php if(!isset($_SESSION['login'])) { ?>
        <a href="/project/login_form">로그인</a>
        <a href="/project/join_form">회원가입</a>
    <?php } else {
            echo $_SESSION['login_id'];
    ?>
           님 환영합니다.
           <a href="/project/logout">로그아웃</a>
    <?php } ?>
</div>
<a href="/project">HOME</a>
<a href="/project/board">게시판</a>
<hr/>
</body>
</html>

