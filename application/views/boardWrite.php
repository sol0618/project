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

    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head>
<body>
<h1>게시글 작성</h1>
<h5>* 표시는 반드시 입력해야 하는 항목입니다.</h5>
<br><br><br>

<form class="col-sm-12 form-horizontal" action="/project/boardWrite" method="post" enctype="multipart/form-data">
    <input type="hidden" name="category" value="<?=$category?>">

    <div class="form-group">
        <label class="col-sm-2 control-label">* 카테고리</label>
        <div class="col-sm-5">
            <select class="form-control" name="category">
                <option value="">선택</option>
                <option value="notice"
                    <?php if($_SESSION['login_rank'] == "general") { ?> style="display: none" <? } ?> 공지
                </option>
                <option value="free">자유게시판</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* 제목</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="title">
        </div>
        <span id="pw_msg2"></span>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* 내용</label>
        <div class="col-sm-5">
            <textarea id="summernote" name="contents"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">사진 첨부</label>
        <div class="col-sm-5">
            <span>제한 : 500kb까지, jpg png jpeg gif 형식만 가능</span>
            <input type="file" name="img">
        </div>
    </div>

    <div class="col-sm-offset-4">
        <button type="submit" class="btn btn-primary">확인</button>
        <button type="button" class="btn btn-default" onclick="location.href='/project/board'">취소</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200
        });
    });
</script>
</body>
</html>