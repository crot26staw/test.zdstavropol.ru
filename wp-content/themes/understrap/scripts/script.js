
const orederForm = document.querySelector('.main-mailng__form');

const message = {
    loading: 'Идёт отправка',
    ok: 'Заявка успешно отправлена',
    error: 'Ошибка отправления'
}

if (orederForm) {

    orederForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const popup = document.querySelector('.popup');
        const titleElement = document.querySelector('.popup__title p');

        titleElement.textContent = message.loading;
        popup.classList.add('popup-opend');

        fetch('/send_reviews.php', {
            method: 'POST',
            body: new FormData(orederForm)
        })
        .then((response) => {
            if (response.ok) {
                orederForm.reset();
                titleElement.textContent = message.ok ;
            } else {
                orederForm.reset();
                titleElement.textContent = message.error;
            }
        })

    })
}

// Закрываем окно
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.querySelector('.popup');

    if (popup) {

        const closeBtn = document.querySelector('.popup__close');
   

        function closePopup() {
            popup.classList.remove('popup-opend');
        }
        popup.addEventListener('click', (e) => {
            if (e.target === popup) {
                popup.classList.remove('popup-opend');
            }
        })
        closeBtn.addEventListener('click', closePopup);
  
    }

});