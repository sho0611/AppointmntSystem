<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物件情報一覧</title>
</head>
<body>
    <h1>物件情報一覧</h1>
    <div id="properties-list">
        <!-- 物件情報がここに表示される -->
    </div>

    <script>
        window.onload = function() {
            fetch('http://127.0.0.1:8000/api/viewproperty/get')
                .then(response => response.json())
                .then(data => {
                    const properties = data.properties;
                    let html = '';
                    properties.forEach(property => {
                        html += `
                            <div>
                    <h2><a href="appointmentForm/${property.property_id}">${property.title}</a></h2>
                    
                    <p>${property.description}</p>
                    <p>価格: ¥${property.price}</p>
                    ${property.image_path ? `<img src="http://localhost/storage/${property.image_path}" alt="画像" width="300">` : '<p>画像はありません</p>'}
                    </div>
                    <hr>
                `;
                    });
                    //innerHTMLの時にXSS対策が必要  
                    document.getElementById('properties-list').innerHTML = html;
                })
                .catch(error => console.log('エラーが発生しました:', error));
        }
    </script>
</body>
</html>

