<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー情報登録画面</title>
</head>

<body>
    <form action="register1_check.php" method="POST">
        <fieldset>
            <legend>初めての方は以下の情報を入力してください(新規登録)</legend>
            <h1>ユーザー情報登録</h1>

            <div>
                ユーザーID：<input type="text" name="userid" />
            </div>
            <div>
                パスワード：<input type="text" name="password" />
            </div>
            <select name="gender">
                <option value="1">男性</option>
                <option value="2">女性</option>
            </select>
            <select name="brand">
                <option value="nike">ナイキ </option>
                <option value="addidas">アディダス</option>
                <option value="yonex">ヨネックス</option>
                <option value="asics">アシックス</option>
            </select>
            <select name="color">
                <option value="black">黒</option>
                <option value="white">白</option>
                <option value="red">レッド</option>
                <option value="blue">ブルー</option>
                <option value="pink">ピンク</option>
            </select>
            <br>
            <input type="submit" name="submit" value="新規登録する" /><br>


        </fieldset>
    </form>
    <form action="not_login.php" method="POST">
        <input type="submit" name="submit" value="情報登録しないでメインページへ行く" />
        ※情報登録をしない場合、関連のないウェア商品などが表示される可能性があります
    </form>
    <br>


    <form action="login.php" method="POST">
        <fieldset>
            <legend>既にアカウントをお持ちの方はこちら</legend>
            <div class="userlogin" method="POST">
                <input type="submit" name="submit" value="ログイン" /><br>
            </div>
        </fieldset>
    </form>
    <form action="not_login.php" method="POST">
        <input type="submit" name="submit" value="ログインしないでメインページへ行く" />
        ※ログイン情報がない場合、関連のないウェア商品などが表示される可能性があります
    </form>
</body>

</html>