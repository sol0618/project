<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <link href="/application/views/css/member.css" rel="stylesheet">
</head>
<body style="background-color: gainsboro">
<div class="registration-form">
    <h2 style="margin-left: 46.5%; margin-bottom: 1%">회원가입</h2>

    <form class="col-sm-12 form-horizontal" action="/project/join" name="join_form" method="post">
        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="id" name="id" placeholder="ID" onkeyup="id_check(this.value)">
            <span id="id_msg">5글자 이상 영문 또는 숫자를 입력해주세요.</span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control item" id="password" name="password" placeholder="Password" onkeyup="password_check(this.value)">
            <span id="pw_msg">8자 이상, 영문, 숫자, 특수문자를 모두 하나 이상 사용하세요.</span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control item" id="password2" name="password2" placeholder="Password 확인" onkeyup="password2_check()">
            <span id="pw2_msg"></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="name" name="name" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="date" class="form-control item" id="birth" name="birth">
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="phone" name="phone" placeholder="Phone Number" onkeyup="phone_check(this.value)">
            <span id="phone_msg"></span>
        </div>

        <div class="form-group">
            <input type="email" class="form-control item" id="email" name="email" placeholder="Email">
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-block create-account" onclick="join()">Create Account</button>
        </div>
    </form>
    <div class="social-media">
        <h5>Sign up with social media</h5>
        <div class="social-icons">
            카카오 로그인
            <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
            <a href="#"><i class="icon-social-google" title="Google"></i></a>
            <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
        </div>
    </div>
</div>

<span id="id_success"></span>
<span id="pw_success"></span>
<span id="pw2_success"></span>
<span id="phone_success"></span>
<span id="test_success"></span>

<!--유효성 에러표시-->
<?php echo validation_errors(); ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="assets/js/script.js"></script>
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
