document.addEventListener('DOMContentLoaded', () => {
// adding products into cart page
        const productList = document.getElementById('product-list');
        const selectedProducts = JSON.parse(localStorage.getItem('cartItems')) || [];
            // show products in cart page

            function removeFromCart(product) {
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const updatedCart = cartItems.filter(item => item.name !== product);
            localStorage.setItem('cartItems', JSON.stringify(updatedCart));
            renderCartItems(updatedCart);
        }
        
        //sum function for total prices

        function calculateTotal(cartItem) {
            let total = 0;
            cartItem.forEach(item => {
                const price = parseFloat(item.price.replace('$', ''));
                total += price * item.quantity;
            });
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        function renderCartItems(selectedProducts) {
            productList.innerHTML = '';
            selectedProducts.forEach(item => {
                const li = document.createElement('div');
                li.classList.add('cart-item');

                const img = document.createElement('img');
                img.src = `${item.picture}`;
                li.appendChild(img);

                const div = document.createElement('div');
                div.classList.add('item-info');
                li.appendChild(div);

                const h2 = document.createElement('h2');
                h2.textContent = `${item.name}`;
                div.appendChild(h2);

                const pEl = document.createElement('p');
                pEl.classList.add('price');
                pEl.textContent = `${item.price}`;
                div.appendChild(pEl);

                const quantityDiv = document.createElement('label');
                div.appendChild(quantityDiv);

                const quantityInput = document.createElement('input');
                quantityInput.type = 'number';
                quantityInput.value = `${item.quantity}`;
                quantityInput.min = 1;
                quantityInput.classList.add('quantity');
                quantityDiv.appendChild(quantityInput);

                const removeButton = document.createElement('button');
                removeButton.classList.add('remove');
                removeButton.setAttribute('data-product-name', item.name);
                removeButton.innerHTML = "<i class='bx bxs-trash-alt' style='color:#000000'></i>";
                li.appendChild(removeButton);

                productList.appendChild(li);

                document.querySelectorAll('.remove').forEach(button => {
            button.addEventListener('click', function() {
                const productName = this.getAttribute('data-product-name');
                removeFromCart(productName);
            });
        });
            });
        }
        renderCartItems(selectedProducts);
        calculateTotal(selectedProducts);
        });

        