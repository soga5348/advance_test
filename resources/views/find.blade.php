<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-t/RSOtPlsR04J1ZZ8dN7VFdfwzUPu+RtvcIJzXlB7VQJhrap3q7GJfDLZDxJjhOecpY4Yej+4A9JHkG0krvntQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>管理画面</title>
</head>
<style>

.pagination {
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin-right:50px;
}

.pagination a, .pagination span {
  padding: 7px 10px;
  border: 1px solid #000;
  margin: px;
}

.pagination a:hover {
  background-color: #eee;
}

.pagination .disabled {
  color: #bbb;
}

.pagination .current {
  font-weight: bold;
}


a{
  text-decoration: none;
}

.main-title {
  text-align: center; /* 横軸の中央に要素を配置 */
}


.col-md-6{
margin-top:-60spx;
margin-left:300px;
}

.input{
            height:35px;
            width:225px;
            border: 2px solid silver;
            border-radius: 4px;
        }

.label{
  margin-left:70px;
  margin-right:100px;
}

.label-mail{
  margin-left:70px;
  margin-right:20px;
}

.label-gender{
  margin-left:170px;
}

.form-group{
  margin-top:-10px;
  white-space: nowrap;
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


.form-group{
  margin-left:350px;
  margin-top:-40px;
}

.registerd-date{
margin-top:50px;
}

.registerd-date2{
  height:35px;
            width:225px;
            border: 2px solid silver;
            border-radius: 4px;
            margin:-30px 0 0 520px;
            position:relative;
            top:-27.5px;
            
}

.registerd-date3{
  margin:-30px 0 0 485px;
}

.input-mail{
  height:35px;
            width:225px;
            border: 2px solid silver;
            border-radius: 4px;
            margin-left:15px;
            margin-top:15px;
}

.check-btn{
    background-color: black;
  color: white;
  width: 100px; /*ボタンの幅を設定*/
  height: 35px; /*ボタンの高さを設定*/
  border-radius: 5px; /*ボタンの角を丸める*/
  display: block; /*ブロック要素として扱う*/
  margin-top:50px;

}

.btn-area{
  display:flex;
  justify-content: center;
  margin-left:40px;
}

.check-btn2{
   color:black;
   margin-top:100px;
   position:relative;
   right:75px;
}

.a {
  border: 2px solid black;
  padding: 20px; /* 必要に応じて余白を追加 */
}

main{
  border: 2px solid black;
  padding: 20px;
}

table {
  border-collapse: separate;
  border-spacing: 50px;
  position: relative;
}

body::before {
  content: '';
  position: absolute;
  top: 0;
  left: 1%;
  width: 98%;
  border-top: 2px solid black;
  top:660px;

}

.delete-btn {
  display: inline-block; /* インラインブロックに変更 */
  margin-left: 150px; /* 余白を追加 */
  background-color: black;
  color: white;
  width: 100px;
  height: 35px;
  border-radius: 5px;
  /* ボタンの角を丸める*//*ブロック要素として扱う*/
}

.ellipsis {
    display: inline-block;
    max-width: 250px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .full-text {
    display: none;
  }

td{
  white-space: nowrap;
}



.page-item a {
  border-color: gray;
  color:black;
}





</style>
<body>
    <!-- find.blade.php -->
<h2 class="main-title">管理システム</h2>
<main>
    <form action="{{ route('message') }}" method="GET" id="search-form">
        <div>
          <label class='label' for="name">お名前</label>
          <input class="input" type="text" id="name" name="name">
        </div>
        <div class="form-group">
          <label class='label-gender' for="gender">性別</label>
              <label for="gender_all">
                  <input type="radio" id="gender_all" name="gender" value="all" checked>
                  全て
              </label>
              <label for="gender_male">
                  <input type="radio" id="gender_male" name="gender" value="Male">
                  男性
              </label>
              <label for="gender_female">
                  <input type="radio" id="gender_female" name="gender" value="Female">
                  女性
              </label>
          </div>
      </div>
      
      
      
        <div class="registerd-date">
            <label class='label'>登録日</label>
            <input class="input" type="text" name="start_date" onfocus="this.type='date'" onfocusout="this.type='text'" placeholder=""> <p class="registerd-date3">~</p> <input class="registerd-date2" type="text" name="endjj_date" onfocus="this.type='date'" onfocusout="this.type='text'" placeholder="">
        <div>
          <label class='label-mail' for="email">メールアドレス</label>
          <input class="input-mail" type="email" id="email" name="email">
        </div>
        <div class="btn-area">
          <button class="check-btn" type="submit">検索</button>
          <a href="#" class="check-btn2" onclick="resetForm()" style="text-decoration: underline;">リセット</a>

        </div>
      
      </form>
</main>
      
      <script>
      function resetForm() {
        document.getElementById("search-form").reset();
      }
      </script>
      
      <!-- find.blade.php -->

      @if(isset($messages) && count($messages) > 0)
<table>
    <thead>
      <p>全{{$messages->total()}}件中 {{$messages->firstItem()}} - {{$messages->lastItem()}}件</p>
      <div class="col-md-6">
        <div class="pagination justify-content-end">
            <p class="page-item {{ $messages->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $messages->previousPageUrl() }}" aria-label="Previous"><</a>
            </p>
            @for($i = 1; $i <= $messages->lastPage(); $i++)
                <p class="page-item {{ $i == $messages->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $messages->url($i) }}">{{ $i }}</a>
                </p>
            @endfor
            <p class="page-item {{ $messages->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $messages->nextPageUrl() }}" aria-label="Next">></a>
            </p>
          </div>
          

    </div>
    
    

        <tr>
            <th>ID</th>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>ご意見</th>
        </tr>
        
    </thead>
    <tbody>
      
        @foreach($messages as $message)
        
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->firstname }}{{ $message->lastname }}</td>
                <td>{{ $message->gender === 'Male' ? '男性' : '女性' }}</td>
                <td>{{ $message->email }}</td>
                <td>
                  @if (mb_strlen($message->message) > 25)
                    <span class="ellipsis">{{ mb_substr($message->message, 0, 25) }}...</span>
                    <span class="full-text">{{ $message->message }}</span>
                  @else
                    {{ $message->message }}
                  @endif
                </td>

                <td>
                  <form action="{{ route('delete', $message->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="delete-btn" type="submit">削除</button>
                  </form>
              </td>
            </tr>
        @endforeach
    </tbody>
    
</table>
@elseif(isset($messages) && count($messages) == 0)
    <p>該当するメッセージはありません。</p>
@endif

<script>
  const ellipsisElements = document.querySelectorAll('.ellipsis');
  ellipsisElements.forEach((element) => {
    element.addEventListener('mouseover', () => {
      element.style.display = 'none';
      element.nextElementSibling.style.display
= 'inline';
});
element.nextElementSibling.addEventListener('mouseout', () => {
element.nextElementSibling.style.display = 'none';
element.style.display = 'inline';
});
});
</script>



      

      


</body>
</html>