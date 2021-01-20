CREATE TABLE IF NOT EXISTS db.users (
    id bigint auto_increment,
    name varchar(200) NOT NULL,
    email varchar(200) NOT NULL,
    password varchar(100) NOT NULL,
    avatar varchar(100) NULL,
    token text NULL,
    created_at timestamp NOT NULL,
    updated_at timestamp NULL,
    deleted_at timestamp NULL,
    PRIMARY KEY(id)
)
