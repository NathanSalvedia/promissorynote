
  document.addEventListener('DOMContentLoaded', () => {
        const cards = document.getElementById('popup-cards');
        setTimeout(() => {
            cards.classList.remove('opacity-0', 'translate-x-10');
            cards.classList.add('opacity-100', 'translate-x-0');
        }, 500);
    });


document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const loading = document.getElementById('loadingScreen');
    loading.classList.remove('hidden');


    setTimeout(() => {
        this.submit();
    }, 2000);
});
