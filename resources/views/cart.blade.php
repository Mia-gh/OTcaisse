<x-app-layout>
    <div class="m-10 mt-12 border-2 border-teal-400 shadow-md shadow-teal-400">
        <h1 class="text-3xl text-lobster text-black mt-4 ml-4 mb-6">Mon panier</h1>
        <form method="POST" action="{{ route('updatecart') }}">
            @csrf
            <table class="table-auto w-full mb-6">
                <thead>
                    <tr class="px-4 py-3">
                        <th>ID</th>
                        <th>Article</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedArticles as $article)
                        <tr class="text-center">
                            <td>{{ $article->id ?? 'N/A' }}</td>
                            <td>{{ $article->title }}</td>
                            <td>
                                <input type="text" name="price_{{ $article->id }}" value="{{ session('cart')[$article->id]['price'] }}"
                                    class="w-20 price" data-article-id="{{ $article->id }}"
                                    onchange="updatePrice({{ $article->id }})"> €
                            </td>
                            <td class="px-4 py-2">
                                <input type="number" name="quantity_{{ $article->id }}" value="{{ session('cart')[$article->id]['quantity'] }}"
                                    class="w-16 quantity" data-article-id="{{ $article->id }}"
                                    onchange="updateTotal({{ $article->id }})">
                            </td>
                            <td class="px-4 py-2 total_{{ $article->id }}">
                                {{ session('cart')[$article->id]['price'] * session('cart')[$article->id]['quantity'] }} €
                            </td>
                            <td class="px-2 py-2 flex justify-center items-center">
                                <form method="POST" action="{{ route('updatecart') }}">
                                    @csrf
                                    <input type="hidden" name="articleId" value="{{ $article->id }}">
                                    <input type="hidden" name="quantity" value="0">
                                    <button type="submit"
                                        class="border-red-400 text-center hover:text-white hover:bg-red-600 text-red-600 font-bold py-2 px-4">
                                        X
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


    </div>


    <div name="options" class="flex flex-col md:flew-row justify-center items-center">

        <a href="{{ route('dashboard') }}"
            class="border-teal-400 rounded-md border-2 hover:bg-teal-400 text-black font-bold mr-4 py-2 px-4 mt-10 md:mt-40">
            Ajouter d'autres articles
        </a>

        <form method="POST" action="{{ route('confirmPurchase') }}" class="ml-2" id="confirmPurchaseForm">
            @csrf
            <div name="montantvente" class="flex flex-col items-center ml-2">
                <div name="grandtotal">
                    <div class="px-12 py-4">
                        <span class="text-xl font-bold text-red-600">Total de la commande:</span>
                        <span id="total_price" class="text-xl font-bold text-red-600">
                            <span id="price_value">{{ $selectedArticles->sum(function ($article) {return $article->price * 1;}) }}</span> €
                        </span>
                    </div>

                </div>


                <div name="moyenspaiement"></div>
                <span class="text-lg font-bold flex flex-wrap">Méthode de paiement :</span>
                <div class="mt-2 ml-12 p-2">
                    <label><input type="checkbox" class='rounded-xl border-2' name="payment_method[]" value="cb"> Carte
                        bancaire</label>
                    <label><input type="checkbox" class='rounded-xl border-2' name="payment_method[]" value="especes">
                        Espèces</label>
                    <label><input type="checkbox" class='rounded-xl border-2' name="payment_method[]" value="chq">
                        Chèque</label>
                </div>
                <div id="payment_options" class="flex flex-col md:flew-row justify-center items-center">
                    <div id="cb_option" class="mt-2 ml-12 p-4"  style="display: none;">
                        <label for="amount_cb">Montant CB :</label>
                        <input  type="text" name="amount_cb" id="amount_cb" class="w-24 border-2">
                        <input type="text" name="comment_cb" id="comment_cb" placeholder="Commentaire-CB"
                            class="w-48 border-2">
                    </div>
                    <div id="espece_option" class="mt-4 ml-12 p-4"  style="display: none;">
                        <label for="amount_especes">Montant espèces :</label>
                        <input  type="text" name="amount_especes" id="amount_especes" class="w-24 border-2">
                        <input type="text" name="comment_especes" id="comment_especes"
                            placeholder="Commentaire-espèces" class="w-48 border-2">
                    </div>
                    <div id="cheque_option" class="mt-4 ml-12 p-2"  style="display: none;">
                        <label for="amount_chq">Montant chèque :</label>
                        <input  type="text" name="amount_chq" id="amount_chq" class="w-24 border-2">
                        <input type="text" name="comment_chq" id="comment_chq" placeholder="Commentaire-chèque"
                            class="w-48 border-2">
                    </div>
                </div>
            </div>
            <div name="centerit" class="flex justify-center">
            <button id="confirmPurchaseBtn" type="submit"
                class="border-teal-400 border-2 rounded-md hover:bg-teal-400 text-black font-bold py-2 px-4 mt-2 md:mt-24">
                Valider le panier
            </button>
        </div>
        </form>

    </div>








    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('confirmPurchaseForm');
            form.addEventListener('submit', function(event) {

                var paymentCheckboxes = document.querySelectorAll('input[name="payment_method[]"]');
                var isAnyPaymentMethodChecked = Array.from(paymentCheckboxes).some(checkbox => checkbox.checked);
                if(!isAnyPaymentMethodChecked){
                    showNotification("Veuillez sélectionner une méthode de paiement.")
                    event.preventDefault();
                    return; 
                }

                const amount_cb = document.getElementById("amount_cb").value ? document.getElementById("amount_cb").value  : 0;
                const amount_especes = document.getElementById("amount_especes").value ? document.getElementById("amount_especes").value  : 0;
                const amount_chq = document.getElementById("amount_chq").value ? document.getElementById("amount_chq").value  : 0;
                const amount_total = parseFloat(amount_cb) + parseFloat(amount_chq) + parseFloat(amount_especes) ;
                if( amount_total !== parseFloat(calculateTotalSum()) ){
                    showNotification("Le montant des moyens de paiements doit être équivalent au montant de la commmande.")
                    event.preventDefault();
                    return; 
                }
            });
        });

        function validateFormData() {
            // Sélectionne toutes les checkboxes des options de paiement
            var paymentCheckboxes = document.querySelectorAll('input[name="payment_method[]"]');
            var isAnyPaymentMethodChecked = Array.from(paymentCheckboxes).some(checkbox => checkbox.checked);

            if (!isAnyPaymentMethodChecked) {
                // Aucune checkbox de paiement n'est cochée
              //  alert('Veuillez sélectionner une méthode de paiement.');
                return false; // Validation échoue
            }

            // Vérification montant écrit avec total
            const amount_cb = parseFloat(getElementById("amount_cb").value);
            const amount_chq = parseFloat(getElementById("amount_chq").value);
            const amount_especes = parseFloat(getElementById("amount_especes").value);
            const amount_total = amount_cb + amount_chq + amount_especes;
            if( amount_total !== parseFloat(calculateTotalSum()) ){
                return false;
            }

            // Ajoutez ici d'autres validations si nécessaire

            return true; // Validation réussit
        }


        function showNotification(message, type='error') {
            // Créer un élément de notification
            var notification = document.createElement('div');
            notification.innerHTML = `<span>${message}</span>`;
            notification.style.position = 'fixed';
            notification.style.top = '20px';
            notification.style.right = '-400px'; // Commencer hors de l'écran
            notification.style.padding = '15px 30px';
            notification.style.color = 'white';
            notification.style.backgroundColor = type === 'error' ? '#D32F2F' : '#388E3C';
            notification.style.borderRadius = '4px';
            notification.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
            notification.style.zIndex = '1000';
            notification.style.transition = 'right 0.5s ease-in-out';
            notification.style.fontFamily = 'Arial, sans-serif';
            notification.style.fontSize = '16px';
            notification.style.lineHeight = '1.4';
            notification.style.maxWidth = '300px';
            notification.style.boxSizing = 'border-box';

            // Ajoute la notification au document
            document.body.appendChild(notification);

            // Anime pour faire entrer la notification
            setTimeout(() => {
                notification.style.right = '20px';
            }, 100);

            // Supprime la notification après 5 secondes avec une animation de sortie
            setTimeout(function() {
                notification.style.right = '-400px'; // Anime pour sortir de l'écran
                // Attend la fin de l'animation pour supprimer l'élément
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 600); // Doit correspondre à la durée de l'animation
            }, 3000);
        }


        function preventInput(elementId) {
            var element = document.getElementById(elementId);
            if (element) {
                element.addEventListener('keydown', function(e) {
                    e.preventDefault(); // Bloquer l'entrée clavier
                });
            }
        }

        function preventFloatInput(elementId) {
            var element = document.getElementById(elementId);
            if (element) {
                element.addEventListener('keydown', function(e) {
                    // Autoriser les chiffres, le point, et certaines touches de contrôle
                    if (!e.key.match(/[0-9.]|\Backspace|Delete|ArrowLeft|ArrowRight|Tab/) || (e.key === '.' && e.target.value.includes('.'))) {
                        e.preventDefault(); // Bloquer les autres entrées clavier
                    }
                });
            }
        }

        // Utilisation de la fonction
        //preventInput('amount_cb');
        //preventInput('amount_especes');
        //preventInput('amount_chq');
        preventFloatInput('amount_cb');
        preventFloatInput('amount_chq');
        preventFloatInput('amount_especes');

        // Add an event listener to the checkboxes to show the payment options individually
        /*
        var checkboxes = document.querySelectorAll('input[name="payment_method[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {

                checkboxes.forEach(function(otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });

                document.getElementById('cb_option').style.display = 'none';
                document.getElementById('espece_option').style.display = 'none';
                document.getElementById('cheque_option').style.display = 'none';

                if (checkbox.value === 'cb') {
                    document.getElementById('cb_option').style.display = checkbox.checked ? 'block' : 'none';
                    document.getElementById('amount_cb').value =  calculateTotalSum();
                }
                if (checkbox.value === 'especes') {
                    document.getElementById('espece_option').style.display = checkbox.checked ? 'block' : 'none';
                    document.getElementById('amount_especes').value =  calculateTotalSum();
                }
                if (checkbox.value === 'chq') {
                    document.getElementById('cheque_option').style.display = checkbox.checked ? 'block' : 'none';
                    document.getElementById('amount_chq').value =  calculateTotalSum();
                }
                document.getElementById('payment_options').style.display = checkbox.checked ? 'block' : 'none';
            });
        });
        */
        
        var checkboxes = document.querySelectorAll('input[name="payment_method[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (checkbox.value === 'cb') {
                    document.getElementById('cb_option').style.display = checkbox.checked ? 'block' :
                        'none';
                }
                if (checkbox.value === 'especes') {
                    document.getElementById('espece_option').style.display = checkbox.checked ? 'block' :
                        'none';
                }
                if (checkbox.value === 'chq') {
                    document.getElementById('cheque_option').style.display = checkbox.checked ? 'block' :
                        'none';
                }
             //   document.getElementById('payment_options').style.display = checkbox.checked ? 'block' : 'none';
            });
        }); 

        function updateCart(articleId, price, quantity) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/updatecart', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.send('articleId=' + articleId + '&quantity=' + quantity + '&price=' + price);
        }


        function updatePrice(articleId) {
            var priceInput = document.querySelector('input[name="price_' + articleId + '"]');
            var newPrice = priceInput.value; // Get the new price entered by the user

            // Update the total of the article
            var totalElement = document.querySelector('.total_' + articleId);
            var quantity = document.querySelector('input[name="quantity_' + articleId + '"]').value;
            totalElement.textContent = quantity * newPrice + ' €';

            // Update the total sum for all articles
            var totalPriceElement = document.getElementById('total_price');
            totalPriceElement.textContent = calculateTotalSum() + ' €';

            // Update the total payment options 
            /*document.getElementById('amount_cb').value =  calculateTotalSum();
            document.getElementById('amount_especes').value =  calculateTotalSum();
            document.getElementById('amount_chq').value =  calculateTotalSum();*/

            // Update cart in Session
            updateCart(articleId, newPrice, quantity);
        }

        function updateTotal(articleId) {
            // Get the new quantity
            var newQuantity = document.querySelector('input[name="quantity_' + articleId + '"]').value;

            // Update the total of the article
            var totalElement = document.querySelector('.total_' + articleId);
            var price = document.querySelector('input[name="price_' + articleId + '"]').value;
            var quantity = document.querySelector('input[name="quantity_' + articleId + '"]').value;
            totalElement.textContent = quantity * price + ' €';

            // Update the total sum for all articles
            var totalPriceElement = document.getElementById('total_price');
            totalPriceElement.textContent = calculateTotalSum() + ' €';

            // Update the total payment options 
            /*document.getElementById('amount_cb').value =  calculateTotalSum();
            document.getElementById('amount_especes').value =  calculateTotalSum();
            document.getElementById('amount_chq').value =  calculateTotalSum();*/

            // Update cart in Session
            updateCart(articleId, price, quantity);
        }

        function calculateTotalSum() {
            var totalSum = 0;
            var quantityInputs = document.querySelectorAll('.quantity');
            for (var i = 0; i < quantityInputs.length; i++) {
                var articleId = quantityInputs[i].getAttribute('data-article-id');
                var quantity = quantityInputs[i].value;
                var price = document.querySelector('input[name="price_' + articleId + '"]').value;
                totalSum += quantity * price;
            }
            return totalSum;
        }

        document.onreadystatechange = function() {
            var rows = document.querySelectorAll('table tbody tr');
            for (var i = 0; i < rows.length; i++) {
                var firstCol = rows[i].cells[0]; //first column
                updateTotal(firstCol.textContent)
            }
        }


        function removeFromCart(articleId) {
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/cart/remove/' + articleId, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.send();

            xhr.onload = function() {
                console.log('Status: ' + xhr.status);
                console.log('Response: ' + xhr.responseText);

                if (xhr.status === 200) {
                    // If the request was successful, reload the page to update the cart
                    location.reload();
                } else {
                    // If the request failed, display an error message
                    alert('Echec de la suppression de l\'article !');
                }
            };

        }

    </script>
</x-app-layout>