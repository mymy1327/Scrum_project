        const searchInput = document.getElementById('search-input');
        const overlay = document.getElementById('overlay');
        const searchResults = document.getElementById('search-results');

        function isUserLoggedIn() {
    return fetch('check_login.php')
        .then(response => {
            // check for network errors
            if (!response.ok) {
                throw new Error('internal server error');
            }
            return response.json();
        })
        .then(data => {
            return data.loggedIn;
        })
        .catch(error => {
            console.error("checking login status error", error);
            return false; // suppose not logged in on error
        });
}
document.addEventListener('DOMContentLoaded', () => {
    attachAddToCartListeners();
});
// avoid user enter the cart page when not logged in
        const cartIcon = document.getElementById('cart_icon');
        cartIcon.addEventListener('click', async (event) => {
            event.preventDefault(); // prevent default link behavior
            const loggedIn = await isUserLoggedIn();
            const notification = document.getElementById('notification');
            
            if (loggedIn) {
                window.location.href = '/scrum_project/code/cart_review.php';
            } else {
                // if not logged in
                
                notification.classList.add('show');

                notification.innerHTML = 'Please <a href="/scrum_project/code/login.php" class="login-link">log in</a> to view your cart.';
        
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 5000);
        }
    });
        //Take information from json
        let sampleData = [];
        fetch('/scrum_project/code/javascript_json/data.json')
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
                i.addEventListener('click', async () => {
                    const loggedIn = await isUserLoggedIn();
                    const notification = document.getElementById('notification');

                    if (loggedIn) {
                        const response = await addToCart(result);
                        // if logged in
                        if (response.success) {
                            notification.classList.add('show');
                            setTimeout(() => {
                                notification.classList.remove('show');
                            }, 2000);
                        } else {
                            //Failed to add to cart
                            notification.classList.add('show');
                            notification.textContent = response.message || 'Error: could not add to cart.';
                            notification.style.backgroundColor = '#FF4040';
                            }
                            setTimeout(() => {
                            notification.classList.remove('show');
                            notification.style.backgroundColor = '';
                            }, 2000);
                        } else {
                        // if not logged in
                        notification.classList.add('show');

                        notification.innerHTML = 'Please <a href="/scrum_project/code/login.php" class="login-link">log in</a> to add items to your cart.';
                        setTimeout(() => {
                            notification.classList.remove('show');
                        }, 5000);
                    }
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
        async function addToCart(product) {
            const cartData = {
                name: product.name,
                price: product.price,
                image: product.picture
            };
            try {
            const response = await fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
            },
            body: JSON.stringify(cartData),
        });

        // check respone (500 Server Error)
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const data = await response.json();
        
        // check logic respone (data.success)
        return data; // get back {success: true, message: '...'} or {success: false, message: '...'}

    } catch (error) {
        console.error('error when add product into cart', error);
        return { success: false, message: 'connection error or server error' };
    }
}
async function removeFromCart(productName) {
    try {
        const response = await fetch('/scrum_project/code/php_sites/only_php/remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ product_name: productName }),
        });

        if (!response.ok) {
            throw new Error(`error HTTP: ${response.status}`);
        }

        const data = await response.json();
        
        // Update cart UI if removal was successful
        if (data.success) {
            // show notification
            const notification = document.getElementById('notification');
            notification.classList.add('show');
            notification.textContent = 'Product removed from cart.';
        }
        
        return data;

    } catch (error) {
        console.error('error when delete product from cart', error);
        return { success: false, message: 'error connection' };
    }
}


document.addEventListener('DOMContentLoaded', () => {
    
    const deleteIcons = document.querySelectorAll('.delete-item-icon');

    deleteIcons.forEach(icon => {
        icon.addEventListener('click', async (event) => {
            // take product name from data attribute
            const productName = event.currentTarget.getAttribute('data-product-name');
            const notification = document.getElementById('notification');
            
            if (!productName) {
                console.error("cannot find product name to delete");
                return;
            }

            const result = await removeFromCart(productName); 

            // show notification
            notification.classList.add('show');
            
            if (result.success) {
                notification.textContent = result.message || 'product removed from cart.';
                notification.style.backgroundColor = '#48C5FF';
                
                // reload page to reflect changes
                setTimeout(() => {
                    window.location.reload(); 
                }, 1000); 

            } else {
                notification.textContent = result.message || 'error removing product.';
                notification.style.backgroundColor = '#FF4040';
                setTimeout(() => {
                    notification.classList.remove('show');
                    notification.style.backgroundColor = '';
                }, 2000); 
            }
        });
    });
});

async function renderCategoryCards(itemContainer, filterCategory = null ) {
    const categoryContainer = document.getElementById('itemContainer');

    if(!categoryContainer) {
        console.error("cannot find item container to render category cards");
        return;
    }

    if (sampleData.length === 0) {
        try {
            const response = await fetch('/scrum_project/code/javascript_json/data.json');
            if (!response.ok) {
                throw new Error('network response was not ok');
            }
            sampleData = await response.json();
        } catch (error) {
            categoryContainer.innerHTML = '<p>Error loading data.</p>';
            console.error('error fetching data.json', error);
            return;
        }
    }

    // filter items by category if specified
    let itemsToRender = sampleData;
    if (filterCategory) {
        itemsToRender = sampleData.filter(item => item.category === filterCategory);
    }

    if (itemsToRender.length === 0) {
        itemContainer.innerHTML = '<p>No items found in this category.</p>';
        return;
    }

    categoryContainer.innerHTML = '';
    itemsToRender.forEach(item => {
        categoryContainer.innerHTML += `
            <div class="card card-for-each-product">
                <img src="${item.picture}" class="card-img-top" alt="${item.name}">
                <div class="card-body">
                <h5 class="card-title">${item.name}</h5>
                <p class="card-text">Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä Tekstiä</p>
                <p>${item.price}</p> 
                <button class="btn btn-primary add-to-cart-btn"
                data-name="${item.name}"
                data-price="${item.price}" 
                data-image="${item.picture}" >Add to cart</button>
            </div>
            </div>`;
    })
    attachAddToCartListeners();;
}

function attachAddToCartListeners() {
 const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', async (event) => {
            event.preventDefault();
                    const notification = document.getElementById('notification');
                    const productData = {
                name: button.dataset.name,
                price: button.dataset.price,
                picture: button.dataset.image 
            };

            const response = await addToCart(productData);

            if (response.success) {
                // show success notification
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 2000);

            } else {
                // show error notification
                if (response.message.includes('Require login')) {
                    notification.innerHTML = ' Please <a href="/scrum_project/code/php_sites/login.php" class="login-link">log in</a> to add items to your cart.';
                } else {
                    notification.textContent = `Error: ${response.message}`;
                }
                notification.style.backgroundColor = '#FF4040';
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                    notification.style.backgroundColor = '';
                }, 5000);
            }
        });
    });
};

console.log("Working");