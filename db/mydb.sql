DROP TABLE IF EXISTS users, articles;


CREATE TABLE users (
    id SERIAL NOT NULL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE articles (
    id SERIAL NOT NULL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id),
	date_created DATE NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT
);

INSERT INTO users (id, username, password)
VALUES (DEFAULT, 'test', '$2y$10$2fw/Dcg/nvxNlkrR67heFOyM8Xh.nDURvSyOiNb2AgWYD7dZihxX');

INSERT INTO articles (id, user_id, date_created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tincidunt dui ut ornare lectus sit. Hendrerit dolor magna eget est lorem ipsum dolor. Integer feugiat scelerisque varius morbi. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Urna duis convallis convallis tellus id. Convallis tellus id interdum velit. Eu volutpat odio facilisis mauris sit amet massa vitae. Nisl pretium fusce id velit ut tortor pretium viverra suspendisse. Imperdiet massa tincidunt nunc pulvinar. Laoreet sit amet cursus sit amet. Libero id faucibus nisl tincidunt eget nullam. Nulla at volutpat diam ut venenatis tellus in metus vulputate. Dictumst quisque sagittis purus sit amet. Faucibus vitae aliquet nec ullamcorper sit amet risus nullam. Pharetra convallis posuere morbi leo urna molestie at elementum. Posuere morbi leo urna molestie at elementum eu. Nec feugiat nisl pretium fusce id velit ut. Tristique senectus et netus et malesuada fames ac.');

INSERT INTO articles (id, user_id, date_created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tincidunt dui ut ornare lectus sit. Hendrerit dolor magna eget est lorem ipsum dolor. Integer feugiat scelerisque varius morbi. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Urna duis convallis convallis tellus id. Convallis tellus id interdum velit. Eu volutpat odio facilisis mauris sit amet massa vitae. Nisl pretium fusce id velit ut tortor pretium viverra suspendisse. Imperdiet massa tincidunt nunc pulvinar. Laoreet sit amet cursus sit amet. Libero id faucibus nisl tincidunt eget nullam. Nulla at volutpat diam ut venenatis tellus in metus vulputate. Dictumst quisque sagittis purus sit amet. Faucibus vitae aliquet nec ullamcorper sit amet risus nullam. Pharetra convallis posuere morbi leo urna molestie at elementum. Posuere morbi leo urna molestie at elementum eu. Nec feugiat nisl pretium fusce id velit ut. Tristique senectus et netus et malesuada fames ac.');

INSERT INTO articles (id, user_id, date_created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tincidunt dui ut ornare lectus sit. Hendrerit dolor magna eget est lorem ipsum dolor. Integer feugiat scelerisque varius morbi. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Urna duis convallis convallis tellus id. Convallis tellus id interdum velit. Eu volutpat odio facilisis mauris sit amet massa vitae. Nisl pretium fusce id velit ut tortor pretium viverra suspendisse. Imperdiet massa tincidunt nunc pulvinar. Laoreet sit amet cursus sit amet. Libero id faucibus nisl tincidunt eget nullam. Nulla at volutpat diam ut venenatis tellus in metus vulputate. Dictumst quisque sagittis purus sit amet. Faucibus vitae aliquet nec ullamcorper sit amet risus nullam. Pharetra convallis posuere morbi leo urna molestie at elementum. Posuere morbi leo urna molestie at elementum eu. Nec feugiat nisl pretium fusce id velit ut. Tristique senectus et netus et malesuada fames ac.');

INSERT INTO articles (id, user_id, date_created, title, content)
VALUES (DEFAULT, (SELECT id FROM users), CURRENT_TIMESTAMP, 'Test4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tincidunt dui ut ornare lectus sit. Hendrerit dolor magna eget est lorem ipsum dolor. Integer feugiat scelerisque varius morbi. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Urna duis convallis convallis tellus id. Convallis tellus id interdum velit. Eu volutpat odio facilisis mauris sit amet massa vitae. Nisl pretium fusce id velit ut tortor pretium viverra suspendisse. Imperdiet massa tincidunt nunc pulvinar. Laoreet sit amet cursus sit amet. Libero id faucibus nisl tincidunt eget nullam. Nulla at volutpat diam ut venenatis tellus in metus vulputate. Dictumst quisque sagittis purus sit amet. Faucibus vitae aliquet nec ullamcorper sit amet risus nullam. Pharetra convallis posuere morbi leo urna molestie at elementum. Posuere morbi leo urna molestie at elementum eu. Nec feugiat nisl pretium fusce id velit ut. Tristique senectus et netus et malesuada fames ac.');