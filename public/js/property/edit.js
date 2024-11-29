
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

document.getElementById('property-form').addEventListener('submit', function(event) {

    event.preventDefault(); 

    const data = {
    title: document.getElementById('title').value,   
    description: document.getElementById('description').value,  
    price: document.getElementById('price').value,
};

    fetch(`http://127.0.0.1:8000/api/property/${propertyId}`, {
        method: 'PUT',  
        headers: {
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(data)  
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) { 
            alert('更新に成功しました');
            window.location.href = '/api/property/list'
        } else {
            alert('更新に失敗しました');
            console.log(data); 
        }
    })
    .catch(error => {
        console.log('エラーが発生しました:', error); 
    });
});

document.getElementById('delete-button').addEventListener('click', function() {

if (confirm('本当に削除しますか？')) {
fetch(`http://127.0.0.1:8000/api/property/${propertyId}`, {
    method: 'DELETE',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        alert('物件を削除しました');
        window.location.href = '/api/property/list'
    } else {
        alert('削除に失敗しました');
        console.log(data);
    }
})
.catch(error => {
    console.log('エラーが発生しました:', error);
});
}
});


