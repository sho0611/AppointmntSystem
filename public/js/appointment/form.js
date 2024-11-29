
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
        // property_id: propertyId
    };


    fetch('http://127.0.0.1:8000/api/appointment/post', {
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
            window.location.href = '/api/index';    
        } else {
            alert('予約に失敗しました');
            console.log(data);
        }
    })
    .catch(error => console.log('エラーが発生しました:', error));
});

