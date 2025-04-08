@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-danger mb-4">Danh Sách Bài Học</h2>

    <div class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 700px;" id="lessonList">
        <!-- Danh sách bài học được hiển thị ở đây -->
    </div>
</div>

<style>
    .lesson-item {
        border: 1px solid #ddd;
        border-radius: 6px;
        margin-bottom: 10px;
        background: #f9f9f9;
    }

    .lesson-header {
        padding: 10px;
        font-weight: 600;
        cursor: pointer;
        background: #e0f7fa;
    }

    .lesson-header:hover {
        background: #b2ebf2;
    }

    .lesson-content {
        padding: 10px;
        display: none;
    }

    .lesson-content a {
        color: #007bff;
        text-decoration: underline;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lessons = [
            { number: 1, title: "Giới thiệu về AI", fileName: "gioi-thieu-ai.pdf" },
            { number: 2, title: "Học máy cơ bản", fileName: "hoc-may-co-ban.pdf" }
        ];

        const lessonList = document.getElementById('lessonList');

        function renderLessons() {
            lessonList.innerHTML = '';
            lessons.forEach((lesson) => {
                const item = document.createElement('div');
                item.className = 'lesson-item';

                const header = document.createElement('div');
                header.className = 'lesson-header';
                header.textContent = `Bài ${lesson.number}: ${lesson.title}`;
                header.onclick = function () {
                    const content = this.nextElementSibling;
                    content.style.display = (content.style.display === 'block') ? 'none' : 'block';
                };

                const content = document.createElement('div');
                content.className = 'lesson-content';
                content.innerHTML = `<strong>Tài liệu:</strong> <a href="/storage/files/${lesson.fileName}" target="_blank">${lesson.fileName}</a>`;

                item.appendChild(header);
                item.appendChild(content);
                lessonList.appendChild(item);
            });
        }

        renderLessons();
    });
</script>
@endsection
