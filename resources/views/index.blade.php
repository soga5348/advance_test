<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCt4RTYTIZi4TK1ar8GhalkqgT50Nopf6M&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#postal_code').on('blur', function(){
            var postalCode = $(this).val().replace('-', '');
            $.ajax({
                url: '/address/'+postalCode,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $('#address').val(response.address);
                }
            });
        });
    });
</script>

    <title>Document</title>
    <style>

        .main-title{
    font-family: 'Cabin', sans-serif;
    font-size:30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

        .input1{
            height:30px;
            width:200px;
            border: 2px solid silver;
            border-radius: 4px;
        }

        .input{
            height:30px;
            width:400px;
            border: 2px solid silver;
            border-radius: 4px;
            margin-left:50px;
        }

        .example{
            color:silver;
            margin-left:10%;
        }

        .mark{
            color:red
        }

        .gender{
            margin-bottom:20px;
        }

        .gender {
  display: inline-block;
  vertical-align: middle;
  
}
.gender {
  display: inline-block;
  vertical-align: middle;
  line-height: 35px;
}


.gender1{
    margin-bottom

}


input[type="radio"] {
            appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  border: 1px solid #ccc;
  vertical-align: middle;
    cursor: pointer;
    margin-left:40px;
}

input[type="radio"]:checked {
}

input[type="radio"]:checked::after {
  content: "";
  display: block;
  width: 50%;
  height: 50%;
  border-radius: 50%;
  background-color: #000;
  margin-top:6.5px;
  margin-left:6.5px;
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

textarea {
  width: 80%; /*横幅を100%に設定*/
  height: 200px; /*高さを設定*/
  border: 2px solid silver;
            border-radius: 4px;
            display: block;
  margin: -20px 0 0 65px;
}

.advice{
    display: block;
}



.gender1{
    margin-top:-20px;
}

.gender{
    margin-bottom:20px;
}


    </style>
</head>
<body onload="initialize()" class='body'>
    <h1 class="main-title">お問い合わせ</h1>
    <form action="{{ route('store') }}" method="post">
        @csrf <!-- LaravelのCSRF保護機能を有効にするために、フォームにCSRFトークンを追加する必要があります -->
    
        <label>お名前<span class='mark'>*</span></label>
    <input class='input1' type='text' name='firstname' >
    
    <input class='input1' type='text' name='lastname' ><br>
    @error('firstname')
    <div class="error-message" style="color: red;">{{ $message }}</div>
    @enderror
    @error('lastname')
    <div class="error-message" style="color: red;">{{ $message }}</div>
    @enderror
    <p class='example'>例）山田 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 例）太郎</p><br>
    <label class=gender1>性別<span class='mark'>*</span></label>
    <label>
        <input type="radio" name="gender[]" value="male" {{ old('gender.0', 'male') == 'male' ? 'checked' : '' }}>
        <span class='gender'>男性</span>
    </label>
    <label>
        <input type="radio" name="gender[]" value="female" {{ old('gender.0', 'male') == 'female' ? 'checked' : '' }}>
        <span class='gender'>女性</span>
    </label><br>
    <label> メールアドレス<span class='mark'>*</span></label>
    <input class='input' type="email" name="email" id="email" >
    @error('email')
    <div class="error-message" style="color: red;">{{ $message }}</div>
    @enderror
    <p class='example'>例）test@example.com</p><br>
    <label>郵便番号<span class='mark'>*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;〒</label>
<input class='input' type="text" name="postal_code" id="postal_code" pattern="[0-9]{3}-[0-9]{4}" onchange="codeAddress()" >
@error('postal_code')
    <div class="error-message" style="color: red;">{{ $message }}</div>
    @enderror
<p class='example'>例）123<span class='mr-20'></span>-4567</p><br>
<label>住所<span class='mark'>*</span></label>
<input class='input' type='text' name='address' id="address">
@error('address')
    <div class="error-message" style="color: red;">{{ $message }}</div>
    @enderror
<p class='example'>例）東京都渋谷区千駄ヶ谷1-2-3</p><br>

    <label>建物名</label>
    <input class='input' type='text' name='building'>
    <p class='example'>例）千駄ヶ谷マンション101</p><br>
    <label for='option' class='advice'>ご意見<span class='mark'>*</span></label>
    <textarea id='option' name='message'></textarea><br>
    @error('message')
    <div class="error-message" style="color: red;">{{ $message }}</div>
    @enderror
    <button class=check-btn type="submit">確認</button>
</form>




</body>
</html>