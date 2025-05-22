document.addEventListener("DOMContentLoaded", function() {
    console.log("Trang danh sách học viên đã tải xong!");

    // Chỉ gắn sự kiện nếu tồn tại form có ID "student-form"
    const studentForm = document.getElementById("student-form");
    if (studentForm) {
        studentForm.addEventListener("submit", function (e) {
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
    }
});
