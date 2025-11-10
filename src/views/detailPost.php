<!-- src/views/detail_post.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?> - Chi tiết</title>
    <link rel="stylesheet" href="src/assets/css/detail.css">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2em;
            font-weight: 600;
        }
        .meta {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
            font-size: 0.95em;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
            line-height: 1.8;
            font-size: 1.1em;
        }
        .content p {
            margin-bottom: 1.2em;
        }
        .actions {
            padding: 20px;
            text-align: center;
            background: #f9f9f9;
            border-top: 1px solid #eee;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 0 5px;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-back {
            background: #6c757d;
            color: white;
        }
        .btn-edit {
            background: #007bff;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .not-found {
            text-align: center;
            padding: 50px;
            color: #777;
            font-size: 1.2em;
        }
        @media (max-width: 768px) {
            .header h1 { font-size: 1.6em; }
            .meta { flex-direction: column; gap: 8px; }
            .content { padding: 20px; font-size: 1em; }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($post): ?>
            <div class="header">
                <h1><?= htmlspecialchars($post['title']) ?></h1>
                <div class="meta">
                    <span>Tác giả: <strong><?= htmlspecialchars($post['author_name'] ?? 'Không rõ') ?></strong></span>
                    <span>Ngày đăng: <strong><?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></strong></span>
                    <?php if (isset($post['views'])): ?>
                        <span>Lượt xem: <strong><?= number_format($post['views']) ?></strong></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="content">
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </div>

            <div class="actions">
                <a href="index.php?url=dashboard" class="btn btn-back">Quay lại</a>
                <a href="index.php?url=editPost&id=<?= $post['id'] ?>" class="btn btn-edit">Sửa</a>
                <a href="index.php?url=deletePost&id=<?= $post['id'] ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('Xóa bài viết này?');">Xóa</a>
            </div>
        <?php else: ?>
            <div class="not-found">
                <h2>Bài viết không tồn tại</h2>
                <a href="index.php?url=dashboard" class="btn btn-back">Quay lại danh sách</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>