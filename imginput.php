<?php
try {
    $db = new PDO('mysql:dbname=gsacf_04_09;host=localhost;charset=utf8', 'root', '');
} catch (PDOException $e) {
    print('接続エラー' . $e->getMessage());
}
if (isset($_POST['filename'])) {
    $img = date('YmdHis') . $_FILES['image']['filename'];
    move_uploaded_file($_FILES['image']['filename'], 'image/' . $img);
    var_dump($_FILES);
    exit;

    $image = htmlspecialchars('image/' . $img, ENT_QUOTES);
    if ($_POST['filename'] !== '' || $_POST['gender'] !== '' || $_POST['brand'] !== '' || $_POST['color'] !== '') {
        $message = $db->prepare('INSERT INTO tops_table SET id=?,filename=?,gender=?,brand=?,color=?,image=?');
        $message->execute(array(NULL, $_POST['filename'], $_POST['gender'], $_POST['brand'], $_POST['color'], $image));
        echo "{$_POST['filename']}登録完了！";
    } else {
        echo ('失敗');
    }
} else {
};
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ウェア登録</title>
    <style>
        body {
            padding: 1rem 3rem;
        }

        input {
            width: 500px;
            height: 40px;
            line-height: 40px;
            font-size: 30px;
            margin-bottom: 0.5rem;
        }

        .img {
            font-size: 20px;
        }

        button {
            height: 100px;
            width: 500px;
            font-size: 3rem;
        }
    </style>
</head>

<body>
    <form action="" method="POST" action="/upload" enctype="multipart/form-data">
        <p><input type="text" name="filename" placeholder="ウェア名"></p>
        <p><input type="text" name="gender" placeholder="性別">//男/女</p>
        <p><input type="text" name="brand" placeholder="メーカー"></p>
        <p><input type="text" name="color" placeholder="色"></p>
        <p><input type="file" name="image" class="img"></p>
        <p><button type="submit">登録！</button></p>
    </form>
</body>

</html>