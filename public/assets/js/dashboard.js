document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');
	var colorMap = {}; // Object to store the color for each id_kelas

	var calendar = new FullCalendar.Calendar(calendarEl, {
		plugins: ['dayGrid'],
        events: events,
        eventClick: function(info) {
			var title = info.event.title;
			var start = info.event.start;
			var dosen = info.event.extendedProps.dosen;
			var aslab = info.event.extendedProps.aslab;
			var idKelas = info.event.extendedProps.id_kelas
		.toString(); // Ensure idKelas is a string

			var startDate = start ? start.toLocaleDateString('id-ID', {
				year: 'numeric',
				month: 'long',
				day: 'numeric'
			}) : '';

			var startDateStyle = start < new Date() ? 'text-decoration: line-through;' : '';

			$('#eventDetails').html(`
				<div class="row">
					<div class="col-md-6">
						<strong>Title:</strong>
						<p>${title}</p>
						<strong>Praktikum Date:</strong>
						<p style="${startDateStyle}">${startDate}</p>
					</div>
					<div class="col-md-6">
						<strong>Dosen:</strong>
						<p>${dosen}</p>
						<strong>Aslab:</strong>
						<p>${aslab}</p>
						<strong>ID Kelas:</strong>
						<p>${idKelas}</p>
					</div>
				</div>`);
			$('#eventModal').modal('show');
		},
		eventRender: function(info) {
			var idKelas = info.event.extendedProps.id_kelas
		.toString(); // Ensure idKelas is a string
			var start = info.event.start;
			var today = new Date();

			if (!colorMap[idKelas]) {
				colorMap[idKelas] = getRandomColor(idKelas);
			}

			if (start.toDateString() === today.toDateString()) {
				// If event starts today, set background color to green
				info.el.style.backgroundColor = 'green';
			} else if (start < today) {
				// If event is in the past, set background color to red
				info.el.style.backgroundColor = 'red';
			} else {
				// If event is in the future, set background color based on id_kelas
				info.el.style.backgroundColor = colorMap[idKelas];
			}
		}
	});

	calendar.render();

	function getRandomColor(idKelas) {
		// Generate a unique color based on the id_kelas
		var seed = parseInt(idKelas.replace(/[^\d]/g, ''), 10);
		var color = '#' + (seed * 7 % 16777215).toString(
		16); // Use a prime number multiplier to ensure uniqueness
		return color;
	}

});
