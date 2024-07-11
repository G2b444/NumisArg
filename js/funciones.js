function openModal(modalId) {
    document.getElementById('modal-overlay').style.display = 'block';
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById('modal-overlay').style.display = 'none';
    document.getElementById(modalId).style.display = 'none';
}

function openModal(modalId) {
    document.getElementById('modal-overlay').style.display = 'block';
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById('modal-overlay').style.display = 'none';
    document.getElementById(modalId).style.display = 'none';
}

function initModal(className, modalId) {
    var confirmButton = document.querySelector(`#${modalId} .confirm`);
    var cancelButton = document.querySelector(`#${modalId} .cancel`);
    var currentLink = null;

    document.querySelectorAll(`.${className}`).forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            currentLink = this;
            openModal(modalId);
        });
    });

    confirmButton.onclick = function() {
        if (currentLink) {
            window.location.href = currentLink.href;
        }
    }

    cancelButton.onclick = function() {
        closeModal(modalId);
        currentLink = null;
    }
}