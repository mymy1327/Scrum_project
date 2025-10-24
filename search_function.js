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
            displayInfo(sampleData);
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
                const filteredResults = sampleData.filter(item =>
                    item.toLowerCase().includes(query)
                );

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

            // Thêm các kết quả mới
            results.forEach(result => {
                const li = document.createElement('li');
                li.textContent = result;
                searchResults.appendChild(li);
            });
        }
        
        // Tùy chọn: Ẩn lớp phủ và kết quả khi click bên ngoài (ví dụ: click vào lớp phủ)
        overlay.addEventListener('click', () => {
            overlay.style.display = 'none';
            searchResults.style.display = 'none';
            searchInput.value = ''; // Xóa nội dung tìm kiếm
        });
        // Thêm hàm này vào trong thẻ <script>
    function performSearch() {
    // Khi người dùng bấm nút, ta buộc gọi hàm handleSearch() 
    // để hiển thị lớp phủ và kết quả (nếu có nội dung)
    handleSearch(); 
    
    // Bạn có thể thêm logic tìm kiếm chuyên sâu hơn tại đây, 
    // ví dụ: gửi yêu cầu tìm kiếm đến máy chủ.
    
    // Hiện tại, ta chỉ cần đảm bảo lớp phủ và kết quả được hiển thị
    const query = searchInput.value.trim();
    if (query.length > 0) {
        alert(`Bạn đang tìm kiếm: ${query}`); 
    } else {
        alert("Vui lòng nhập từ khóa tìm kiếm.");
    }
}