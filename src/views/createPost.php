<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm bài viết mới</title>
    <link rel="stylesheet" href="src/assets/css/post.css">
</head>
<body>
    <div class="container">
        <h1>Thêm bài viết mới</h1>

        <form action="./storePost" method="POST">
            <div class="form-group">
                <label for="title">Tiêu đề bài viết</label>
                <input type="text" id="title" name="title" required placeholder="Nhập tiêu đề...">
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea id="content" name="content" required placeholder="Viết nội dung bài viết..."></textarea>
            </div>

            <div class="form-group">
                <label for="author">Tác giả</label>
                <input type="text" id="author" name="author" required placeholder="Tên tác giả..." value="<?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Lưu bài viết</button>
            <a href="index.php?url=dashboard" class="btn btn-secondary">Hủy</a>
        </form>

        <a href="index.php?url=dashboard" class="back-link">Quay lại danh sách</a>
    </div>
</body>
</html>