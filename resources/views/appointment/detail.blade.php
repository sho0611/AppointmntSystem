<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約変更フォーム</title>
</head>
<body>
    <h1>予約変更フォーム</h1>

    <form action="{{ route('appointments.update', ['appointment' => $appointment->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- 更新メソッドを指定 -->

        <div>
            <label for="name">お名前:</label>
            <input type="text" id="name" name="name" value="{{ $appointment->name }}" required>
        </div>

        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" value="{{ $appointment->email }}" required>
        </div>

        <div>
            <label for="appointment_date">予約日:</label>
            <input type="date" id="appointment_date" name="appointment_date" value="{{ $appointment->appointment_date->toDateString() }}" required>
        </div>

        <div>
            <label for="appointment_time">予約時間:</label>
            <input type="time" id="appointment_time" name="appointment_time" value="{{ $appointment->appointment_time->format('H:i') }}" required>
        </div>

        <div>
            <button type="submit">変更する</button>
        </div>
    </form>

    <form action="{{ route('appointments.cancel', ['appointment' => $appointment->id]) }}" method="POST" onsubmit="return confirm('本当にキャンセルしますか？')">
        @csrf
        @method('DELETE')
        <button type="submit" style="color: red;">予約をキャンセルする</button>
    </form>

</body>
</html>

