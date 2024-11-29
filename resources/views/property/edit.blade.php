<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>物件情報一覧</title>
</head>
<body>
    <h1>以下の物件を編集する</h1>
    <div id="property-details">
    </div>

    <h2>以下のように編集する</h1>
    <form id="property-form">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">物件名</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">物件説明</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>


        <button type="submit" class="btn btn-primary">編集する</button>
        <button type="button" class="btn btn-danger" id="delete-button">削除する</button>
    </form> 
    
    <script src="{{ asset('js/property/edit.js') }}"></script>
</body>
</html>


