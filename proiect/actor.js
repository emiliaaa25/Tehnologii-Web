document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const actorName = params.get('name');

    if (actorName) {
        fetch(`http://localhost:8000/proiect/api/actors/details?name=${encodeURIComponent(actorName)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                displayActorDetails(data);
                displayKnownFor(data);
                displayFilmography(data);
            })
            .catch(error => {
                console.error('Error fetching actor details:', error);
                document.getElementById('actor-details').innerHTML = '<p>Error fetching actor details.</p>';
            });
    } else {
        document.getElementById('actor-details').innerHTML = '<p>No actor specified.</p>';
    }

    document.getElementById('production-type').addEventListener('change', filterFilmography);
});

function displayActorDetails(data) {
    const actor = data.actor;
    document.getElementById('actor-img').src = actor.profile_path;
    document.getElementById('actor-name').innerText = actor.name;
    document.getElementById('actor-biography').innerText = actor.biography;
    document.getElementById('actor-birthday').innerText = actor.birthday;
    document.getElementById('actor-place-of-birth').innerText = actor.place_of_birth;
    document.getElementById('actor-gender').innerText = actor.gender;

    const biographyElement = document.getElementById('actor-biography');
    if (biographyElement.scrollHeight > biographyElement.clientHeight) {
        document.getElementById('show-more-btn').style.display = 'block';
    } else {
        document.getElementById('show-more-btn').style.display = 'none';
    }
}

function displayKnownFor(data) {
    const actor = data.actor;
    const knownForContainer = document.getElementById('known-for-movies');
    knownForContainer.innerHTML = '';

    actor.known_for
        .filter(movie => movie.popularity !== null )
        .sort((a, b) => b.popularity - a.popularity)
        .slice(0, 10)
        .forEach(movie => {
            const movieItem = document.createElement('div');
            movieItem.className = 'movie-item';
            movieItem.innerHTML = `
                <img src="${movie.poster_path}" alt="${movie.title} Poster">
                <p>${movie.title}</p>
            `;
            knownForContainer.appendChild(movieItem);
        });
}

function displayFilmography(data) {
    const actor = data.actor;
    if (actor && actor.filmography) {
        const filmographyContainer = document.getElementById('filmography-container');
        filmographyContainer.innerHTML = '';
        actor.filmography.forEach(item => {
            const filmographyItem = document.createElement('div');
            filmographyItem.className = 'filmography-item';
            filmographyItem.setAttribute('data-media-type', item.media_type); // ajustare pentru a corespunde cu API-ul
            filmographyItem.innerHTML = `
                <img src="${item.poster_path}" alt="${item.title} Poster">
                <p>${item.title}</p>
            `;
            filmographyContainer.appendChild(filmographyItem);
        });
    } else {
        console.error('Actor or filmography data is undefined or empty:', actor);
    }
}


function toggleBiography() {
    const biographyElement = document.getElementById('actor-biography');
    biographyElement.classList.toggle('show-more');
    const btn = document.getElementById('show-more-btn');
    if (biographyElement.classList.contains('show-more')) {
        btn.textContent = 'Show Less';
    } else {
        btn.textContent = 'Show More';
    }
}

function filterFilmography() {
    const productionType = document.getElementById('production-type').value;

    console.log('Production Type:', productionType);

    const items = document.querySelectorAll('.filmography-item');
    items.forEach(item => {
        const matchesProductionType = productionType === 'all' || item.dataset.mediaType === productionType;

        console.log('Item Media Type:', item.dataset.mediaType);

        if (matchesProductionType) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
