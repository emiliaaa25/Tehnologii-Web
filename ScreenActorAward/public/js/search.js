function filterResults(type) {
    console.log('filtering results by type:', type);
    const items = document.querySelectorAll('.search-result-item');
    items.forEach(item => {
        if (type === 'all' || item.getAttribute('data-type') === type) {
            console.log('filtering results by type:', type);

            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
document.addEventListener('DOMContentLoaded', () => {
    filterResults('movie');
});