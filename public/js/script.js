document.addEventListener("DOMContentLoaded", function() {
    console.log("Trang danh sách học viên đã tải xong!");

    //Xác nhận thêm
    document.getElementById("student-form").addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Bạn có muốn thêm học viên không?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "OK",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit(); // Nếu OK thì submit form
            }
        });
    });
});
