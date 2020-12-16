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
<h3>form</h3>
<!-- 데이터 입력-->
<form action="/test/insert" method="post" id="insert" onsubmit="return prevent(event)">
    <input type="text" id="number" name="number" placeholder="순번입력">
    <input type="text" id="title" name="title" placeholder="제목입력">
    <input type="hidden" name="count" value="0">
    <?php
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d,H:i:s');
        echo "<input type='hidden' name='date' value=$date>";
    ?>
    <input type="submit" value="입력">
<!--    <input type="submit" id="ttt" value="입력">-->
<!--    <input type="submit" onclick="ttt()" value="입력">-->
</form>

<!-- 조건(제목) 검색 -->
<form action="/test/select" method="post">
    <select name="select">
        <option value="">검색조건</option>
        <option value="t">제목</option>
    </select>
    <input type="text" name="keyword" placeholder="키워드">
    <input type="submit" value="검색">
</form>

<!-- 번호 선택해서 수정 -->
<form action="/test/update" method="post">
    <input type="text" id="number" name="number" placeholder="수정할 번호 선택">
    <input type="text" id="title" name="title" placeholder="수정할 제목입력">
    <input type="submit" value="수정">
</form>

<br><br>
<button onclick="add_row()">추가</button>
<button onclick="delete_row()">삭제</button>
<button onclick="time_row()">row 10개 추가</button>
<button onclick="order()">등록일순 정렬(최신순)</button>


<select name="condition" id="condition" onchange="condition(this);">
    <option value="">정렬조건선택</option>
    <option value="title">제목(오름차순)</option>
    <option value="date">날짜(내림차순)</option>
</select>

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
    <tbody id="tbody">
    <?php for($i=0; $i<sizeof($data); $i++){
        $str =  explode(';', $data[$i]); ?>

        <form action="/test/delete" method="post">
            <tr>
                <?php for ($j = 0; $j<sizeof($str); $j++) { ?>
                    <td>
                        <?php echo $str[$j]; ?>
                    </td>
                    <?php echo "<input type='hidden' name='date' value=$str[$j]>"; ?>
                <?php } ?>
                <td>
                    <input type="submit" value="삭제">
                </td>
            </tr>
        </form>
    <?php } ?>
    </tbody>
</table>

<h3>ajax</h3>

<!-- 데이터 입력-->
<div id="a_insert">
    <input type="text" id="a_number" name="number" placeholder="순번입력">
    <input type="text" id="a_title" name="title" placeholder="제목입력">
    <input type="hidden" id="a_count" name="count" value="0">
<!--    --><?php
//    date_default_timezone_set('Asia/Seoul');
//    $date = date('Y-m-d,H:i:s');
//    echo "<input type='hidden' id='a_date' name='date' value=$date>";
//    ?>
    <button onclick="check()">ajax 입력</button>
</div>

<!-- 조건(제목) 검색 -->
<div>
    <select id="a_select" name="select">
        <option value="">검색조건</option>
        <option value="t">제목</option>
    </select>
    <input type="text" id="a_keyword" name="keyword" placeholder="키워드">
    <button onclick="a_select()">ajax 검색</button>
</div>

<!-- 번호 선택해서 수정 -->
<div>
    <input type="text" id="update_number" name="number" placeholder="수정할 번호 선택">
    <input type="text" id="update_title" name="title" placeholder="수정할 제목입력">
    <button onclick="a_update()">ajax 수정</button>
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
    <?php for($i=0; $i<sizeof($data); $i++){
        $str =  explode(';', $data[$i]); ?>

        <form action="/test/delete" name="dataform" method="post">
            <tr>
                <?php for ($j = 0; $j<sizeof($str); $j++) { ?>
                    <td>
                        <?php echo $str[$j]; ?>
                    </td>
                    <?php echo "<input type='hidden' name='date' value=$str[$j]>"; ?>
                <?php } ?>
            </tr>
        </form>
    <?php } ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script>
    // 1) form submit 실행이 안돼게
    // function prevent(e) {
    //     e.preventDefault();
    //     // alert(222);
    // }

    // $("#ttt").on("click", function (e){
    //     e.preventDefault();
    //    alert(1111);
    // });

    // function ttt(e) {
    //     e.preventDefault();
    //     alert(2222);
    // }

    //번호 중복확인
    function check(){
        var jdata = new Object();
        jdata.number = $('#a_number').val();
        var data = JSON.stringify(jdata);
        debugger;

        $.ajax({
            type: "post",
            url: "/test/a_check",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                debugger;
                if(data == "true"){
                    a_insert();
                } else {
                    alert("이미 있는 글 번호입니다.");
                }
            },
            error: function (xhr, status, error) {
                alert("ajax 입력실패" + error);
            }
        });
    }

    //입력
    function a_insert() {
        // 1) form submit 실행이 안돼게
        // 2) 내가 선택해서 form전송, ajax전송

        var jdata = new Object();
        jdata.number = $('#a_number').val();
        jdata.title = $('#a_title').val();
        jdata.count = $('#a_count').val();
        //jdata.date = $('#a_date').val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type: "post",
            url: "/test/a_insert",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml2").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    var list = list;
                    list = data[i].split(";");

                    resultHtml += tempHtml.split("{%number%}").join(list[0])
                        .split("{%title%}").join(list[1])
                        .split("{%count%}").join(list[2])
                        .split("{%date%}").join(list[3]);
                }
                $("#a_tbody").html(resultHtml);
                $('#a_number').val("");
                $('#a_title').val("");
//                $("#a_tbody").html(data);
            },
            error: function (xhr, status, error) {
                alert("ajax 입력실패" + error);
            }
        });
    }

    //제목 검색
    function a_select(){
        var jdata = new Object();
        jdata.select = $('#a_select').val();
        jdata.keyword = $('#a_keyword').val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type : "post",
            url : "/test/a_select",
            data : {data : data},
            dataType : "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml2").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    var list = list;
                    list = data[i].split(";");

                    resultHtml += tempHtml.split("{%number%}").join(list[0])
                        .split("{%title%}").join(list[1])
                        .split("{%count%}").join(list[2])
                        .split("{%date%}").join(list[3]);
                }
                $("#a_tbody").html(resultHtml);
            },
            error : function (xhr, status, error){
                alert("ajax 입력실패" + error);
            }
        });
    }

    //수정
    function a_update(){
        var jdata = new Object();
        jdata.number = $('#update_number').val();
        jdata.title = $('#update_title').val();
        var data = JSON.stringify(jdata);

        $.ajax({
            type: "post",
            url: "/test/a_update",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml2").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    var list = list;
                    list = data[i].split(";");

                    resultHtml += tempHtml.split("{%number%}").join(list[0])
                        .split("{%title%}").join(list[1])
                        .split("{%count%}").join(list[2])
                        .split("{%date%}").join(list[3]);
                }
                $("#a_tbody").html(resultHtml);
                $('#update_number').val("");
                $('#update_title').val("");
            },
            error: function (xhr, status, error) {
                alert("ajax 입력실패" + error);
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
            url: "/test/a_delete",
            data: {data: data},
            dataType: "json",
            success: function (data) {
                var tempHtml = $("#tableTrHtml2").html();
                var resultHtml = "";
                for (var i = 0; i < data.length; i++) {
                    var list = list;
                    list = data[i].split(";");

                    resultHtml += tempHtml.split("{%number%}").join(list[0])
                        .split("{%title%}").join(list[1])
                        .split("{%count%}").join(list[2])
                        .split("{%date%}").join(list[3]);
                }
                $("#a_tbody").html(resultHtml);
            },
            error: function (xhr, status, error) {
                alert("ajax 입력실패" + error);
            }
        });
    }

</script>

<script type="text/html" id="tableTrHtml2">
        <div>
            <tr>
                <td>{%number%}</td>
                <td>{%title%}</td>
                <td>{%count%}</td>
                <td>{%date%}</td>
                <td>
<!--                    <input type="hidden" id="delete_date" name="date" value={%date%}>-->
                    <button onclick="a_delete(this)" data-date="{%date%}">ajax 삭제</button>
                </td>
            </tr>
        </div>
</script>

<script type="text/html" id="tableTrHtml">
    <tr>
        <td>{%index%}</td>
        <td>{%title%}</td>
        <td>{%count%}</td>
        <td>{%date%}</td>
    </tr>
</script>

<script>
    //추가
    var list = new Array();
    function add_row() {
        var number = document.getElementById('number').value;
        var tbody = document.getElementById('tbody');
        var nowTime = new Date();

        if(number == "") {

            // var tbody = $('#tbody');

            var index = tbody.rows.length;
            var row = tbody.insertRow(index);

            var tempData = [];
            tempData['index'] = index;
            tempData['title'] = document.getElementById('title').value;
            tempData['count'] = 0;
            tempData['date'] = nowTime;

            list.push(tempData);

            row.insertCell(0).innerHTML = index + 1;
            var t = row.insertCell(1);
            t.className = 'titleClass';
            t.innerHTML = document.getElementById('title').value;
            row.insertCell(2).innerHTML = '0';
            row.insertCell(3).innerHTML = new Date().toLocaleString();

        } else {
            console.log(number);

            var row = tbody.insertRow(number);

            var tempData = [];
            tempData['index'] = number;
            tempData['title'] = document.getElementById('title').value;
            tempData['count'] = 0;
            tempData['date'] = nowTime;

            list.push(tempData);

            row.insertCell(0).innerHTML = number;
            var t = row.insertCell(1);
            t.className = 'titleClass2';
            t.innerHTML = document.getElementById('title').value;
            row.insertCell(2).innerHTML = '0';
            row.insertCell(3).innerHTML = new Date().toLocaleString();
        }

    };

    //삭제
    function delete_row() {
        var number = document.getElementById('number').value;
        var tbody = document.getElementById('tbody');

        if(tbody.rows.length<1) {
            alert('삭제할 데이터가 없습니다.');
        } else if(number == "") {
            tbody.deleteRow(tbody.rows.length-1);
        } else {
            tbody.deleteRow(number-1);
        }
    };

    //1초당 1개의 row 가 10번 추가
    function time_row(){
        var i=1;

        var timer = setInterval(function (){
            add_row();
            i++;
            if(i>10){
                clearInterval(timer);
            };
        }, 1000);
    };

    //등록일순으로 정렬
    function order(){
        var compareList = list;
        $("#tbody").html("");
        debugger;

        //var resultList = [];
        compareList.sort(function (a,b){
            return b.date - a.date;
        });

        // index: 0, title: "", count: 0, date: Wed Nov 18 2020 18:08:44 GMT+0900 (대한민국 표준시)
        var tempHtml = $("#tableTrHtml").html();
        var resultHtml = "";
        for (var i = 0; i < compareList.length; i++) {
            resultHtml += tempHtml.split("{%index%}").join(compareList[i]['index'])
                .split("{%title%}").join(compareList[i]['title'])
                .split("{%count%}").join(compareList[i]['count'])
                .split("{%date%}").join(compareList[i]['date'].toLocaleString());
            //.split("{%date%}").join(compareList[i]['date'].toLocaleDateString());
        }
        $("#tbody").html(resultHtml);
    };

    //조건선택
    function condition(condition){
        var c = condition[condition.selectedIndex].value;
        if(c == "title"){
            var compareList = list;
            $("#tbody").html("");

            compareList.sort(function (a,b){
                const A = a.title.toUpperCase();
                const B = b.title.toUpperCase();

                if(A > B) return 1;
                if(A < B) return -1;
                if(A == B) return 0;
            });

            var tempHtml = $("#tableTrHtml").html();
            var resultHtml = "";
            for (var i = 0; i < compareList.length; i++) {
                resultHtml += tempHtml.split("{%index%}").join(compareList[i]['index'])
                    .split("{%title%}").join(compareList[i]['title'])
                    .split("{%count%}").join(compareList[i]['count'])
                    .split("{%date%}").join(compareList[i]['date'].toLocaleString());
                //.split("{%date%}").join(compareList[i]['date'].toLocaleDateString());
            }
            $("#tbody").html(resultHtml);
        };

        if(c == "date"){
            order();
        };
    };

</script>

</body>
</html>