<?php 
if ($getBook) {
    extract($getBook);
} else {
    echo "Không tìm thấy dữ liệu sách.";
    exit(); // Ngừng thực thi mã nếu không tìm thấy sách
}
?>



<!-- Sửa Sách Form -->
<div class="container mt-3" id="editBookForm">
    <h3>Sửa Thông Tin Sách</h3>
    <form  method="post" action="index.php?page=update">
        
        <input type="hidden" name="id" value="<?=$id?>">
       
        <div class="mb-3">
            <label for="editTitle">Tên Sách:</label>
            <input type="text" class="form-control" name="title" value="<?=$title?>" placeholder="Tên Sách"/>
        </div>
        <button type="submit" name="btnupdate" class="btn btn-primary">Cập Nhật</button>
        <button type="button" id="closeEditBookButton" class="btn btn-secondary">Đóng</button>
    </form>
</div>

