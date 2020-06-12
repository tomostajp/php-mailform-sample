<?php
session_start();

// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
    header('Location: index.php');
    exit();
} else {
    $post = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // メールを送信する
    $to = 'me@example.com';
    $from = $post['email'];
    $subject = 'お問い合わせが届きました';
    $body = <<<EOT
名前： {$post['name']}
メールアドレス： {$post['email']}
内容：
{$post['contact']}
EOT;
    // var_dump($body);
    // exit();
    //mb_send_mail($to, $subject, $body, "From: {$from}");

    // セッションを消してお礼画面へ
    unset($_SESSION['form']);
    header('Location: thanks.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>
<body>
    <!-- お問合せフォーム画面 -->
    <div class="container">
        <form action="" method="POST">
            <p>お問い合わせ</p>
            <div class="form-group">
                <div class="row">
                    <div class="col-3">
                        <label for="inputName">お名前</label>
                    </div>
                    <div class="col-9">
                        <p class="display_item"><?php echo htmlspecialchars($post['name']); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-3">
                        <label for="inputEmail">メールアドレス</label>
                    </div>
                    <div class="col-9">
                        <p class="display_item"><?php echo htmlspecialchars($post['email']); ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-3">
                        <label for="inputContent">お問い合わせ内容</label>
                    </div>
                    <div class="col-9">
                        <p class="display_item"><?php echo nl2br(htmlspecialchars($post['contact'])); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9 offset-3">
                    <a href="index.php">戻る</a>
                    <button type="submit">送信する</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>