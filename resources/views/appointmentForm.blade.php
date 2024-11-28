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

    <script>
        const propertyId = window.location.pathname.split('/')[3];

        fetch(`http://127.0.0.1:8000/api/viewproperty/${propertyId}`)
            .then(response => response.json())
            .then(data => {
                if (data.property) {
                    const property = data.property;
                    document.getElementById('property-details').innerHTML = `
                        <h2>${property.title}</h2>
                        <p>${property.description}</p>
                        <p>価格: ¥${property.price}</p>
                        ${property.image_path ? `<img src="http://localhost/storage/${property.image_path}" alt="画像" width="300">` : '<p>画像はありません</p>'}
                    `;
                } else {
                    document.getElementById('property-details').innerHTML = '<p>物件情報が見つかりません。</p>';
                }
            })
            .catch(error => console.log('エラーが発生しました:', error));

        document.getElementById('appointment-form').addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            const formData = { 
                customerName: document.getElementById('customerName').value,
                appointmntDate: document.getElementById('appointmntDate').value,
                appointmntTime: document.getElementById('appointmntTime').value,
                phoneNumber: document.getElementById('phoneNumber').value,
                email: document.getElementById('email').value,
                detail: document.getElementById('detail').value,
                property_id: propertyId
            };

    
            fetch('http://127.0.0.1:8000/api/app/a', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(formData)       
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('予約が完了しました');
                } else {
                    alert('予約に失敗しました');
                    console.log(data);
                }
            })
            .catch(error => console.log('エラーが発生しました:', error));
        });
    </script>
</body>
</html>
