<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>物件予約フォーム</title>
</head>
<body>
    <h1>物件予約フォーム</h1>
    <div id="property-details">

    </div>
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
        <input type="email" name="email" id="email" required>

        <label for="detail">詳細:</label>
        <textarea name="detail" id="detail" required></textarea>

        <button type="submit">予約する</button>
    </form>

    <script src="{{ asset('js/appointment/form.js') }}"></script>
</body>
</html>
