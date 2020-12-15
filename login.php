<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
</head>

<body>
    <form action="login_check.php" method="POST">
        <fieldset>
            <legend>ログイン情報を入力してください</legend>
            <h1>ログインページ</h1>

            <div>
                ユーザーID：<input type="text" name="userid" />
            </div>
            <div>
                パスワード：<input type="password" name="password" />
            </div>
            <div class="userlogin" method="POST">
                <input type="submit" name="login" value="ログイン" />
            </div>

        </fieldset>
    </form>
</body>

</html>