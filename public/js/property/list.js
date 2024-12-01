window.onload = function() {
    fetch('http://127.0.0.1:8000/api/viewproperty/get')
        .then(response => response.json())
        .then(data => {
            const properties = data.properties;
            let html = '';
            properties.forEach(property => {
                html += `
                <div class="property-card">
                    <h2 class="property-title"><a href="/api/property/${property.property_id}">${property.title}</a></h2>
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

        document.getElementById('add-property-btn').addEventListener('click', function () {
            window.location.href = '/api/property';
        });
        
}
