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
<body>
<h1>회원가입 페이지</h1>
<h5>* 표시는 반드시 입력해야 하는 항목입니다.</h5>
<br><br><br>

<form class="col-sm-12 form-horizontal" action="/project/join" name="join_form" method="post">

    <div class="form-group">
        <label class="col-sm-2 control-label">* ID</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="id" name="id" placeholder="Id" onkeyup="id_check(this.value)">
        </div>
        <span id="id_msg">5글자 이상 영문 또는 숫자를 입력해주세요.</span>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* Password</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" onkeyup="password_check(this.value)">
        </div>
        <span id="pw_msg">8자 이상, 영문, 숫자, 특수문자를 모두 하나 이상 사용하세요.</span>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* Password 확인</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Password 확인" onkeyup="password2_check()">
        </div>
        <span id="pw2_msg"></span>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* 이름</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="name" name="name" placeholder="이름">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* 생년월일</label>
        <div class="col-sm-2">
            <input type="date" class="form-control" id="birth" name="birth">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* 핸드폰 번호</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="'-'를 포함해서 입력해주세요" onkeyup="phone_check(this.value)">
        </div>
        <span id="phone_msg"></span>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">* 이메일 주소</label>
        <div class="col-sm-2">
            <input type="email" class="form-control" id="email" name="email">
        </div>
    </div>

    <div class="col-sm-offset-2 col-sm-10">
<!--        <button type="submit" class="btn btn-primary">확인</button>-->
        <button type="button" class="btn btn-primary" onclick="join()">확인</button>
        <button type="button" class="btn btn-default" onclick="location.href='/project'">취소</button>
    </div>
</form>

<span id="id_success"></span>
<span id="pw_success"></span>
<span id="pw2_success"></span>
<span id="phone_success"></span>
<span id="test_success"></span>

<!--유효성 에러표시-->
<?php echo validation_errors(); ?>

</body>

<script>
//    아이디 중복, 유효성 검사
    function id_check(id){
        $("#id_success").val("");
        $.ajax({
            type: "post",
            url: "/rest/check/id_check",
            data: {"id": id},
            dataType: "json",
            success: function (data) {
                $("#id_msg").html(data['msg']);
                $("#id_success").val(data['result']);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

//    비밀번호 정규식 확인
    function password_check(password){
        $("#pw_success").val("");
        $.ajax({
            type: "post",
            url: "/rest/check/password_check",
            data: {"password": password},
            dataType: "json",
            success: function (data) {
                $("#pw_msg").html(data['msg']);
                $("#pw_success").val(data['result']);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

//    비밀번호 일치확인
    function password2_check(){
        $("#pw2_success").val("");
        $.ajax({
            type: "post",
            url: "/rest/check/password2_check",
            dataType: "json",
            data: {
                "password" : $('#password').val(),
                "password2" : $('#password2').val()
            },
            success: function (data) {
                $("#pw2_msg").html(data['msg']);
                $("#pw2_success").val(data['result']);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

//    핸드폰번호 확인
    function phone_check(phone){
        debugger;
        $("#phone_success").val("");
        $.ajax({
            type: "post",
            url: "/rest/check/phone_check",
            data: {"phone": phone},
            dataType: "json",
            success: function (data) {
                debugger;
                $("#phone_msg").html(data['msg']);
                $("#phone_success").val(data['result']);
            },
            error: function (xhr, status, error) {
                alert("ajax 실패" + error);
            }
        });
    }

//    등록
    function join(){
        $id_success = $('#id_success').val();
        $pw_success = $('#pw_success').val();
        $pw2_success = $('#pw2_success').val();
        $phone_success = $('#phone_success').val();

        if($id_success=="true" && $pw_success=="true" && $pw2_success=="true" && $phone_success=="true"){
            join_form.submit();
        } else {
            alert("회원가입 조건을 만족해야 합니다.");
        }
    }



</script>
</html>
