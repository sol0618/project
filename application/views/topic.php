<!--        토픽 메인 페이지입니다.-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1><?php echo $heading;?></h1>

<h3>My Todo List</h3>

<ul>
    <?php foreach($todo_list as $item):?>

        <li><?php echo $item;?></li>

    <?php endforeach;?>
</ul>

</body>
</html>