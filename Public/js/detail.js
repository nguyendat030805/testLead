document.addEventListener("DOMContentLoaded", function () {
    const quantityButtons = document.querySelectorAll(".quantity-btn");

    quantityButtons.forEach(button => {
        button.addEventListener("click", function () {
            const quantitySpan = this.parentNode.querySelector(".quantity-value");
            const price = parseFloat(quantitySpan.getAttribute("data-price"));

            if (isNaN(price)) {
                console.error("Giá sản phẩm không hợp lệ");
                return;
            }

            let quantity = parseInt(quantitySpan.textContent);
            if (this.classList.contains("increase")) {
                quantity++;
            } else if (this.classList.contains("decrease") && quantity > 1) {
                quantity--;
            }
            quantitySpan.textContent = quantity;
        });
    });
});
document.getElementById('rating').addEventListener('change', function() {
    const rating = parseInt(this.value); // Lấy giá trị từ select (1-5)
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            stars += '★'; // Sao đầy
        } else {
            stars += '☆'; // Sao trống
        }
    }
    document.getElementById('star-rating').innerText = stars; // Hiển thị sao động
});

