<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Quản lý bài viết</title>
    <link rel="stylesheet" href="src/assets/css/dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Quản lý bài viết</h1>

        <div class="actions">
            <a href="index.php?url=createPost" class="btn btn-add">Thêm bài viết</a>
            <a href="index.php?url=logout" class="btn" style="background:#7f8c8d;color:white;">Đăng xuất</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Ngày đăng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?= htmlspecialchars($post['id']) ?></td>
                            <td><?= htmlspecialchars($post['title']) ?></td>
                            <td><?= htmlspecialchars($post['author_name']) ?></td>
                            <td><?= date('d/m/Y', strtotime($post['created_at'])) ?></td>
                            <td>
                                <a href="index.php?url=viewPost&id=<?= $post['id'] ?>" 
                                   class="btn btn-view" target="_blank">Xem</a>
                                <a href="index.php?url=editPost&id=<?= $post['id'] ?>" 
                                   class="btn btn-edit">Sửa</a>
                                <a href="index.php?url=deletePost&id=<?= $post['id'] ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Xóa bài viết này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-data">Chưa có bài viết nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>