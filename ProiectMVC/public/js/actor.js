
function displayActorDetails(data) {
    const actor = data.actor;
    document.getElementById('actor-img').src = actor.profile_path;
   // document.getElementById('actor-name').innerText = actor.name;
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
        .filter(movie => movie.vote_count !== null)
        .sort((a, b) => b.vote_count - a.vote_count)
        .slice(0, 10)
        .forEach(movie => {
            const movieItem = document.createElement('div');
            movieItem.className = 'movie-item';
            
            // Create an anchor element (link) wrapping the image and title
            const movieLink = document.createElement('a');
            console.log(movie.title);
            movieLink.href = `http://localhost/ProiectMVC/app/views/Movie.php?title=${encodeURIComponent(movie.title)}`;
            
            const movieImage = document.createElement('img');
            movieImage.src = movie.poster_path;
            movieImage.alt = `${movie.title} Poster`;
            
            const movieTitle = document.createElement('p');
            movieTitle.textContent = movie.title;
            
            // Append image and title to the anchor element
            movieLink.appendChild(movieImage);
            movieLink.appendChild(movieTitle);
            
            // Append the anchor element to the movieItem container
            movieItem.appendChild(movieLink);

            // Append the movieItem to the knownForContainer
            knownForContainer.appendChild(movieItem);
        });
}


function displayFilmography(data) {
    const actor = data.actor;
    if (actor && actor.filmography) {
        // Sortăm filmografia în funcție de release_date în ordine descrescătoare
        actor.filmography.sort((a, b) => new Date(b.release_date) - new Date(a.release_date));

        const filmographyContainer = document.getElementById('filmography-container');
        filmographyContainer.innerHTML = '';

        actor.filmography.forEach(item => {
            const filmographyItem = document.createElement('div');
            filmographyItem.className = 'filmography-item';
            filmographyItem.setAttribute('data-media-type', item.media_type);

            // Creăm URL-ul pentru fiecare item în funcție de tipul său
            const mediaUrl = item.media_type === 'movie' 
                ? `http://localhost/ProiectMVC/app/views/Movie.php?title=${encodeURIComponent(item.title)}`
                : `http://localhost/ProiectMVC/app/views/TvShow.php?title=${encodeURIComponent(item.title)}`;

            // Creăm elementul anchor
            const mediaLink = document.createElement('a');
            mediaLink.href = mediaUrl;

            const mediaImage = document.createElement('img');
            mediaImage.src = item.poster_path;
            mediaImage.alt = `${item.title} Poster`;

            const mediaTitle = document.createElement('p');
            mediaTitle.textContent = item.title;

            const mediaCharacter = document.createElement('p');
            mediaCharacter.textContent = item.character;

            const mediaReleaseDate = document.createElement('p');
            mediaReleaseDate.textContent = item.release_date;

            // Adăugăm imaginea și titlul în elementul anchor
            mediaLink.appendChild(mediaImage);
            mediaLink.appendChild(mediaTitle);
            mediaLink.appendChild(mediaCharacter);
            mediaLink.appendChild(mediaReleaseDate);

            // Adăugăm elementul anchor în containerul filmographyItem
            filmographyItem.appendChild(mediaLink);

            // Adăugăm filmographyItem în containerul filmographyContainer
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
