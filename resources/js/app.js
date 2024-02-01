import './bootstrap';

import "~resources/scss/app.scss";
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

// const allButtons = document.querySelectorAll('.button-delete');

// allButtons.forEach( button  => {
//     button.addEventListener('click', (event) => {
//         event.preventDefault();
//         const deleteModal = new bootstrap.Modal('#my-modal');
//         deleteModal.show();

//         const title = button.getAttribute('data-title');
//         document.getElementById('title-delete').innerHTML = title;

//         document.getElementById('delete').addEventListener('click', () => {
//                 button.parentElement.submit();
//             })
//     })
// })