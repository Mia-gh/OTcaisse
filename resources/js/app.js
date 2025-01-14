import './bootstrap';


//cart blade php
        // function removeFromCart(articleId) {
        //     var xhr = new XMLHttpRequest();
        //     xhr.open('DELETE', '/cart/remove/' + articleId, true);
        //     xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        //     xhr.send();

        //     xhr.onload = function() {
        //         console.log('Status: ' + xhr.status);
        //         console.log('Response: ' + xhr.responseText);

        //         if (xhr.status === 200) {
        //             // If the request was successful, reload the page to update the cart
        //             location.reload();
        //         } else {
        //             // If the request failed, display an error message
        //             alert('Echec de la suppression de l\'article !');
        //         }
        //     };

        // }

    //     function removeItem(event, articleId) {
    //     event.preventDefault();
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', '/cart/remove/' + articleId, true);
    //     xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    //     xhr.send();

    //     xhr.onload = function() {
    //         if (xhr.status === 200) {
    //             // If the request was successful, reload the page to update the cart
    //             location.reload();
    //         } else {
    //             // If the request failed, display an error message
    //             alert('Echec de la suppression de l\'article !');
    //         }
    //     };
    // }