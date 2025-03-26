/*
Insure you have the following in your data: 

1. A quote with an id = 10.
2. An author with an id = 5. 
3. A categeory with an id = 4. 
4. Your author with the id = 5 should have two quotes in the category id = 4. 

- The id field of each table should be set to auto-increment.
- The authors table has 2 fields: id, author
- The categories table has 2 fields: id, category
- The quotes table has 4 fields, id, quote, author_id, category_id
Minimum 5 categories. Minimum 5 authors. Minimum
25 quotes total for initial data. 
- The author_id is linked to the foreign key id from the author table. 
- The category_id is linked to the foreign key id from the category table.
- The id column for each table is the PRIMARY KEY.
- All columns in all tables should be NOT NULL.

1) You will build a PHP OOP REST API for quotations - both famous quotes and user submissions
2) ALL quotes are required to have ALL 3 of the following:
a) Quote (the quotation itself)
b) Author
c) Category
3) Create a database named “quotesdb” with 3 tables and these specific column names:
a) quotes (id, quote, author_id, category_id) - the last two are foreign keys
b) authors (id, author)
c) categories (id, category)
d) id is the primary key in each table
e) The id column should also auto-increment
f) All columns should be non-null 
*/
