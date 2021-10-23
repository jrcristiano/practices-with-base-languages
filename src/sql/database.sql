/* Categories */

create table categories(
	`id` bigint unsigned primary key auto_increment,
    `name` varchar(255) not null,
    `created_at` timestamp default current_timestamp
);

insert into `categories`(`name`) values('Eletrônicos');


/* Products */

create table products(
	`id` bigint unsigned primary key auto_increment,
    `name` varchar(255) not null,
    `price` decimal(10,4) not null,
    `category_id` bigint unsigned not null,
    `created_at` timestamp default current_timestamp,
    foreign key (`category_id`) references `categories`(`id`)
);

insert into products(`name`, `price`, `category_id`) values('Notebook DELL', 4999.9900, 1);
insert into products(`name`, `price`, `category_id`) values ('Patinete elétrico', 1999.9900, 1);