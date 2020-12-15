<!-- 「ようこそ〜〜さん」みたいなメッセージも合わせて乗っけて -->
<!-- session をちゃんと引き継いでいることを確認して進めたい -->
<?php
session_start(); // セッションの開始
include('function.php'); // 関数ファイル読み込み
check_session_id();

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM member_table';
// $sql = "UPDATE member_table SET gender=:gender, brand=:brand, color=:color WHERE id=:id";

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output = "";
    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
        $output .= "<tr>";
        $output .= "<td>{$record["gender"]}</td>";
        $output .= "<td>{$record["brand"]}</td>";
        $output .= "<td>{$record["color"]}</td>";
        // // edit deleteリンクを追加
        // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
        // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
        // $output .= "</tr>";
    }
    // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
    // 今回は以降foreachしないので影響なし
    unset($value);
}
$n = $_SESSION['brand'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ウェアコーディネート確認ページ</title>
</head>

<body onload="ShowImage();">
    <h1>ようこそ
        <?= $_SESSION['userid'] ?>さん
        <p><?= $_SESSION['gender'] ?></p>
        <p><?= $_SESSION['brand'] ?></p>
        <p><?= $_SESSION['color'] ?></p>

        <!-- Nikeのウェアトップ https://shopping.line-scdn.net/0hk4x857t0NBtFQRzdMAlLTBccKGozMG0MOnkuOTIEdClhdSREe3cufmFCbixteCBNeXdydGlGOSlocXIYKXQrE2FAbS5sdXNFenR7eGFCLyo7JCZFLiYs/r800 -->


    </h1>

    <h2>コーディネート</h2>
    <div class="top">
        <img id="img" name="img">
    </div>
    <script>
        // この辺で変数を代入して条件分岐をしてあげればうまくid引っ張ってきて
        // 条件ごとに画像の表示とかできるんじゃねえか？？


        function ShowImage(n) {
            if (n == 'nike') {
                document.getElementById("img").src = "https://shopping.line-scdn.net/0hk4x857t0NBtFQRzdMAlLTBccKGozMG0MOnkuOTIEdClhdSREe3cufmFCbixteCBNeXdydGlGOSlocXIYKXQrE2FAbS5sdXNFenR7eGFCLyo7JCZFLiYs/r800";
                document.getElementById("img").alt = "nike";
            } else {
                document.getElementById("img").src = "https://images-na.ssl-images-amazon.com/images/I/51HG3EA0LJL._AC_UX679_.jpg";
                document.getElementById("img").alt = "yonex";
            }
        }
        var hoge = <?php echo json_encode($n); ?>;
        console.log(hoge); // はろー
        ShowImage(hoge);
    </script>
</body>

</html>

<!-- sessionがないとそのファイル内のみでしか変数を使うことはできないが -->
<!-- sessionを使うことによってファイル間のデータ引き継ぎが可能になる -->