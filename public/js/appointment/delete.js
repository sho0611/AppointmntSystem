document.getElementById('appointment-update-form').addEventListener('submit', function(e) {
    e.preventDefault();  

    const formData = new FormData(this);
    const appointmentId = document.getElementById('appointment-id').value;  

    fetch(`/appointment/${appointmentId}`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert('予約が変更されました！');
    })
    .catch(error => {
        console.error('変更中にエラーが発生しました:', error);
        alert('変更に失敗しました');
    });
});
