DROP TABLE IF EXISTS users, articles;


CREATE TABLE users (
    id SERIAL NOT NULL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE articles (
    id SERIAL NOT NULL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id),
	created DATE NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT
);