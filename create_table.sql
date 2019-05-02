create table [dbo].[registration](
    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY(id),
    name VARCHAR(30),
    date_of_birth DATE,
    address VARCHAR(50),
    phone_number CHAR(13),
    email VARCHAR(30),
    join_date DATE
);