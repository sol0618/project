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
<h1>게시판 페이지</h1>

<br><br><br><br><br>

<!--카테고리 선택-->
<ul class="nav nav-pills nav-stacked col-md-2">
    <li role="presentation" <?php if($category==''){?> class="active" <? } ?> ><a href="/project/board">전체</a></li>
    <li role="presentation" <?php if($category=='notice'){?> class="active" <? } ?> ><a href="/project/board?category=notice">공지</a></li>
    <li role="presentation" <?php if($category=='free'){?> class="active" <? } ?> ><a href="/project/board?category=free">자유게시판</a></li>
</ul>

<div class="col-sm-2">
    <!-- 관리자 권한 모든 글쓰기 허용 -->
    <?php if($_SESSION['login_rank'] == "admin"){ ?>
        <button class="btn btn-primary" id="boardWrite" onclick="location.href='/project/boardWrite_form'">글쓰기</button>
    <?php } ?>

    <!-- 일반회원 권한 자유게시판 글쓰기 허용 -->
    <?php if($_SESSION['login_rank'] == "general" && $category == "free"){ ?>
        <button class="btn btn-primary" id="boardWrite" onclick="location.href='/project/boardWrite_form?category=free'">글쓰기</button>
    <?php } ?>
</div>

<!--조건 검색-->
<form action="/project/board" method="get" class="form-horizontal" style="margin-bottom: 2%">
    <div class="col-sm-2">
        <select class="form-control" name="select">
            <option value="">검색조건</option>
            <option value="title">제목</option>
        </select>
    </div>
    <div class="input-group col-sm-3">
        <input type="text" class="form-control" name="keyword" placeholder="키워드">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">검색</button>
        </span>
    </div>
    <input type="hidden" name="category" value="<?=$category?>">
</form>

<table class="table table-hover"  style="width: 80%">
    <thead>
        <tr>
            <th>#</th>
            <th>카테고리</th>
            <th>작성자</th>
            <th>제목</th>
            <th>등록일</th>
            <th>조회수</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $list){ ?>
            <tr>
                <td><?=$list->bnum?></td>
                <td>
                    <?php if($list->category=='notice'){ ?> 공지 <? } ?>
                    <?php if($list->category=='free'){ ?> 자유게시판 <? } ?>
                </td>
                <td><?=$list->id?></td>
                <td><a href="/project/boardView?bnum=<?=$list->bnum?>"><?=$list->title?></a></td>
                <td><?=$list->bdate?></td>
                <td><?=$list->count?></td>
                <td>
                    <?php if($_SESSION['login_rank'] == "admin" || $_SESSION['login_id'] == $list->id){ ?>
                        <button type="button" class="btn btn-danger" onclick="location.href='/project/boardDelete?bnum=<?=$list->bnum?>'">삭제</button>
                     <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!--페이지-->
<nav style="margin-left: 50%">
    <ul class="pagination">
        <li>
            <?php if($paging['page']<=1){ ?>
                    <span aria-hidden="true">&laquo;</span>
            <?php } else { ?>
                    <a href="/project/board?page=<?=$paging['page']-1?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
            <?php } ?>
        </li>
        <?php for ($i=$paging['startpage']; $i<=$paging['endpage']; $i++){ ?>
            <?php if($paging['page']==$i){?>
                <li class="active"><a href="/project/board?page=<?=$i?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>"><?=$i?></a></li>
            <?php } else {?>
                <li><a href="/project/board?page=<?=$i?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>"><?=$i?></a></li>
            <?php }?>
        <?php } ?>
        <li>
            <?php if($paging['page']>=$paging['maxpage']){ ?>
                    <span aria-hidden="true">&raquo;</span>
            <?php } else { ?>
                    <a href="/project/board?page=<?=$paging['page']+1?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
            <?php } ?>
        </li>
    </ul>
</nav>

</body>
</html>