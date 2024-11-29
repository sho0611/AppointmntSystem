document.getElementById('property-form').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const formData = new FormData(this);

    fetch('http://127.0.0.1:8000/api/property/post', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            window.location.href = '/api/property/list';
        } else {
            alert('投稿に失敗しました');
            console.log(data); 
        }
    })
    .catch(error => {
        console.log('エラーが発生しました:', error); 
    });
});
