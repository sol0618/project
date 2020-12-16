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
<style>
    #first{
        font-weight: bold;
        background-color: gray;
    }

    .titleClass{
        font-width: bold;
        background-color: cornflowerblue;
    }

    .titleClass2{
        font-width: bold;
        background-color: goldenrod;
    }
</style>

<body>
<h3>DB연동 테이블(ajax)</h3>

<!-- 데이터 입력-->
<div id="a_insert">
    <input type="text" id="a_number" name="number" placeholder="순번입력">
    <input type="text" id="a_title" name="title" placeholder="제목입력">
    <input type="hidden" id="a_count" name="count" value="0">
    <button onclick="check()">ajax 입력</button>
</div>

<!-- 조건(제목) 검색 -->
<div>
    <select id="a_select" name="select">
        <option value="">검색조건</option>
        <option value="t">제목</option>
    </select>
    <input type="text" id="a_keyword" name="keyword" placeholder="키워드">
    <button onclick="select()">ajax 검색</button>
</div>

<!-- 번호 선택해서 수정 -->
<div>
    <input type="text" id="update_number" name="number" placeholder="수정할 번호 선택">
    <input type="text" id="update_title" name="title" placeholder="수정할 제목입력">
    <button onclick="update()">ajax 수정</button>
</div>

<br>
<table class="table">
    <thead>
    <tr id="first">
        <th>번호</th>
        <th>제목</th>
        <th>조회수</th>
        <th>등록일</th>
        <th></th>
    </tr>
    </thead>
    <tbody id="a_tbody">
<!--        --><?php
//        var_dump($list);
//        ?>

        <?php foreach ($list as $data){ ?>
            <tr>
                <td><?=$data->number?></td>
                <td><?=$data->title?></td>
                <td><?=$data->count?></td>
                <td><?=$data->date?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/html" id="tableTrHtml">
    <div>
        <tr>
            <td>{%number%}</td>
            <td>{%title%}</td>
            <td>{%count%}</td>
            <td>{%date%}</td>
            <td>
                <button onclick="a_delete(this)" data-date="{%date%}">ajax 삭제</button>
            </td>
        </tr>
    </div>
</script>

<script>
    //번호 중복확인
    function check(){
        var jdata = new Object();
        jdata.number = $('#a_number').val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type: "post",
            url: "/test1/check",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                if(data == "true"){
                    insert();
                } else {
                    alert("이미 있는 글 번호입니다.");
                }
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //입력
    function insert() {
        var jdata = new Object();
        jdata.number = $('#a_number').val();
        jdata.title = $('#a_title').val();
        jdata.count = $('#a_count').val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type: "post",
            url: "/test1/insert",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    resultHtml += tempHtml.split("{%number%}").join(data[i]["number"])
                        .split("{%title%}").join(data[i]["title"])
                        .split("{%count%}").join(data[i]["count"])
                        .split("{%date%}").join(data[i]["date"]);
                }
                $("#a_tbody").html(resultHtml);
                $('#a_number').val("");
                $('#a_title').val("");
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //제목 검색
    function select(){
        var jdata = new Object();
        jdata.select = $('#a_select').val();
        jdata.keyword = $('#a_keyword').val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type : "post",
            url : "/test1/select",
            data : {data : data},
            dataType : "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    resultHtml += tempHtml.split("{%number%}").join(data[i]["number"])
                        .split("{%title%}").join(data[i]["title"])
                        .split("{%count%}").join(data[i]["count"])
                        .split("{%date%}").join(data[i]["date"]);
                }
                $("#a_tbody").html(resultHtml);
                $('#a_number').val("");
                $('#a_title').val("");
            },
            error : function (xhr, status, error){
                alert("ajax 실패" + error);
            }
        });
    }

    //수정
    function update(){
        var jdata = new Object();
        jdata.number = $('#update_number').val();
        jdata.title = $('#update_title').val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type: "post",
            url: "/test1/update",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    resultHtml += tempHtml.split("{%number%}").join(data[i]["number"])
                        .split("{%title%}").join(data[i]["title"])
                        .split("{%count%}").join(data[i]["count"])
                        .split("{%date%}").join(data[i]["date"]);
                }
                $("#a_tbody").html(resultHtml);
                $('#update_number').val("");
                $('#update_title').val("");
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

    //삭제
    function a_delete(element) {
        var jdata = new Object();
        jdata.date = $(element).data("date");
        var data = JSON.stringify(jdata);

        $.ajax({
            type: "post",
            url: "/test1/delete",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    resultHtml += tempHtml.split("{%number%}").join(data[i]["number"])
                        .split("{%title%}").join(data[i]["title"])
                        .split("{%count%}").join(data[i]["count"])
                        .split("{%date%}").join(data[i]["date"]);
                }
                $("#a_tbody").html(resultHtml);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

</script>

</body>
</html>