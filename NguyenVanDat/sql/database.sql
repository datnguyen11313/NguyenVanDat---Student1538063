create database DBgiuaky

use DBgiuaky

create table ThongTinSach(
id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT,
    category_id INT,
    publisher VARCHAR(255),
    publish_year YEAR,
    quantity INT,
    FOREIGN KEY (author_id) REFERENCES TacGia(id),
    FOREIGN KEY (category_id) REFERENCES category(id)
)


create table TacGia(
 id INT AUTO_INCREMENT PRIMARY KEY,
    author_name VARCHAR(255) NOT NULL,
    book_numbers INT
)


create table category(
 id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL

)



INSERT INTO category (category_name) VALUES
('Fiction'),
('Fantasy'),
('Science Fiction'),
('Non-fiction');

INSERT INTO TacGia (author_name, book_numbers) VALUES
('Nguyen Nhat Anh', 10),
('J.K. Rowling', 7),
('Haruki Murakami', 15);

INSERT INTO ThongTinSach (title, author_id, category_id, publisher, publish_year, quantity) VALUES
('Cho toi mot ve di tuoi tho', 1, 1, 'NXB Tre', 2008, 5),
('Harry Potter and the Philosopher\'s Stone', 2, 2, 'Bloomsbury', 1997, 10),
('Norwegian Wood', 3, 1, 'Vintage', 1987, 7),
('1Q84', 3, 3, 'Shinchosha', 2009, 8);










