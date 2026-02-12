document.addEventListener('DOMContentLoaded', () => {
	// Pobieranie danych z PHP
	fetch('../../php/getBungalowsJSON.php') // Adres pliku PHP
		.then((response) => {
			if (!response.ok) {
				throw new Error(`HTTP error! status: ${response.status}`);
			}
			return response.json();
		})
		.then((data) => {
			console.log(data); // Wyświetlenie danych w konsoli
			generateBungalowsCarousel(data); // Funkcja do generowania karuzeli
		})
		.catch((error) => console.error('Error fetching bungalows:', error));
});

// Funkcja do generowania karuzeli
function generateBungalowsCarousel(bungalows) {
	const carousel = document.querySelector('.popular-bungalows');

	bungalows.forEach((bungalow) => {
		const bungalowDiv = document.createElement('div');
		bungalowDiv.className = 'bungalow';
		bungalowDiv.setAttribute('id', bungalow.id);
		bungalowDiv.innerHTML = `
          <div class="bungalow-img">
              <img src="../../${bungalow.bungalowPath}" alt="${bungalow.name}" />
          </div>
          <div class="bungalow-info">
              <p>${bungalow.name}</p>
              <p>Capacity: <span>${bungalow.capacity}</span></p>
          </div>
      `;

		bungalowDiv.addEventListener('click', () => {
			alert(`Przechodzenie do: bungalows/${bungalow.id}`);
			// Możesz przekierować:
			// window.location.href = `bungalows/${bungalow.id}`;
		});

		carousel.appendChild(bungalowDiv);
	});

	// Inicjalizacja Slick Carousel
	$(carousel).slick({
		dots: true,
		infinite: true,
		speed: 500,
		slidesToShow: 3,
		slidesToScroll: 1,
		adaptiveHeight: true,
		centerMode: true,
		initialSlide: 1,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					centerMode: true,
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 550,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerMode: true,
				},
			},
		],
	});
}
