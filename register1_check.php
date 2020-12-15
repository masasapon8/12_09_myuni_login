<!-- あくまでもregister1 を受け取って処理する裏側の仕組み -->
<!-- なので表にもhtmlなどで表示はされない部分です -->
<?php

include('function.php');
// セッション情報の取得


$userid = $_POST['userid']; // 送信元ファイルのname属性を指定
$password = $_POST['password'];
$gender = $_POST['gender'];
$brand = $_POST['brand'];
$color = $_POST['color'];

// DB接続関数
$pdo = connect_to_db();

// ユーザ存在有無確認
$sql = 'SELECT COUNT(*) FROM member_table WHERE userid=:userid';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}

if ($stmt->fetchColumn() > 0) {
    // user_idが1件以上該当した場合はエラーを表示して元のページに戻る
    // $count = $stmt->fetchColumn();
    echo "<p>すでに登録されているユーザです．</p>";
    echo '<a href="register1.php">register</a>';
    exit();
}
// 入力チェック(未入力の場合は弾く,commentのみ任意)
$sql = 'INSERT INTO member_table(id, userid, password, gender, brand, color) VALUES(NULL, :userid, :password, :gender, :brand, :color)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
$stmt->bindValue(':color', $color, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:register_success.php");
    exit();
}

?>

<!-- ここはデータを受け取るファイルになるので $_POST みたいな書き方になる -->

<!-- ここはregister1.php の入力内容に不備ないかを確認して -->
<!-- DBに格納し問題なければregister2へ飛ばす処理を書いてあげる場所 -->


<!-- 情報入力が漏れないことを確認しボタンが押されてたら -->
<!-- register2.php に飛んで「お好み」を入力するフォームを表示してあげる -->