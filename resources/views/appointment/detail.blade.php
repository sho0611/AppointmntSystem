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
<div id="appointment-list">
</div>


<script src="{{ asset('js/appointment/update.js') }}"></script>
<script src="{{ asset('js/appointment/delete.js') }}"></script>
<script src="{{ asset('js/appointment/detail.js') }}"></script>
</body>
</html>
