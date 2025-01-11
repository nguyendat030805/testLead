function submitOrder() {
    const recipient_name = document.querySelector("input[placeholder='Enter your full name']").value;
    const email = document.querySelector("input[placeholder='Enter your email']").value;
    const phone = document.querySelector("input[placeholder='Enter your phone number']").value;
    const note = document.querySelector("input[placeholder='Enter the note']").value;
    const address = document.querySelector("input[placeholder='Enter your address']").value;
    const city = document.querySelector("input[placeholder='Enter your provice / City']").value;

    fetch("/freshleaf_website/Order/placeOrder", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ recipient_name, email, phone, address, city, note })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Đặt hàng thành công!");
            window.location.href = "/freshleaf_website";
        } else {
            alert(data.message || "Đã có lỗi xảy ra!");
        }
    })
    .catch(error => console.error("Error:", error));
}