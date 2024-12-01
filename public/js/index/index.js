window.onload = function() {
    fetch('http://127.0.0.1:8000/api/viewproperty/get')
        .then(response => response.json())
        .then(data => {
            const properties = data.properties;
            let html = '';
            properties.forEach(property => {
                html += `
            <div class="property-card">
            <a href="form/${property.property_id}" class="reservation-text">内見はここをクリック</a>
            <p class="property-title">${property.title}</p>
                    <p class="property-description">${property.description}</p>
                    <p class="property-price">家賃/月: ¥${parseInt(property.price, 10).toLocaleString()}</p>
                    <div class="property-images">
                        ${property.images && property.images.length > 0
                            ? property.images.map(image => `<img src="http://127.0.0.1:8000/storage/${image}" alt="画像" width="300">`).join('')
                            : '<p>画像はありません</p>'}
                    </div>
                </div>
                <hr>
                `;
            });
            
            document.getElementById('properties-list').innerHTML = html;
        })
        .catch(error => console.log('エラーが発生しました:', error));
}


