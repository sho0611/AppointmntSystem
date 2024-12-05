document.getElementById('appointment-cancel-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const appointmentId = document.getElementById('appointment-id').value; 

    if (!confirm('本当にキャンセルしますか？')) {
        return;
    }

    fetch(`/appointment/${appointmentId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        alert('予約がキャンセルされました！');
    })
    .catch(error => {
        console.error('キャンセル中にエラーが発生しました:', error);
        alert('キャンセルに失敗しました');
    });
});
