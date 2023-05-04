<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .text{
            position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
        }

        .check-btn{
    background-color: black;
  color: white;
  width: 125px; /*ボタンの幅を設定*/
  height: 30px; /*ボタンの高さを設定*/
  border-radius: 5px; /*ボタンの角を丸める*/
  display: block; /*ブロック要素として扱う*/
  margin: 0 auto; /*左右のマージンを自動で設定*/
  margin-top:425px;
  font-size:12.5px;
}

    </style>
</head>
<body>
<p class='text'>ご意見いただきありがとうございました。</p>
<form action="{{ route('index') }}" method="get">
    @csrf
    <button class="check-btn" type="submit" name="action" value="submit">トップページへ</button>
</form>
</body>
</html>