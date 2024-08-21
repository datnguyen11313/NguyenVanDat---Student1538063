<?php
require_once("../sql/connect.php");
$categories = getCategories(); // Lấy danh sách thể loại
?>

<!-- Add Book Form -->
<div class="container mt-3" id="addBookForm" style="display: none;">
    <h3>Thêm Sách Mới</h3>
    <form method="post" action="index.php?page=add">
        <div class="mb-3">
            <label for="title">Tên Sách:</label>
            <input type="text" class="form-control" id="title" name="title" required />
        </div>
        <div class="mb-3">
            <label for="author_name">Tác giả:</label>
            <input type="text" class="form-control" id="author_name" name="author_name" required />
        </div>
        <div class="mb-3">
            <label for="category_id">Thể loại:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Chọn thể loại</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']); ?>">
                        <?= htmlspecialchars($category['category_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="publisher">Nhà xuất bản:</label>
            <input type="text" class="form-control" id="publisher" name="publisher" required />
        </div>
        <div class="mb-3">
            <label for="publish_year">Năm xuất bản:</label>
            <input type="number" class="form-control" id="publish_year" name="publish_year" min="1900" max="2099" step="1" required />
        </div>
        <button type="submit" name="btnadd" class="btn btn-primary">Thêm Sách</button>
        <button type="button" id="closeBookButton" class="btn btn-secondary">Đóng</button>
    </form>
</div>
