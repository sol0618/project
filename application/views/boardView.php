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
<h1>상세페이지</h1>

<div class="col-sm-12 form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label">글 번호</label>
        <div class="col-sm-5">
            <?=$list->bnum?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">카테고리</label>
        <div class="col-sm-5">
            <?=$list->category?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">작성자</label>
        <div class="col-sm-5">
            <?=$list->id?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">제목</label>
        <div class="col-sm-5">
            <?=$list->title?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">내용</label>
        <div class="col-sm-5">
            <?=$list->contents?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">사진 첨부</label>
        <div class="col-sm-5">
            <?php if($list->img == "") { ?>
                없음
            <?php } else { ?>
                <img src="/application/controllers/uploads/<?=$list->img?>" width="300"/>
            <?php } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">등록일</label>
        <div class="col-sm-5">
            <?=$list->bdate?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">조회수</label>
        <div class="col-sm-5">
            <?=$list->count?>
        </div>
    </div>
</div>

<div class="col-sm-offset-4">
    <?php if($_SESSION['login_rank'] == "admin" || $_SESSION['login_id'] == $list->id){ ?>
        <button class="btn btn-primary" onclick="location.href='/project/boardUpdate_form?bnum=<?=$list->bnum?>'">수정</button>
        <button class="btn btn-danger" onclick="location.href='/project/boardDelete?bnum=<?=$list->bnum?>'">삭제</button>
    <?php } ?>
    <button class="btn btn-default" onclick="location.href='/project/board'">목록으로</button>
</div>

<br><br><br>

<div class="col-sm-12 form-horizontal" style="margin: 0% 0% 3% 0%">
    <div class="form-group">
        <form action="/project/cInsert" method="post">
            <label class="col-sm-2 control-label">댓글 작성</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="contents" name="contents">
            </div>
            <div class="col-sm-2">
    <!--            <button class="btn btn-success" onclick="c_insert()">등록</button>-->
                <input type="submit" class="btn btn-success" value="등록">
            </div>
        </form>
    </div>

    <!-- 댓글 출력 -->
    <div class="col-sm-12 form-horizontal" id="commentArea">
        <?php for($i=0; $i<sizeof($cList); $i++){ ?>

            <div class="form-group">
                <label class="col-sm-2 control-label"> <?=$cList[$i]["id"]?> </label>
                <div class="col-sm-5">
                    <?=$cList[$i]["contents"]?>
                    <br>
                    <?=$cList[$i]["cdate"]?>
                </div>
                <?php if($_SESSION['login_rank'] == "admin" || $_SESSION['login_id'] == $cList[$i]["id"]){ ?>
<!--                    <button onclick="c_delete(this)" data-cnum=--><?//=$cList[$i]["cnum"]?><!--삭제</button>-->
                    <button onclick="location.href='/project/cDelete?bnum=<?=$cList[$i]["bnum"]?>&cnum=<?=$cList[$i]["cnum"]?>'">삭제</button>
                <?php } ?>

                <button data-toggle="collapse" data-target="#collapse1<?=$cList[$i]["cnum"]?>" aria-expanded="false" aria-controls="collapse1">댓글 입력</button>
                <button data-toggle="collapse" data-target="#collapse2<?=$cList[$i]["cnum"]?>" aria-expanded="true" aria-controls="collapse2">댓글 닫기</button>
            </div>

            <!-- re댓글 입력 -->
            <div class="form-group collapse" id="collapse1<?=$cList[$i]["cnum"]?>">
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

            <!-- re댓글 보기 -->
            <div class="form-group collapse in" style="margin-left: 5%" id="collapse2<?=$cList[$i]["cnum"]?>">
                <?php for($j=0; $j<sizeof($reList); $j++){
                    if($cList[$i]["cnum"] == $reList[$j]["cnum"]){?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> <?=$reList[$j]["id"]?> </label>
                            <div class="col-sm-5">
                                <?=$reList[$j]["contents"]?><br>
                                <?=$reList[$j]["redate"]?>
                            </div>
                            <?php if($_SESSION['login_rank'] == "admin" || $_SESSION['login_id'] == $reList[$j]["id"]){ ?>
<!--                                <button onclick="re_delete(this)" data-renum=--><?//=$reList[$j]["renum"]?><!-- data-cnum=--><?//=$reList[$j]["cdate"]?><!-- style="{%display%}">삭제</button>-->
                                <button onclick="location.href='/project/redelete?bnum=<?=$reList[$j]["bnum"]?>&renum=<?=$reList[$j]["renum"]?>'">삭제</button>
                            <?php } ?>
                        </div>
                    <?php }
                } ?>
            </div>
        <?php } ?>
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

</body>
</html>