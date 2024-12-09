<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>物件内見予約フォーム</title>
    
</head>
<body>  
<h1 class="center-title">あなたの予約内容</h1>  
<div id="appointment-list">
</div>


    <h2 class="center-form-text">予約の変更の際にはもう一度情報の再入力をお願いします</h2>
    <h2 class="center-form-info">複数回の予約の変更は極力ご遠慮してください</h2>
    <form id="appointment-form">
    @csrf
    <label for="customerName">お名前:</label>
    <input type="text" name="customerName" id="customerName">

    <label for="appointmntDate">予約日:</label>
    <input type="date" name="appointmntDate" id="appointmntDate">

    <label for="appointmntTime">予約時間:</label>
    <input type="time" name="appointmntTime" id="appointmntTime">

    <label for="phoneNumber">電話番号:</label>
    <input type="text" name="phoneNumber" id="phoneNumber">

    <label for="email">メールアドレス:</label>
    <input type="email" name="email" id="email">

    <label for="detail">詳細:</label>
    <textarea name="detail" id="detail"></textarea>

    <button type="submit" class="btn btn-primary">予約を変更する</button>

    <h2 class="center-form-text">予約の取り消しは下記からお願いします</h2>
    <button type="button" class="btn btn-danger" id="delete-button">予約を取り消す</button>
 
</form >

<script src="{{ asset('js/appointment/update.js') }}"></script>
<script src="{{ asset('js/appointment/delete.js') }}"></script>
<script src="{{ asset('js/appointment/detail.js') }}"></script>
</body>
</html>
