        // Lấy các phần tử cần thiết
        const searchInput = document.getElementById('search-input');
        const overlay = document.getElementById('overlay');
        const searchResults = document.getElementById('search-results');

        // Dữ liệu mẫu để tìm kiếm
        let sampleData = [];
        fetch('data.json')
        .then(response => {
            return response.json();
        })
        .then(data => {
            sampleData = data;
        })

        /**
         * Xử lý sự kiện khi người dùng nhập liệu (oninput)
         */
        function handleSearch() {
            const query = searchInput.value.trim().toLowerCase();

            if (query.length > 0) {
                // Hiển thị lớp phủ và kết quả
                overlay.style.display = 'block';
                searchResults.style.display = 'block';

                // Lọc dữ liệu mẫu
                const filteredResults = sampleData.filter(item => {
                    const itemName = item.name ? item.name.toLowerCase() : '';

                    return itemName.includes(query);
                });

                // Cập nhật kết quả tìm kiếm
                renderResults(filteredResults);
            } else {
                // Ẩn lớp phủ và kết quả khi ô tìm kiếm trống
                overlay.style.display = 'none';
                searchResults.style.display = 'none';
                // Xóa các kết quả cũ
                searchResults.innerHTML = '';
            }
        }

        /**
         * Hàm hiển thị kết quả tìm kiếm vào thẻ <ul>
         */
        function renderResults(results) {
            // Xóa kết quả cũ
            searchResults.innerHTML = '';

            if (results.length === 0) {
                const li = document.createElement('li');
                li.textContent = "Không tìm thấy kết quả phù hợp.";
                searchResults.appendChild(li);
                return;
            }

            //ket qua moi
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
        
        // Tùy chọn: Ẩn lớp phủ và kết quả khi click bên ngoài (ví dụ: click vào lớp phủ)
        overlay.addEventListener('click', () => {
            overlay.style.display = 'none';
            searchResults.style.display = 'none';
            searchInput.value = ''; // Xóa nội dung tìm kiếm
        });