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

INSERT INTO users (id, username, password)
VALUES (DEFAULT, 'test', 'test');

INSERT INTO articles (id, user_id, created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test', 'This is a test');

INSERT INTO articles (id, user_id, created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test2', 'This is a test');

INSERT INTO articles (id, user_id, created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test3', 'This is a test');

INSERT INTO articles (id, user_id, created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test4', 'This is a test');