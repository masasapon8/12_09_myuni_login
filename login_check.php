<?php
// var_dump($_POST);
// exit;

session_start();
include('function.php');

$pdo = connect_to_db();
$userid = $_POST['userid'];
$password = $_POST['password'];


$sql = 'SELECT * FROM member_table WHERE userid=:userid AND password=:password';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

$status = $stmt->execute();



$val = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$val) { // 該当データがないときはログインページへのリンクを表示
    echo "<p>ログイン情報に誤りがあります.</p>";
    echo '<a href="login.php">login</a>';
    exit();
} else {
    $_SESSION = array(); // セッション変数を空にする
    $_SESSION["session_id"] = session_id();
    $_SESSION["userid"] = $val["userid"];
    $_SESSION["gender"] = $val["gender"];
    $_SESSION["brand"] = $val["brand"];
    $_SESSION["color"] = $val["color"];
    header("Location:manekin.php"); // 一覧ページへ移動
    exit();
}
