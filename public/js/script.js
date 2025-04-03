document.addEventListener("DOMContentLoaded", function() {
    console.log("Trang danh sách học viên đã tải xong!");

    // Tìm kiếm học viên
    document.getElementById("search").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        document.querySelectorAll("tbody tr").forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(searchValue) ? "" : "none";
        });
    });

    // Xóa học viên
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let studentId = this.getAttribute("data-id");
            if (confirm("Bạn có chắc chắn muốn xóa?")) {
                fetch(`/students/${studentId}`, { method: "DELETE" })
                .then(() => {
                    this.closest("tr").remove();
                    alert("Xóa thành công!");
                })
                .catch(err => alert("Lỗi khi xóa!"));
            }
        });
    });
});
