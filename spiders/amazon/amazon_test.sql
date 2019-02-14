drop table if exists 'amazon_test';
create table amazon_test (
  id int not null unsigned auto_increment,
  category varchar (100) default '',
  rank varchar (10) default '',
  title varchar(200) default '',
  main_img_url varchar (1000) default '',
  start varchar (10) default '',
  review_num varchar (100) default '',
  price varchar (100) default '',
  primary key ('id')
);