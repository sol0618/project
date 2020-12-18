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
<div class="container" style="margin-bottom: 3%">

    <h1 class="mt-4 mb-3">게시글 수정
        <small>board update (* 표시필수)</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/project">Home</a>
        </li>
        <li class="breadcrumb-item active">게시글 작성</li>
    </ol>

    <form class="col-sm-12 form-horizontal" action="/project/boardUpdate" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-sm-2 control-label">글 번호</label>
            <div class="col-sm-8">
                <?=$list->bnum?>
                <input type="hidden" name="bnum" value="<?=$list->bnum?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">* 카테고리</label>
            <div class="col-sm-8">
                <select class="form-control" name="category">
                    <option value="">선택</option>
                    <option value="notice"
                        <?php if($list->category == 'notice'){ ?> selected <? } ?>
                        <?php if($_SESSION['login_rank'] == "general") { ?> style="display: none" <? } ?> >공지
                    </option>
                    <option value="free" <?php if($list->category == 'free'){ ?> selected <? } ?> >자유게시판</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">작성자</label>
            <div class="col-sm-8">
                <?=$list->id?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">* 제목</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="title" value="<?=$list->title?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">* 내용</label>
            <div class="col-sm-8">
                <textarea id="summernote" name="contents"><?=$list->contents?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">사진 첨부</label>
            <div class="col-sm-8">
                <?php if($list->img == "") { ?>
                        없음
                <?php } else { ?>
                        <img src="/application/controllers/uploads/<?=$list->img?>" width="300"/>
                <?php } ?>
                <div>제한 : 500kb까지, jpg png jpeg gif 형식만 가능</div>
                <input type="file" name="img">
                <input type="hidden" name="img0" value="<?=$list->img?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">등록일</label>
            <div class="col-sm-8">
                <?=$list->bdate?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">조회수</label>
            <div class="col-sm-8">
                <?=$list->count?>
            </div>
        </div>

        <div class="col-sm-offset-5" style="margin-bottom: 3%">
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