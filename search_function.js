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
         * Add result into <ul> element
         */
        function renderResults(results) {

            searchResults.innerHTML = '';

            if (results.length === 0) {
                const li = document.createElement('li');
                li.textContent = "Không tìm thấy kết quả phù hợp.";
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
                searchResults.appendChild(li);
            });

        }
        
        // erase results when click out
        overlay.addEventListener('click', () => {
            overlay.style.display = 'none';
            searchResults.style.display = 'none';
            searchInput.value = '';
        });