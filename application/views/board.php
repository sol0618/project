<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">

    <h1 class="mt-4 mb-3">게시판<small>Board</small></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/project">Home</a>
        </li>
        <li class="breadcrumb-item active">게시판</li>
    </ol>

    <div class="row">
        <!--카테고리 선택-->
        <div class="col-lg-3 mb-4" style="height: 650px">
            <div class="list-group">
                <a href="/project/board" class="list-group-item <?php if($category==''){?> active <? } ?>">전체</a>
                <a href="/project/board?category=notice" class="list-group-item <?php if($category=='notice'){?> active <? } ?>">공지</a>
                <a href="/project/board?category=free" class="list-group-item <?php if($category=='free'){?> active <? } ?>">자유게시판</a>
            </div>

            <div style="margin-top: 10%">
                <!-- 관리자 권한 모든 글쓰기 허용 -->
                <?php if($_SESSION['login_rank'] == "admin"){ ?>
                    <button class="btn btn-secondary btn-block" id="boardWrite" onclick="location.href='/project/boardWrite_form'">글쓰기</button>
                <?php } ?>

                <!-- 일반회원 권한 자유게시판 글쓰기 허용 -->
                <?php if($_SESSION['login_rank'] == "general" && $category == "free"){ ?>
                    <button class="btn btn-secondary btn-block" id="boardWrite" onclick="location.href='/project/boardWrite_form?category=free'">글쓰기</button>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-9 mb-4">
            <!--조건 검색-->
            <form action="/project/board" method="get">
                <input type="hidden" name="category" value="<?=$category?>">
                <div class="input-group">
                    <select class="form-control col-sm-3" name="select">
                        <option value="">검색조건</option>
                        <option value="title">제목</option>
                    </select>
                    <input type="text" class="form-control" name="keyword" placeholder="키워드">
                    <span class="input-group-append"><button type="submit" class="btn btn-secondary">검색</button></span>
                </div>
            </form>
            <!--테이블-->
            <table class="table table-hover" style="margin-top: 3%">
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
            <!--페이지네이션-->
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <?php if($paging['page']<=1){ ?>
                        <span class="page-link" aria-hidden="true">&laquo;</span>
                    <?php } else { ?>
                        <a class="page-link" href="/project/board?page=<?=$paging['page']-1?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php } ?>
                </li>

                <?php for ($i=$paging['startpage']; $i<=$paging['endpage']; $i++){ ?>
                    <?php if($paging['page']==$i){?>
                        <li class="page-item active"><a class="page-link" href="/project/board?page=<?=$i?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>"><?=$i?></a></li>
                    <?php } else {?>
                        <li class="page-item"><a class="page-link" href="/project/board?page=<?=$i?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>"><?=$i?></a></li>
                    <?php }?>
                <?php } ?>

                <li class="page-item">
                    <?php if($paging['page']>=$paging['maxpage']){ ?>
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    <?php } else { ?>
                        <a class="page-link" href="/project/board?page=<?=$paging['page']+1?>&category=<?=$category?>&select=<?=$select?>&keyword=<?=$keyword?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript -->
<script src="/application/views/vendor/jquery/jquery.min.js"></script>
<script src="/application/views/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>