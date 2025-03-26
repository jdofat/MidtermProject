/*

✅Create a database named “quotesdb” with 3 tables and these specific column names:
✅a) quotes (id, quote, author_id, category_id) - ✅the last two are foreign keys
✅b) authors (id, author)
✅c) categories (id, category)

✅d) id is the primary key in each table
✅e) The id column should also auto-increment
✅f) All columns should be non-null

*/

CREATE DATABASE quotesdb;

  CREATE TABLE authors (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    author VARCHAR(255) NOT NULL
  );

  CREATE TABLE categories (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    category VARCHAR(255) NOT NULL
  );

CREATE TABLE quotes (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  quote NOT NULL,
  author_id INT NOT NULL,
  category_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

/*
✅QUOTES: 
1."The only way to do great work is to love what you do." - J.R.R. Tolkien 
2."The future belongs to those who believe in the beauty of their dreams." - Eleanor Roosevelt 
3."Believe you can and you're halfway there." - Theodore Roosevelt 
4."The mind is not a vessel to be filled, but a fire to be kindled." - Plutarch 
5."Education is the most powerful weapon which you can use to change the world." - Nelson Mandela 
6."The roots of education are bitter, but the fruit is sweet." - Aristotle 
7."To live is the rarest thing in the world. Most people exist, that is all." – Oscar Wilde
8."Change is the end result of all true learning." - Leo Buscaglia 
9."The only person you are destined to become is the person you decide to be." - Ralph Waldo Emerson 
10."The secret to getting ahead is getting started." - Mark Twain 
11."Your education is a dress rehearsal for a life that is yours to lead." - Nora Ephron 
12."Failure is simply the opportunity to begin again, this time more intelligently." - Henry Ford 
13."A person who never made a mistake never tried anything new." - Albert Einstein 
14."The beautiful thing about learning is nobody can take it away from you." - B.B. King 
15."Learning never exhausts the mind." - Leonardo da Vinci 
16."An investment in knowledge pays the best interest." - Benjamin Franklin 
17."The whole purpose of education is to turn mirrors into windows." - Sydney J. Harris 
18."Education is not preparation for life; education is life itself." - John Dewey 
19."It is only with the heart that one can see rightly; what is essential is invisible to the eye." - Antoine de Saint-Exupéry 
20."Learning is not attained by chance, it must be sought for with ardor and attended to with diligence." - Abigail Adams 
21."That it will never come again is what makes life so sweet." – Emily Dickinson
22."It is never too late to be what you might have been." – George Eliot
23."To be yourself in a world that is constantly trying to make you something else is the greatest accomplishment." – Ralph Waldo Emerson
24."Pain is inevitable. Suffering is optional." – Haruki Murakami
25."All the world's a stage, and all the men and women merely players." – William Shakespeare
26."Be kind, for everyone you meet is fighting a hard battle." – Plato
27."Unable are the loved to die for love is immortality." – Emily Dickinson
28."The power of education extends beyond the development of skills we need for economic success." - Nelson Mandela

#AUTHORS: 25
1.J.R.R. Tolkien
2.Eleanor Roosevelt
3.Theodore Roosevelt
4.Plutarch
5.Nelson Mandela
6.Aristotle
7.Oscar Wilde
8.Leo Buscaglia
9.Ralph Waldo Emerson
10.Mark Twain
11.Nora Ephron
12.Henry Ford
13.Albert Einstein
14.B.B. King
15.Leonardo da Vinci
16.Benjamin Franklin
17.Sydney J. Harris
18.John Dewey
19.Antoine de Saint-Exupéry
20.Abigail Adams
21.Emily Dickinson
22.George Eliot
23.Haruki Murakami
24.William Shakespeare
25.Plato



#CATEGORIES: 4
 1. Inspirational (1, 2, 3, 4, 9, 10, 11, 12, 13, 22, 23)
 2. Love (27, 19, 26)
 3. Pain (24, 21, 25)
 4. Education (5, 6, 8, 11, 14, 15, 16, 17, 18, 28)



✅1. A quote with an id = 10.
✅2. An author with an id = 5. 
✅3. A categeory with an id = 4. 
✅4. Your author with the id = 5 should have two quotes in the category id = 4. 

✅INSERT QUOTES: 
*/

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The only way to do great work is to love what you do.", 1, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The future belongs to those who believe in the beauty of their dreams.", 2, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Believe you can and you're halfway there.", 3, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The mind is not a vessel to be filled, but a fire to be kindled.", 4, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Education is the most powerful weapon which you can use to change the world.", 5, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The roots of education are bitter, but the fruit is sweet.", 6, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("To live is the rarest thing in the world. Most people exist, that is all.", 7, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Change is the end result of all true learning.", 8, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The only person you are destined to become is the person you decide to be.", 9, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The secret to getting ahead is getting started.", 10, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Your education is a dress rehearsal for a life that is yours to lead.", 11, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Failure is simply the opportunity to begin again, this time more intelligently.", 12, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("A person who never made a mistake never tried anything new.", 13, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The beautiful thing about learning is nobody can take it away from you." , 14, 4);
  
INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Learning never exhausts the mind.", 15, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("An investment in knowledge pays the best interest.", 16, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The whole purpose of education is to turn mirrors into windows.", 17, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Education is not preparation for life; education is life itself.", 18, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("It is only with the heart that one can see rightly; what is essential is invisible to the eye.", 19, 2);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Learning is not attained by chance, it must be sought for with ardor and attended to with diligence.", 20, 4);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("That it will never come again is what makes life so sweet.", 21, 3);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("It is never too late to be what you might have been.", 22, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("To be yourself in a world that is constantly trying to make you something else is the greatest accomplishment.", 9, 1);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Pain is inevitable. Suffering is optional.", 23, 3);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("All the world's a stage, and all the men and women merely players.", 24, 3);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Be kind, for everyone you meet is fighting a hard battle.", 25, 2);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("Unable are the loved to die for love is immortality.", 21, 2);

INSERT INTO quotes (quote, author_id, category_id)
  VALUES ("The power of education extends beyond the development of skills we need for economic success.", 5, 4);




