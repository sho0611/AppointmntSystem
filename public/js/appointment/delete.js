
document.getElementById('delete-button').addEventListener('click', function() {

    if (confirm('本当に削除しますか？')) {
    fetch(`http://127.0.0.1:8000/api/appointment/${eventId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('予約を削除しました');
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