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
            })
            .catch(error => {
                console.error('Error fetching actor details:', error);
                document.getElementById('actor-details').innerHTML = '<p>Error fetching actor details.</p>';
            });
    } else {
        document.getElementById('actor-details').innerHTML = '<p>No actor specified.</p>';
    }
});

function displayActorDetails(data) {
    const actorDetailsDiv = document.getElementById('actor-details');

    if (data.status === 'success' && data.actor) {
        const actor = data.actor;
        const knownForMovies = actor.known_for.slice(0, 10).map(movie => `
            <div class="movie-item">
                <img src="${movie.poster_path}" alt="${movie.title} Poster">
                <p>${movie.title}</p>
            </div>
        `).join('');

        document.getElementById('actor-img').src = actor.profile_path;
        document.getElementById('actor-name').innerText = actor.name;
        document.getElementById('actor-biography').innerText = actor.biography;
        document.getElementById('actor-birthday').innerText = actor.birthday;
        document.getElementById('actor-place-of-birth').innerText = actor.place_of_birth;
        document.getElementById('actor-gender').innerText = actor.gender;
        document.getElementById('known-for-movies').innerHTML = knownForMovies;

        // Show the "Show More" button only if the biography is longer than the restricted height
        const biographyElement = document.getElementById('actor-biography');
        if (biographyElement.scrollHeight > biographyElement.clientHeight) {
            document.getElementById('show-more-btn').style.display = 'block';
        } else {
            document.getElementById('show-more-btn').style.display = 'none';
        }
    } else {
        actorDetailsDiv.innerHTML = '<p>Actor not found.</p>';
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
