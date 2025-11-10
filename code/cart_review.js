document.addEventListener('DOMContentLoaded', () => {
// adding products into cart page
        const productList = document.getElementById('product-list');
        const selectedProducts = JSON.parse(localStorage.getItem('cartItems')) || [];
            // show products in cart page
            productList.innerHTML = '';
            selectedProducts.forEach(item => {
                const li = document.createElement('li');
                li.classList.add('container', 'row');

                const img = document.createElement('img');
                img.classList.add('result_picture', 'col-3');
                img.src = `${item.picture}`;
                li.appendChild(img);

                const div = document.createElement('div');
                div.classList.add('result_name_price', 'col-6');
                li.appendChild(div);

                const h3 = document.createElement('h3');
                h3.textContent = `${item.name}`;
                div.appendChild(h3);

                const pEl = document.createElement('p');
                pEl.textContent = `${item.price}`;
                div.appendChild(pEl);

                productList.appendChild(li);
            });
        });