window.onload = function() {
    const $eventId= window.location.pathname.split('/')[3];
    fetch(`http://127.0.0.1:8000/api/viewappointment/${$eventId}`)
        .then(response => response.json())
        .then(data => {
            const appointment = data.appointment;
            let html = '';
            html += `
            <div class="appointment-card">
                <h2 class="appointment-customerName">予約者氏名: ${appointment.customerName}</h2>
                <p class="appointment-date">予約日: ${appointment.appointmntDate}</p>
                <p class="appointment-time">予約時間: ${appointment.appointmntTime}</p>
                <p class="appointment-phoneNumber">電話番号: ${appointment.phoneNumber}</p>
                <p class="appointment-email">メールアドレス: ${appointment.email}</p>
                <p class="appointment-description">詳細: ${appointment.detail}</p>
                <div class="property-images">
                </div>
            </div>
            <hr>
            `;
            
            document.getElementById('appointment-list').innerHTML = html;
        })
        .catch(error => console.log('エラーが発生しました:', error));
}
