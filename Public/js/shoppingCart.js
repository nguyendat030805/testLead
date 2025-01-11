// Lắng nghe sự kiện cộng/trừ số lượng
document.addEventListener("DOMContentLoaded", function () {
    const quantityButtons = document.querySelectorAll(".quantity-btn");

    quantityButtons.forEach(button => {
        button.addEventListener("click", function () {
            const quantitySpan = this.parentNode.querySelector(".quantity");
            const price = parseFloat(quantitySpan.getAttribute("data-price"));
            let quantity = parseInt(quantitySpan.textContent);

            // Xử lý nút cộng/trừ
            if (this.classList.contains("plus")) {
                quantity++;
            } else if (this.classList.contains("minus") && quantity > 1) {
                quantity--;
            }

            quantitySpan.textContent = quantity;

            // Tính lại Subtotal
            const subtotalCell = this.parentNode.parentNode.querySelector(".subtotal");
            subtotalCell.textContent = `$${(quantity * price).toFixed(2)}`;

            // Cập nhật tổng giỏ hàng
            updateCartTotal();
        });
    });

    // Hàm cập nhật tổng tiền trong giỏ hàng
    function updateCartTotal() {
        const subtotals = document.querySelectorAll(".subtotal");
        let total = 0;

        subtotals.forEach(cell => {
            total += parseFloat(cell.textContent.replace("$", ""));
        });

        document.querySelector(".cart-total span").textContent = `$${total.toFixed(2)}`;
    }
});
