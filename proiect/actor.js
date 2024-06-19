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
    actorDetailsDiv.innerHTML = '';

    if (data.status === 'success' && data.actor) {
        const actor = data.actor;
        const knownForMovies = actor.known_for.map(movie => `
            <div>
                <h3>${movie.title}</h3>
                <p>${movie.overview}</p>
                <p><strong>Release Date:</strong> ${movie.release_date}</p>
                <img src="${movie.poster_path}" alt="${movie.title} Poster">
            </div>
        `).join('');

        actorDetailsDiv.innerHTML = `
            <h2>${actor.name}</h2>
            <img src="${actor.profile_path}" alt="${actor.name} Photo">
            <div>
                <h3>Known For</h3>
                ${knownForMovies}
            </div>
        `;
    } else {
        actorDetailsDiv.innerHTML = '<p>Actor not found.</p>';
    }
}
