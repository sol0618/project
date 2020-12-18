<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project</title>

    <!-- Bootstrap core CSS -->
    <link href="/application/views/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/application/views/css/modern-business.css" rel="stylesheet">
</head>

<body>
<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/project">Eunsol Project</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/project/board" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        게시판
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                        <a class="dropdown-item" href="/project/board">전체</a>
                        <a class="dropdown-item" href="/project/board?category=notice">공지</a>
                        <a class="dropdown-item" href="/project/board?category=free">자유게시판</a>
                    </div>
                </li>

                <?php if(!isset($_SESSION['login'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/project/join_form">Join</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project/login_form">Login</a>
                    </li>

                <?php } else { ?>
                    <li class="nav-link" style="color: white"> <?=$_SESSION['login_id']?>님 환영합니다.</li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project/logout">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap core JavaScript -->
<script src="/application/views/vendor/jquery/jquery.min.js"></script>
<script src="/application/views/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>


