<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- include libraries(jQuery, bootstrap) -->
<!--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- Bootstrap core CSS -->
<!--    <link href="/application/views/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="/application/views/css/modern-business.css" rel="stylesheet">

</head>
<body>

<div class="container" style="margin-bottom: 3%">

    <h1 class="mt-4 mb-3">게시글 작성
        <small>board write (* 표시필수)</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/project">Home</a>
        </li>
        <li class="breadcrumb-item active">게시글 작성</li>
    </ol>

    <form class="col-sm-12 form-horizontal" action="/project/boardWrite" method="post" enctype="multipart/form-data">
        <input type="hidden" name="category" value="<?=$category?>">

        <div class="form-group">
            <label class="col-sm-2 control-label">* 카테고리</label>
            <div class="col-sm-8">
                <select class="form-control" name="category">
                    <option value="">선택</option>
                    <option value="notice"
                        <?php if($_SESSION['login_rank'] == "general") { ?> style="display: none" <? } ?> >공지
                    </option>
                    <option value="free">자유게시판</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">* 제목</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="title">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">* 내용</label>
            <div class="col-sm-8">
                <textarea id="summernote" name="contents"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">사진 첨부</label>
            <div class="col-sm-8">
                <input type="file" name="img">
                <span>제한 : 500kb까지, jpg png jpeg gif 형식만 가능</span>
            </div>
        </div>

        <div class="col-sm-offset-5">
            <button type="submit" class="btn btn-primary">확인</button>
            <button type="button" class="btn btn-default" onclick="location.href='/project/board'">취소</button>
        </div>
    </form>
</div>
<!-- Footer -->
<footer class="py-3 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
</footer>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200
        });
    });
</script>
<!-- Bootstrap core JavaScript -->
<!--<script src="/application/views/vendor/jquery/jquery.min.js"></script>-->
<script src="/application/views/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>