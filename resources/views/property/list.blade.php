<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物件情報一覧</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <h1>物件情報一覧</h1>
    <button id="add-property-btn" class="add-property-btn">物件を追加する</button>
    <div id="properties-list">
    </div>

    <script src="{{ asset('js/property/list.js') }}"></script>
</body>
</html>

