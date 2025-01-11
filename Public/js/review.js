// // Chức năng cho phép chọn sao và bỏ chọn sao
// const stars = document.querySelectorAll('.star');
// const radios = document.querySelectorAll('input[name="rating"]');

// stars.forEach(star => {
//     star.addEventListener('click', () => {
//         const value = star.getAttribute('data-value');
//         const currentChecked = document.querySelector('input[name="rating"]:checked');
        
//         // Kiểm tra nếu sao đã được chọn
//         if (currentChecked && currentChecked.value === value) {
//             // Nếu người dùng nhấn vào sao đã chọn, bỏ chọn sao đó và các sao sau
//             stars.forEach(star => {
//                 if (parseInt(star.getAttribute('data-value')) >= value) {
//                     star.classList.remove('selected');
//                 }
//             });
//             radios.forEach(radio => {
//                 if (radio.value === value) {
//                     radio.checked = false; // Bỏ chọn radio button
//                 }
//             });
//         } else {
//             // Đánh dấu sao được chọn và tất cả các sao trước đó
//             stars.forEach(star => star.classList.remove('selected'));

//             // Chọn sao hiện tại và tất cả các sao trước nó
//             for (let i = 0; i < value; i++) {
//                 stars[i].classList.add('selected');
//             }

//             radios.forEach(radio => {
//                 if (radio.value === value) {
//                     radio.checked = true;
//                 }
//             });
//         }
//     });
// });

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.stars').forEach(starContainer => {
        const stars = starContainer.querySelectorAll('.star');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                // Xóa trạng thái chọn của tất cả sao
                stars.forEach(s => s.classList.remove('selected'));

                // Đánh dấu các sao từ 0 đến index
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.add('selected');
                }

                // Đặt giá trị cho input radio tương ứng
                const radio = starContainer.querySelector(`input[value="${index + 1}"]`);
                if (radio) radio.checked = true;
            });
        });
    });
});