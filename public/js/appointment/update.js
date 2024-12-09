const eventId = window.location.pathname.split('/')[3];
document.getElementById('appointment-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const data = { 
        customerName: document.getElementById('customerName').value,
        appointmntDate: document.getElementById('appointmntDate').value,
        appointmntTime: document.getElementById('appointmntTime').value,
        phoneNumber: document.getElementById('phoneNumber').value,
        email: document.getElementById('email').value,
        detail: document.getElementById('detail').value,
    };

            fetch(`http://127.0.0.1:8000/api/appointment/${eventId}`, {
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
                    // window.location.href = '/api/property/list'
                } else {
                    alert('更新に失敗しました');
                    console.log(data); 
                }
            })
            .catch(error => {
                console.log('エラーが発生しました:', error); 
            });
});
        


