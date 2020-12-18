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
    
    <h1 class="mt-4 mb-3"><?=$list->title?><small> by <?=$list->id?></small></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/project">Home</a>
        </li>
        <li class="breadcrumb-item active"><?=$list->category?></li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <p style="text-align: right">Posted on <?=$list->bdate?> / 조회수 <?=$list->count?></p>
            <hr>
            <div class="col-sm-5">
                <?php if($list->img == "") { ?>
                <?php } else { ?>
                    <img class="img-fluid rounded" src="/application/controllers/uploads/<?=$list->img?>" width="300"/>
                <?php } ?>
            </div>
            <p><?=$list->contents?></p>

            <div style="margin-left: 40%">
                <?php if($_SESSION['login_rank'] == "admin" || $_SESSION['login_id'] == $list->id){ ?>
                    <button class="btn btn-primary" onclick="location.href='/project/boardUpdate_form?bnum=<?=$list->bnum?>'">수정</button>
                    <button class="btn btn-danger" onclick="location.href='/project/boardDelete?bnum=<?=$list->bnum?>'">삭제</button>
                <?php } ?>
                <button class="btn btn-secondary" onclick="location.href='/project/board'">목록으로</button>
            </div>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment</h5>
                <div class="card-body">
                    <form action="/project/cInsert" method="post">
                        <div class="form-group">
                            <input type="hidden" name="bnum" value="<?=$list->bnum?>">
                            <textarea class="form-control" rows="3" id="contents" name="contents"></textarea>
                        </div>
                        <!--            <button class="btn btn-success" onclick="c_insert()">등록</button>-->
                        <button type="submit" class="btn btn-success">댓글 등록</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <div id="commentArea" style="margin-top:3%; margin-bottom:3%">
                <!-- 댓글 -->
                <?php for($i=0; $i<sizeof($cList); $i++){ ?>
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0"><?=$cList[$i]["id"]?></h5>
                            <?=$cList[$i]["contents"]?>
                            <br>
                            <?=$cList[$i]["cdate"]?>
                        </div>
                        <?php if($_SESSION['login_rank'] == "admin" || $_SESSION['login_id'] == $cList[$i]["id"]){ ?>
                            <!--                    <button onclick="c_delete(this)" data-cnum=--><?//=$cList[$i]["cnum"]?><!--삭제</button>-->
                            <button class="btn btn-secondary" onclick="location.href='/project/cDelete?bnum=<?=$cList[$i]["bnum"]?>&cnum=<?=$cList[$i]["cnum"]?>'">삭제</button>
                        <?php } ?>

                        <button class="collapsed btn btn-secondary" data-toggle="collapse" href="#collapse1<?=$cList[$i]["cnum"]?>" aria-expanded="false" aria-controls="collapse1<?=$cList[$i]["cnum"]?>">댓글 입력</button>
                        <button class="btn btn-secondary" data-toggle="collapse" href="#collapse2<?=$cList[$i]["cnum"]?>" aria-expanded="true" aria-controls="collapse2<?=$cList[$i]["cnum"]?>">댓글 닫기</button>
                    </div>

                    <!-- re댓글 입력 -->
                    <div class="collapse" id="collapse1<?=$cList[$i]["cnum"]?>">
                        <form action="/project/reInsert" method="post">
                            <input type="hidden" name="cnum" value="<?=$cList[$i]["cnum"]?>">
                            <input type="hidden" name="bnum" value="<?=$cList[$i]["bnum"]?>">
                            <div class="col-sm-offset-2 col-sm-5">
                                <input type="text" class="form-control" id="re_contents<?=$cList[$i]["cnum"]?>" name="contents" placeholder="re댓글 입력">
                            </div>
                            <!--                <button onclick="re_insert(this)" data-cnum="--><?//=$cList[$i]["cnum"]?><!--" data-contents="#re_contents--><?//=$cList[$i]["cnum"]?><!--" >등록</button>-->
                            <input type="submit" value="등록">
                        </form>
                    </div>

                    <!-- re댓글 -->
                    <div class="collapse show" style="margin-left: 5%" id="collapse2<?=$cList[$i]["cnum"]?>">
                        <?php for($j=0; $j<sizeof($reList); $j++){
                            if($cList[$i]["cnum"] == $reList[$j]["cnum"]){?>
                                <div class="media mt-4">
                                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-0"><?=$reList[$j]["id"]?></h5>
                                        <?=$reList[$j]["contents"]?>
                                        <br>
                                        <?=$reList[$j]["redate"]?>
                                    </div>
                                    <?php if($_SESSION['login_rank'] == "admin" || $_SESSION['login_id'] == $reList[$j]["id"]){ ?>
                                        <button onclick="location.href='/project/redelete?bnum=<?=$reList[$j]["bnum"]?>&renum=<?=$reList[$j]["renum"]?>'">삭제</button>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <!-- 댓글들 끝-->
        </div>
    </div>
</div>


<script type="text/html" id="comment">
    <div class="form-group">
        <label class="col-sm-2 control-label">{%id%}</label>
        <div class="col-sm-5">
            {%contents%}
            <br>
            {%cdate%}
        </div>
        <button onclick="c_delete(this)" data-cnum="{%cnum%}" style="{%display%}">삭제</button>

        <button data-toggle="collapse" data-target="#collapse1{%cnum%}" aria-expanded="false" aria-controls="collapse1">댓글 입력</button>
        <button id="recommentBtn" data-toggle="collapse" data-target="#collapse2{%cnum%}" aria-expanded="false" aria-controls="collapse2"
                onclick="re_select(this)" data-cnum="{%cnum%}" data-area="#recommentArea{%cnum%}" >댓글 보기</button>
    </div>

    <!-- re댓글 입력 -->
    <div class="form-group collapse" id="collapse1{%cnum%}">
        <div class="col-sm-offset-2 col-sm-5">
            <input type="text" class="form-control" id="re_contents{%cnum%}" placeholder="re댓글 입력">
        </div>
        <button onclick="re_insert(this)" data-cnum="{%cnum%}" data-contents="#re_contents{%cnum%}">등록</button>
    </div>

    <!-- re댓글 보기 -->
    <div class="form-group collapse" id="collapse2{%cnum%}">
        <div id=recommentArea{%cnum%} class="col-sm-offset-2 col-sm-5">
        </div>
    </div>
</script>

<script type="text/html" id="recomment">
    <div class="form-group">
        <label class="col-sm-2 control-label">{%id%}</label>
        <div class="col-sm-5">
            {%contents%}<br>
            {%redate%}
        </div>
        <button onclick="re_delete(this)" data-renum="{%renum%}" data-cnum="{%cnum%}" style="{%display%}">삭제</button>
    </div>
</script>

<script>
    //$(function(){
    //    var bnum = "<?// echo $list->bnum; ?>//";
    //    comment(bnum);
    //});

    var login_rank = "<? echo $_SESSION['login_rank']; ?>";
    var session_id = "<? echo $_SESSION['login_id']; ?>";

    //댓글 목록
    function comment(bnum){
        $.ajax({
            type: "post",
            url: "/rest/board/comment",
            data: {"bnum" : bnum},
            dataType: "json",
            success: function (data) {
                var tempHtml = $('#comment').html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    resultHtml +=
                        tempHtml.split("{%id%}").join(data[i]["id"])
                        .split("{%contents%}").join(data[i]["contents"])
                        .split("{%cdate%}").join(data[i]["cdate"])
                        .split("{%cnum%}").join(data[i]["cnum"])
                        .split("{%display%}").join(data[i]["id"] == session_id ? "display:inline-block;" : "display:none");
                }
                $('#commentArea').html(resultHtml);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //댓글 입력
    function c_insert(){
        var jdata = new Object();
        jdata.bnum = <?=$list->bnum?>;
        jdata.contents = $('#contents').val();
        var data = JSON.stringify(jdata);
        //$bnum = <?//=$list->bnum?>//;

        $.ajax({
            type: "post",
            url: "/rest/board/c_insert",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                alert("댓글입력 성공");
                //location.href="/project/boardView?bnum=<?//=$list->bnum?>//";

                // var tempHtml = $('#comment').html();
                // var resultHtml = "";
                // for (var i = 0; i < data.length; i++) {
                //     resultHtml += tempHtml.split("{%id%}").join(data[i]["id"])
                //         .split("{%contents%}").join(data[i]["contents"])
                //         .split("{%cdate%}").join(data[i]["cdate"])
                //         .split("{%cnum%}").join(data[i]["cnum"])
                //         .split("{%display%}").join(data[i]["id"] == session_id ? "display:inline-block;" : "display:none");
                // }
                // $('#commentArea').html(resultHtml);
                // $('#contents').val("");

                // comment($bnum);
                // $('#contents').val("");
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //댓글 삭제
    function c_delete(element){
        $cnum = $(element).data("cnum");
        $bnum = <?=$list->bnum?>;

        $.ajax({
            type: "post",
            url: "/rest/board/c_delete",
            data: {
                "cnum": $cnum,
                "bnum": $bnum
            },
            // dataType: "json",
            success: function (data) {
                alert("댓글삭제 성공");
                location.href="/project/boardView?bnum=<?=$list->bnum?>";

                // var tempHtml = $('#comment').html();
                // var resultHtml = "";
                // for (var i = 0; i < data.length; i++) {
                //     resultHtml += tempHtml.split("{%id%}").join(data[i]["id"])
                //         .split("{%contents%}").join(data[i]["contents"])
                //         .split("{%cdate%}").join(data[i]["cdate"])
                //         .split("{%cnum%}").join(data[i]["cnum"])
                //         .split("{%display%}").join(data[i]["id"] == session_id ? "display:inline-block;" : "display:none");
                // }
                // $('#commentArea').html(resultHtml);

                // comment($bnum);
                // $('#contents').val("");
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //re댓글 입력
    function re_insert(element){
        var jdata = new Object();
        jdata.cnum = $(element).data("cnum");
        jdata.bnum = <?=$list->bnum?>;
        jdata.contents = $($(element).data("contents")).val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type: "post",
            url: "/rest/board/re_insert",
            data: {data: data},
            success: function (data) {
                alert("re댓글이 입력되었습니다.");
                location.href="/project/boardView?bnum=<?=$list->bnum?>";
                // $($(element).data("contents")).val("");
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //re댓글 목록
    function re_select(element) {
        $cnum = $(element).data("cnum");

        $.ajax({
            type: "post",
            url: "/rest/board/re_select",
            data: {"cnum": $cnum},
            dataType: "json",
            success: function (data) {
                var tempHtml = $('#recomment').html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    resultHtml += tempHtml.split("{%id%}").join(data[i]["id"])
                        .split("{%contents%}").join(data[i]["contents"])
                        .split("{%redate%}").join(data[i]["redate"])
                        .split("{%cnum%}").join(data[i]["cnum"])
                        .split("{%renum%}").join(data[i]["renum"])
                        .split("{%display%}").join(data[i]["id"] == session_id ? "display:inline-block;" : "display:none");
                }
                $($(element).data("area")).html(resultHtml);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //re댓글 삭제
    function re_delete(element){
        $renum = $(element).data("renum");
        $cnum = $(element).data("cnum");
        $bnum = <?=$list->bnum?>;

        $.ajax({
            type: "post",
            url: "/rest/board/re_delete",
            data: {
                "renum" : $renum,
                "cnum" : $cnum
            },
            // dataType: "json",
            success: function (data) {
                alert("re댓글이 삭제되었습니다.");
                location.href="/project/boardView?bnum=<?=$list->bnum?>";

                // comment($bnum);

                // $($(element).data("area")).empty();
                // var tempHtml = $('#recomment').html();
                // var resultHtml = "";
                // for (var i = 0; i < data.length; i++) {
                //     resultHtml += tempHtml.split("{%id%}").join(data[i]["id"])
                //         .split("{%contents%}").join(data[i]["contents"])
                //         .split("{%redate%}").join(data[i]["redate"])
                //         .split("{%cnum%}").join(data[i]["cnum"])
                //         .split("{%renum%}").join(data[i]["renum"])
                //         .split("{%display%}").join(data[i]["id"] == session_id ? "display:inline-block;" : "display:none");
                // }
                // $($(element).data("area")).html(resultHtml);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

</script>
<!-- Bootstrap core JavaScript -->
<script src="/application/views/vendor/jquery/jquery.min.js"></script>
<script src="/application/views/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>