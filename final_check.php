<?php
include('function.php');
// var_dump($_POST);
// exit();


$sql = 'SELECT * FROM member_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
    foreach ($result as $record) {
        $output .= "<tr>";
        $output .= "<td>{$record["userid"]}</td>";
        $output .= "<td>{$record["password"]}</td>";
        $output .= "<td>{$record["gender"]}</td>";
        $output .= "<td>{$record["brand"]}</td>";
        $output .= "<td>{$record["color"]}</td>";
        $output .= "</tr>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>入力情報のご確認</title>
</head>

<body>
    <form action="register_success.php" method="POST">
        <fieldset>

            <legend>ご入力情報は以下でよろしいでしょうか。</legend>
            <tbody>
                <!-- ↓に<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
                <!--  -->
                <?= $record["userid"] ?><br>
                <?= $record["password"] ?><br>
                <?= $record["gender"] ?><br>
                <?= $record["brand"] ?><br>
                <?= $record["color"] ?><br>
            </tbody>
            <input type="submit" value="この内容で登録する">

            <!-- formタグで囲って送信先を指定してあげる必要があるね -->
        </fieldset>
    </form>
</body>

</html>
<!-- 20201213 とりあえずできてるんだけど、今までの入力データも -->
<!-- 全て表示される仕様になってしまっているなう -->