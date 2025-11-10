        const searchInput = document.getElementById('search-input');
        const overlay = document.getElementById('overlay');
        const searchResults = document.getElementById('search-results');

        //Take information from json
        let sampleData = [];
        fetch('data.json')
        .then(response => {
            return response.json();
        })
        .then(data => {
            sampleData = data;
        })

        //Search for products
        function handleSearch() {
            const query = searchInput.value.trim().toLowerCase();

            if (query.length > 0) {
                // Show overlay and results
                overlay.style.display = 'block';
                searchResults.style.display = 'block';

                // filter 
                const filteredResults = sampleData.filter(item => {
                    const itemName = item.name ? item.name.toLowerCase() : '';

                    return itemName.includes(query);
                });

                renderResults(filteredResults);
            } else {
                overlay.style.display = 'none';
                searchResults.style.display = 'none';

                searchResults.innerHTML = '';
            }
        }

        /**
         * Add result into <ul> element and show them in a list
         */
        function renderResults(results) {

            searchResults.innerHTML = '';

            if (results.length === 0) {
                const li = document.createElement('li');
                li.textContent = "No results.";
                searchResults.appendChild(li);
                return;
            }

            results.forEach(result => {
                const li = document.createElement('li');
                li.classList.add('container', 'row');
                const img = document.createElement('img');
                img.classList.add('result_picture', 'col-3');
                img.src = `${result.picture}`;
                li.appendChild(img);
                const div = document.createElement('div');
                div.classList.add('result_name_price', 'col-6');
                li.appendChild(div);
                const h3 = document.createElement('h3');
                h3.textContent = `${result.name}`;
                div.appendChild(h3);
                const p = document.createElement('p');
                p.textContent = `${result.price}`;
                div.appendChild(p);
                const i = document.createElement('i');
                i.classList.add('bx', 'bx-plus', 'bx-flip-horizontal', 'col-3');
                li.appendChild(i);
                i.addEventListener('click', () => {
                    addToCart(result);
                });
                searchResults.appendChild(li);
            });

        }
        
        // erase results when click out
        overlay.addEventListener('click', () => {
            overlay.style.display = 'none';
            searchResults.style.display = 'none';
            searchInput.value = '';
        });
        // adding products into cart page
        function addToCart(product) {
            const cart = JSON.parse(localStorage.getItem('cartItems')) || [];
            const existingProduct = cart.find(item => item.name === product.name);

            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                product.quantity = 1;
                cart.push(product);
            }
            localStorage.setItem('cartItems', JSON.stringify(cart));
        }