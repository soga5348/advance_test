<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>確認画面</title>
</head>
<style>
.main-title {
text-align: center;
padding-bottom:50px;
}

th{
    font-size: 20px;
    padding-bottom:75px;
}

td{
    font-size: 20px;
    padding-bottom:75px;
    padding-left:100px;
}

.check-btn{
    background-color: black;
  color: white;
  width: 100px; /*ボタンの幅を設定*/
  height: 25px; /*ボタンの高さを設定*/
  border-radius: 5px; /*ボタンの角を丸める*/
  display: block; /*ブロック要素として扱う*/
  margin: 0 auto; /*左右のマージンを自動で設定*/
  margin-top:100px;
}

.repair{
    color:black;
    display: flex;
    justify-content: center;
    padding-top:5px;
}


.gender{
}

</style>

<body class='body'>
    <h1 class="main-title">内容確認</h1>
    <table>
        <tr>
            <th class="name">お名前</th>
            <td>{{ $contact->firstname }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $contact->lastname }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td class="gender">
                @if(is_array($contact->gender))
                    {{ implode(', ', $contact->gender) }}
                @else
                {{ $contact->gender === 'male' ? '男性' : '女性' }}
                @endif
            </td>
        </tr>
        
        <tr>
            <th>メールアドレス</th>
            <td>{{ $contact->email }}</td>
        </tr>
        <tr>
            <th>郵便番号</th>
            <td>{{ $contact->postal_code }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $contact->address }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $contact->building }}</td>
        </tr>
        <tr>
            <th>ご意見</th>
            <td>{{ $contact->message }}</td>
        </tr>
    </table>
    <form action="{{ route('thanks') }}" method="get">
        @csrf
        <button class="check-btn" type="submit" name="action" value="submit">送信</button>
    </form>
    <a class="repair" href="javascript:history.back()">修正する</a>

</body>
