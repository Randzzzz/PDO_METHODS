CREATE TABLE Books (
  book_id INT PRIMARY KEY,
  title VARCHAR(50) NOT NULL,
  price INT
);

CREATE TABLE Booksellers (
  bookseller_id INT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  contact_info INT
);

CREATE TABLE Students (
  student_id INT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  student_number INT,
  year_level INT
);

CREATE TABLE Receipts (
  receipt_id INT PRIMARY KEY,
  sales_id INT,
  receipt_added DATE NOT NULL
);

CREATE TABLE Sales (
  sales_id INT PRIMARY KEY,
  book_id INT,
  student_id INT,
  bookseller_id INT,
  sales_added DATE NOT NULL
);

CREATE TABLE Inventory (
  inventory_id INT PRIMARY KEY,
  book_id INT,
  stock_level INT,
  inventory_added DATE NOT NULL
);
