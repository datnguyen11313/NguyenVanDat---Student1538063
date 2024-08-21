<?php
// Kết nối Database
function connectDB(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=dbgiuaky", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

// Lấy tất cả dữ liệu
function get_all($sql, $params = []){
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

// Chỉ lấy 1 value
function get_one($sql, $params = []){
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}

// Hàm dùng để insert dữ liệu
function insertData($sql, $params = []){
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $conn = null;
}

// Cập nhật dữ liệu
function update($sql, $params = []){
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $conn = null;
}

// Xóa dữ liệu
function deleteData($sql, $params = []){
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $conn = null;
}

// Check khóa ngoại
function checkBook($idcategory){
    $sql = "SELECT * FROM ThongTinSach WHERE category_id = :idcategory";
    $check = get_all($sql, ['idcategory' => $idcategory]);
    return count($check);
}

// Hàm xử lý SQL
function showAll(){
    $sql = 'SELECT ThongTinSach.id, title, TacGia.author_name, category.category_name, ThongTinSach.publisher, ThongTinSach.publish_year
            FROM ThongTinSach 
            JOIN TacGia ON ThongTinSach.author_id = TacGia.id 
            JOIN category ON ThongTinSach.category_id = category.id';
    return get_all($sql);
}

// Thêm sách mới
function getAuthorId($author_name) {
    $sql = "SELECT id FROM TacGia WHERE author_name = :author_name";
    $result = get_one($sql, ['author_name' => $author_name]);
    return $result ? $result['id'] : null;
}

function insertAuthor($author_name) {
    $sql = "INSERT INTO TacGia (author_name) VALUES (:author_name)";
    insertData($sql, ['author_name' => $author_name]);
    return getAuthorId($author_name);
}

function insertBook($title, $author_name, $category_id, $publisher, $publish_year) {
    $author_id = getAuthorId($author_name);
    if (!$author_id) {
        $author_id = insertAuthor($author_name);
    }
    $sql = "INSERT INTO ThongTinSach (title, author_id, category_id, publisher, publish_year) 
            VALUES (:title, :author_id, :category_id, :publisher, :publish_year)";
    insertData($sql, [
        'title' => $title, 
        'author_id' => $author_id, 
        'category_id' => $category_id, 
        'publisher' => $publisher, 
        'publish_year' => $publish_year
    ]);
}

// Xóa sách
function deleteRecord($id){
    $kiemtra = checkBook($id);
    if ($kiemtra > 0) {
        return 'Không được phép xóa !! Khóa Ngoại đó !!';
    } else {
        $sql = "DELETE FROM ThongTinSach WHERE id = :id";
        deleteData($sql, ['id' => $id]);
        return 'Xóa Thành Công';
    }
}

// Lấy thông tin sách theo ID
function getBookById($id) {
    $sql = "SELECT * FROM ThongTinSach WHERE id = :id";
    return get_one($sql, ['id' => $id]);
}

// Cập nhật thông tin sách
function updateBook($id, $title) {
    $sql = "UPDATE ThongTinSach SET title = :title WHERE id = :id";
    update($sql, ['title' => $title, 'id' => $id]);
}

// Lấy danh sách thể loại
function getCategories() {
    $sql = "SELECT id, category_name FROM category";
    return get_all($sql);
}


function searchBooks($keyword) {
    $sql = 'SELECT ThongTinSach.id, title, TacGia.author_name, category.category_name, ThongTinSach.publisher, ThongTinSach.publish_year
            FROM ThongTinSach 
            JOIN TacGia ON ThongTinSach.author_id = TacGia.id 
            JOIN category ON ThongTinSach.category_id = category.id
            WHERE title LIKE :keyword OR TacGia.author_name LIKE :keyword OR category.category_name LIKE :keyword';
    
    $params = [
        'keyword' => '%' . $keyword . '%'
    ];
    
    return get_all($sql, $params);
}

