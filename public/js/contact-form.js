window.addEventListener('load', () => {
    initOnFormSubmit();
})

function initOnFormSubmit() {
    const form = document.querySelector('#contactModal form');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        sendData(form);
    })
}

function sendData(form) {
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);

    xhr.addEventListener('load', () => {
         const newHtml = xhr.response;
        const divElement = document.createElement('div');
        divElement.innerHTML = newHtml;
        const newModalBody = divElement.querySelector('#contactModal .modal-body');
        const oldModalBody = document.querySelector('#contactModal .modal-body');
        oldModalBody.innerHTML = newModalBody.innerHTML;
        initOnFormSubmit();
    })

    xhr.addEventListener('error', () => {
        document.querySelector('#contactModal .modal-body').innerHTML =
            'Wystapił błąd. Proszę spróbować jeszcze raz później.';
    })

    xhr.open('POST', form.getAttribute('action'));
    xhr.send(formData);

}