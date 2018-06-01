creat database:


  CREATE TABLE `user` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_name` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `company` varchar(200) NOT NULL,
   PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `user` (`user_id`, `user_name`, `birth`, `country`, `region`, `company`) VALUES
(1, 'John', '1990-01-12', 'USA', 'Seattle', 'IBM'),
(2, 'Kim',  '1989-05-22', 'China', 'Beijing', 'Taobao'),
(3, 'Lucy', '1987-01-08', 'Korea', 'ligong', 'LG');



CREATE TABLE `company` (
  `company_id` int(11) NOT NULL auto_increment,
  `company_name` varchar(100) NOT NULL,
  `country` varchar(200) NOT NULL,
  `industry` varchar(100) NOT NULL,
   PRIMARY KEY  (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `company` (`company_id`, `company_name`, `country`, `industry`) VALUES
(1, 'Edanz', 'USA', 'publish'),
(2, 'Tengxun', 'China', 'IT'),
(3, 'Taobao', 'China', 'IT');
