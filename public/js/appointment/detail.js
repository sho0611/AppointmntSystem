window.onload = function() {
    const $appointmentId = window.location.pathname.split('/')[3];
    fetch(`http://127.0.0.1:8000/api/viewappointment/${$appointmentId}`)
        .then(response => response.json())
        .then(data => {
            const appointment = data.appointment;
            let html = '';
            appointment.forEach(appointment => {
                html += `
                <div class="property-card">
                    <h2 class="property-title"><a>${appointment.customerName}</a></h2>
                    <p class="property-description">${appointment.appointmntDate}</p>
                    <p class="property-description">${appointment.appointmntTime}</p>
                    <p class="property-description">${appointment.detail}</p>
                    <p class="property-description">${appointment.phoneNumber}</p>
                    <p class="property-description">${appointment.email}</p>
                    <div class="property-images">
                    </div>
                </div>
                <hr>
                `;
            });
            document.getElementById('appointment-list').innerHTML = html;
        })
        .catch(error => console.log('エラーが発生しました:', error));

}