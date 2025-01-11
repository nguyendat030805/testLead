document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    const editForm = document.getElementById('editProductForm');
    const cancelEdit = document.getElementById('cancelEdit');
    const updateForm = document.getElementById('updateForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            editForm.style.display = 'block';

            fetch(`/freshleaf_website/Admin/getProductDetails?id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editProductId').value = data.product_id;
                    document.getElementById('editProductName').value = data.product_name;
                    document.getElementById('editPrice').value = data.price;
                    document.getElementById('editDescription').value = data.description;
                    document.getElementById('editUnit').value = data.unit;
                    document.getElementById('editCategory').value = data.category_name;

                    const currentImage = document.getElementById('currentProductImage');
                    if (data.product_image) {
                        currentImage.src = data.product_image;
                        currentImage.style.display = 'block';
                    } else {
                        currentImage.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    cancelEdit.addEventListener('click', function () {
        editForm.style.display = 'none';
    });

    updateForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/freshleaf_website/Admin/updateProduct', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product updated successfully!');
                window.location.reload();
            } else {
                alert('Failed to update product.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
