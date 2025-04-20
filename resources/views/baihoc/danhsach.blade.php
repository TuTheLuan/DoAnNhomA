@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-danger mb-4" style="text-shadow: 1px 1px 2px gray;">Khóa Học Ngôn Ngữ AI</h2>

    <div class="row justify-content-between align-items-start">
        <div class="col-md-7">
            <div id="lessonList">
                <!-- Danh sách bài học -->
            </div>

            <div class="mt-3 d-flex gap-3">
                <button class="btn btn-success">Thêm Bài Học</button>
                <button class="btn btn-danger">Xóa Bài Học</button>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <img src="{{ asset('images/ai-hand.png') }}" alt="AI" class="img-fluid rounded shadow-sm">
        </div>
    </div>
</div>

<style>
    .lesson-box {
        background-color: #efefef;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
    }

    .lesson-header {
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        font-weight: 600;
        background-color: #ddd;
        padding: 8px;
        border-radius: 6px;
    }

    .lesson-content {
        padding: 10px;
        display: none;
        background-color: #fff;
        margin-top: 5px;
        border-radius: 6px;
    }

    .lesson-content .file-item {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    .file-item img {
        width: 24px;
        height: 24px;
        margin-right: 8px;
    }

    .file-item .delete {
        margin-left: auto;
        color: red;
        cursor: pointer;
        font-weight: bold;
    }

    .edit-btn {
        margin-top: 5px;
        background-color: #5cb85c;
        color: white;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 14px;
        border: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lessons = [
            {
                number: 1,
                title: "Khái niệm ngôn ngữ AI",
                files: [
                    { icon: "doc.png", name: "Tài liệu bài 1" },
                    { icon: "ppt.png", name: "Tài liệu bài 1" }
                ]
            },
            {
                number: 2,
                title: "Làm quen với ngôn ngữ AI",
                files: []
            },
            {
                number: 3,
                title: "Từ khóa về ngôn ngữ AI",
                files: []
            }
        ];

        const lessonList = document.getElementById('lessonList');
        lessonList.innerHTML = '';

        lessons.forEach(lesson => {
            const box = document.createElement('div');
            box.className = 'lesson-box';

            const header = document.createElement('div');
            header.className = 'lesson-header';
            header.innerHTML = `Bài ${lesson.number}: ${lesson.title} <span>&#9660;</span>`;
            header.onclick = function () {
                const content = this.nextElementSibling;
                const icon = this.querySelector('span');
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                    icon.innerHTML = '&#9660;';
                } else {
                    content.style.display = 'block';
                    icon.innerHTML = '&#9650;';
                }
            };

            const content = document.createElement('div');
            content.className = 'lesson-content';

            lesson.files.forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <img src="/images/${file.icon}" alt="${file.name}">
                    ${file.name}
                    <span class="delete">x</span>
                `;
                content.appendChild(fileItem);
            });

            if (lesson.files.length > 0) {
                const editBtn = document.createElement('button');
                editBtn.className = 'edit-btn';
                editBtn.innerText = 'Chỉnh sửa';
                content.appendChild(editBtn);
            }

            box.appendChild(header);
            box.appendChild(content);
            lessonList.appendChild(box);
        });
    });
</script>
@endsection
