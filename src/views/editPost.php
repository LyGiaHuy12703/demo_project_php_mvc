<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa bài viết</title>
    <link rel="stylesheet" href="src/assets/css/post.css">
</head>
<body>
    <div class="container">
        <h1>Sửa bài viết</h1>

        <form action="./updatePost" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea id="content" name="content" required><?= htmlspecialchars($post['content']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="author">Tác giả</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($post['author_name']) ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="index.php?url=dashboard" class="btn btn-secondary">Hủy</a>
        </form>

        <a href="index.php?url=dashboard" class="back-link">Quay lại danh sách</a>
    </div>
</body>
</html>