<?php


require_once("../sql/connect.php");


// Xài switch case

if (isset($_GET["page"])) {
    switch ($_GET["page"]) {
        case "delete":
            if (isset($_GET["id"]) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $tb = deleteRecord($id);
            }
            $books = showAll();
            include "view/home.php";
            
            break;

        case "add":
            if (isset($_POST['btnadd'])) {
                $title = $_POST['title'] ?? '';
                $author_name = $_POST['author_name'] ?? '';
                $category_id = $_POST['category_id'] ?? '';
                $publisher = $_POST['publisher'] ?? '';
                $publish_year = $_POST['publish_year'] ?? '';
                
                if ($title && $author_name && $category_id && $publisher && $publish_year) {
                    insertBook($title, $author_name, $category_id, $publisher, $publish_year);
                    // Redirect to home page after adding the book
                    header("Location: index.php?page=home");
                    exit();
                }
            }
            // Default behavior if not POST or missing required data
            $books = showAll();
            include "view/home.php";
            break;

        case "edit":
            $tb = "";
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $getBook = getBookById($id);
            }
            include("view/editbook_form.php");
            $books = showAll();
            include "view/home.php";
            break;

        case "update":
            $tb = "";
            if (isset($_POST["btnupdate"])) {
                $id = $_POST["id"] ?? '';
                $title = $_POST['title'] ?? '';
                if ($id && $title) {
                    updateBook($id, $title);
                    // Redirect to home page after updating the book
                    header("Location: index.php");
                    exit();
                }
            }
            $books = showAll();
            include "view/home.php";
            break;


            case "search":
                if (isset($_POST['keyword'])) {
                    $keyword = $_POST['keyword'];
                    $books = searchBooks($keyword);
                    $tb = count($books) . " kết quả tìm thấy cho từ khóa: " . htmlspecialchars($keyword);
                } else {
                    $books = showAll();
                    $tb = "Vui lòng nhập từ khóa để tìm kiếm.";
                }
                include "view/home.php";
                break;

        default:
            $tb = "";
            $books = showAll();
            include "view/home.php";
            break;
    }
} else {
    $tb = "";
    $books = showAll();
    include "view/home.php";
}
