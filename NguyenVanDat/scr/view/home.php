<?php
require_once("../sql/connect.php");



// Hiển thị danh sách sách

$booklist = '';
foreach ($books as $item) {
  
   extract($item);
    $booklist .= '<tr>
                    <td>'. $title .'</td>
                    <td>'. $author_name .'</td>
                    <td>'. $category_name .'</td>
                    <td>'. $publisher .'</td>
                    <td>'. $publish_year .'</td>
                    <td>
                    <td><a href="index.php?page=edit&id='.$id.'">Sửa</a></td>
                    </td>
                    <td>
                    <td><a href="index.php?page=delete&id='.$id.'">Xóa</a></td>
                    </td>
                    
                  </tr>';
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="view/css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>ThiGiuKy</title>
  <style>
    #addBookForm {
      display: none;
    }
  </style>
</head>
<body>
  <div class="container mt-3">
   
    <h2>Tìm Kiếm</h2>
    <form action="index.php?page=search" method="post">
      <div class="mb-3 mt-3">
        <label for="search">Tìm Kiếm:</label>
        <input type="text" class="form-control" id="search" placeholder="Nhập" name="keyword" />
      </div>
      <button type="submit" name="btnsearch" class="btn btn-primary">Tìm</button>
    </form>
  </div>
  <hr />
  <form action="home.php" method="post">
    <div class="container mt-3">
      <h2>Danh Sách hiển thị</h2>
         <h3 style="color :red "><?=$tb?></h3>
      <table class="table">
        <thead>
          <tr>
            <th>Tên Sách</th>
            <th>Tác giả</th>
            <th>Thể loại</th>
            <th>Nhà xuất bản</th>
            <th>Năm xuất bản</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody id="bookList">
          <?=$booklist?>
        </tbody>
      </table>
      <button type="button" id="addBookButton" class="btn btn-success">Thêm sách</button>
    </div>
  </form>

  <?php include('addbook_form.php'); ?>
 

  
</body>
</html>

<script>
    document.getElementById('addBookButton').addEventListener('click', function() {
        document.getElementById('addBookForm').style.display = 'block';
    });
    document.getElementById('closeBookButton').addEventListener('click', function() {
        document.getElementById('addBookForm').style.display = 'none';
    });
</script>



