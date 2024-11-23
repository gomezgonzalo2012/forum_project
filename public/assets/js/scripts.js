/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    //
// Scripts
//

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {

        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

// Definir una función para manejar los clics en botones de reacción
function handleReaction(button) {
    const commentId = button.dataset.commentId;
    console.log(commentId);
    const reactionType = button.dataset.reaction;
    console.log(reactionType);

    fetch(`/comments/${commentId}/reactToComment`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ reaction: reactionType }) // Pasar el tipo de reacción
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud `);
        }
        return response.json();
    })
    .then(data => {
        // Actualizar los contadores
        document.querySelector(`#like-count-${commentId}`).textContent = data.likes;
        document.querySelector(`#dislike-count-${commentId}`).textContent = data.dislikes;

        // Deshabilitar ambos botones después de reaccionar
        button.disabled = true;
        const otherButton = reactionType === 'likes'
            ? document.querySelector(`.dislike-button[data-comment-id="${commentId}"]`)
            : document.querySelector(`.like-button[data-comment-id="${commentId}"]`);
        otherButton.disabled = true;
    })
    .catch(error => console.error('Error:', error));
}

// Event listeners para botones de like y dislike
document.querySelectorAll('.like-button, .dislike-button').forEach(button => {
    button.addEventListener('click', function() {
        handleReaction(this);
    });
});
