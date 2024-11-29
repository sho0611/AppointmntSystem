window.onload = function() {
    fetch('http://127.0.0.1:8000/api/viewproperty/get')
        .then(response => response.json())
        .then(data => {
            const properties = data.properties;
            let html = '';
            properties.forEach(property => {
                html += `
                    <div>
            <h2><a href="form/${property.property_id}">${property.title}</a></h2>
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


