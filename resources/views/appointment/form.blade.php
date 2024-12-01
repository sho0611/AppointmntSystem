<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>物件予約フォーム</title>
    
</head>
<body>  
<h1 class="center-title">内見予約フォーム</h1>
<h2 class="center-subtitle">以下の物件の内見を予約する</h2>

    <div id="property-details">

    </div>
    <h2 class="center-form-text">ご予約者様情報をご入力ください。</h2>
    <h2 class="center-form-info">メールアドレスは必須ではございませんが、ご入力いただけますと、予約通知とともに予約内容をお送りします。ご予約の変更や確認も、メールから行うことができます。</h2>
    <form id="appointment-form">
    @csrf
    <label for="customerName">お名前:</label>
    <input type="text" name="customerName" id="customerName" required>

    <label for="appointmntDate">予約日:</label>
    <input type="date" name="appointmntDate" id="appointmntDate" required>

    <label for="appointmntTime">予約時間:</label>
    <input type="time" name="appointmntTime" id="appointmntTime" required>

    <label for="phoneNumber">電話番号:</label>
    <input type="text" name="phoneNumber" id="phoneNumber" required>

    <label for="email">メールアドレス:</label>
    <input type="email" name="email" id="email">

    <label for="detail">詳細:</label>
    <textarea name="detail" id="detail" required></textarea>

    <button type="submit" id="confirm-button">予約内容を確認する</button>
    <h2 class="center-denger" id="confirmation-message" style="display: none;">
        まだ予約は確定されておりません。下記に予約内容が表示されます。確認の上, 予約の確定をお願いいたします
    </h2>

</form >

<div id="confirmation" style="display:none;" class="confirmation-text">
    <h2>予約内容の確認</h2>
    <p><strong>お名前:</strong> <span id="confirm-customerName"></span></p>
    <p><strong>予約日:</strong> <span id="confirm-appointmntDate"></span></p>
    <p><strong>予約時間:</strong> <span id="confirm-appointmntTime"></span></p>
    <p><strong>電話番号:</strong> <span id="confirm-phoneNumber"></span></p>
    <p><strong>メールアドレス:</strong> <span id="confirm-email"></span></p>
    <p><strong>詳細:</strong> <span id="confirm-detail"></span></p>
    <button id="confirm-button">予約を確定する</button>
</div>

<script src="{{ asset('js/appointment/form.js') }}"></script>
</body>
</html>
