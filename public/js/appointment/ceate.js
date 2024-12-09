const propertyId = window.location.pathname.split('/')[3];

fetch(`http://127.0.0.1:8000/api/viewproperty/${propertyId}`)
    .then(response => response.json())
    .then(data => {
        if (data.property) {
            const property = data.property;
            document.getElementById('property-details').innerHTML = `
            <div class="property-container">
                <h2 class="form-property-title">${property.title}</h2>
                <p class="form-property-description">${property.description}</p>
                <p class="form-property-price">家賃/月: ¥${parseInt(property.price, 10).toLocaleString()}</p>
            </div>
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
    };


    document.getElementById('confirm-customerName').textContent = formData.customerName;
    document.getElementById('confirm-appointmntDate').textContent = formData.appointmntDate;
    document.getElementById('confirm-appointmntTime').textContent = formData.appointmntTime;
    document.getElementById('confirm-phoneNumber').textContent = formData.phoneNumber;
    document.getElementById('confirm-email').textContent = formData.email;
    document.getElementById('confirm-detail').textContent = formData.detail;


    document.getElementById('confirmation').style.display = 'block';
    document.getElementById('confirmation-message').style.display = 'block';
});


document.getElementById('confirm-button').addEventListener('click', function() {
    fetch('http://127.0.0.1:8000/api/appointment/post', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            customerName: document.getElementById('customerName').value,
            appointmntDate: document.getElementById('appointmntDate').value,
            appointmntTime: document.getElementById('appointmntTime').value,
            phoneNumber: document.getElementById('phoneNumber').value,
            email: document.getElementById('email').value,
            detail: document.getElementById('detail').value,
        })
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
