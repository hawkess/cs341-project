CREATE TABLE users (
    id SERIAL NOT NULL PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE articles (
    id SERIAL NOT NULL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id),
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(191) NOT NULL UNIQUE,
    body TEXT
);

CREATE TABLE tags (
    id SERIAL NOT NULL PRIMARY KEY,
    title VARCHAR(191) UNIQUE
);

CREATE TABLE articles_tags (
    article_id INT NOT NULL REFERENCES articles(id),
    tag_id INT NOT NULL REFERENCES tags(id),
    PRIMARY KEY (article_id, tag_id)
);