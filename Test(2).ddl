DROP TABLE IF EXISTS productincart;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS orderedproduct;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS manager;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS product;

CREATE TABLE customer (
uname VARCHAR(40) NOT NULL,
password VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  securityQ VARCHAR(40),
  securityA VARCHAR(40),
  address VARCHAR(40) NOT NULL,
 PRIMARY KEY (uname));

create table manager(
mname VARCHAR(40) NOT NULL,
password VARCHAR(10) NOT NULL,
  email VARCHAR(50) NOT NULL,
  securityQ VARCHAR(40),
  securityA VARCHAR(40),
  address VARCHAR(40) NOT NULL,
PRIMARY KEY(mname),
FOREIGN KEY(mname) REFERENCES customer (uname) ON DELETE CASCADE ON UPDATE CASCADE
);

create table product (
pID int NOT NULL,
pname VARCHAR(80) NOT NULL,
price DECIMAL(9,2) NOT NULL,
alreadysold int NOT NULL,
ovrate int ,
category VARCHAR(50) NOT NULL,
inventory int NOT NULL,
description VARCHAR(500) NOT NULL,
image VARCHAR(200),
PRIMARY KEY(pID));

CREATE TABLE orders (
oID int NOT NULL,
uname VARCHAR(40) NOT NULL,
orderstatus VARCHAR(30) NOT NULL,
CHECK (orderstatus ='A step shipping' or orderstatus='B  step processing' or orderstatus='C step delivered'),
cardnumber int NOT NULL,
nameoncard VARCHAR(40) NOT NULL,
totalamount DECIMAL(9,2),
PRIMARY KEY(oID,uname),
FOREIGN KEY(uname) REFERENCES customer (uname) ON DELETE CASCADE ON UPDATE CASCADE);


create table productincart (
 pID int NOT NULL,
uname VARCHAR(40) NOT NULL,
pname VARCHAR (80) NOT NULL,
quantity int NOT NULL,
price DECIMAL(9,2) NOT NULL,
PRIMARY KEY(uname,pID),
FOREIGN KEY(uname) REFERENCES customer (uname) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(pID) REFERENCES product (pID) ON DELETE CASCADE ON UPDATE CASCADE
);

create table orderedproduct (
pID int NOT NULL,
oID int NOT NULL,
uname VARCHAR(40) NOT NULL,
quantity int NOT NULL,
price DECIMAL(9,2) NOT NULL,
PRIMARY KEY(pID,oID,uname),
FOREIGN KEY(uname) REFERENCES customer (uname)ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(pID) REFERENCES product (pID)ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(oID) REFERENCES orders (oID)ON DELETE CASCADE ON UPDATE CASCADE
);


create table comment (
dates DATE NOT NULL,
rate int NOT NULL,
description VARCHAR(500),
pID int NOT NULL,
uname VARCHAR(40) NOT NULL,
PRIMARY KEY(pID,uname),
FOREIGN KEY(pID) REFERENCES product (pID) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(uname) REFERENCES customer (uname) ON DELETE CASCADE ON UPDATE CASCADE);


INSERT INTO customer VALUES('c1','pass1','99999@qq.com','QUESTION1','ANSWER1',"111 sk Dr");
INSERT INTO customer VALUES('c2','pass2','88888@qq.com','QUESTION2','ANSWER2',"222 sk Dr");
INSERT INTO customer VALUES('manager','manager','888888@qq.com','QUESTION2','ANSWER2',"222 sk Dr");
INSERT INTO manager VALUES('manager','manager','888888@qq.com','QUESTION2','ANSWER2',"222 sk Dr");

INSERT INTO product VALUES(1,'FENDI Iridia cat-eye gold-tone and acetate sunglasses',384,3,null,"woman",30,"Fendi's coveted 'Iridia' sunglasses have been spotted on everyone from Izabel Goulart to Chiara Ferragni. A chic take on the classic cat-eye shape' they're topped with black acetate and gold tips to accentuate your cheekbones.",'images/product/product1.jpg');

INSERT INTO product VALUES(2,'GUCCI Damascato Cat Eye Gold Dark Green Mother-of-Pearl Sunglasses',289.00,5,null,"woman",43,"Etched metal frames with tortoiseshell trim detail these glamorous Gucci cat-eye sunglasses",'images/product/product2.jpg');

INSERT INTO product VALUES(3,'SAINT LAURENT Black New Surf & Gold Wayfarer Sunglasses',378.00,6,null,"woman",33,"WELLINGTON-SHAPED SUNGLASSES FEATURING NYLON LENSES AND ACETATE TEMPLES.",'images/product/product3.jpg');

INSERT INTO product VALUES(4,'GUCCI Damascato Cat Eye Gold Pure White Mother-of-Pearl Sunglasses',289,3,null,"woman",30,"Etched metal frames with tortoiseshell trim detail these glamorous Gucci cat-eye sunglasses. Gradient lenses. Hard case and cleaning cloth included.",'images/product/product4.jpg');

INSERT INTO product VALUES(5,'SAINT LAURENT Classic 11 Aviators 100% UV mirrored lenses',499.00,5,null,"man",43,"Opt for a timeless sunglasses silhouette with Saint Laurent's 11 Zero aviators. The sleek arms are engraved with the label's iconic branding and have classic tortoiseshell-effect tips' while adjustable nose pads ensure daylong comfort. Work yours with sharp tailoring or off-duty dresses for an instant hit of cool.",'images/product/product5.jpg');

INSERT INTO product VALUES(6,'FENDI Iridia FF 0041/S (VIO/G5) Havana Gold/Azure Mirror Sunglasses',276.90,6,null,"woman",33,"Fendi keep their Glamorous appeal intact with rich color palettes'That are flourished with Italian style. These classically Sophisticated Frames immediately add VIP Status to your daily ensemble.",'images/product/product6.jpg');

INSERT INTO product VALUES(7,'ZANZAN Le Tabou Acetate The Power of Sunglasses',155.9,3,null,"woman",30,"Black Grey Full Rim Aviator Shape Medium (Size-56) Vincent Chase TOP GUNS VC S11075 -C1 Sunglasses",'images/product/product7.jpg');

INSERT INTO product VALUES(8,'FENDI Tropical Shine Dark Brown Round Sunglasses',459.9,5,null,"man",43,"This style glows with a sophisticated blend of Caribbean colors' double bridge and metal temples with the iconic angular shape. Made of transparent and black acetate with a graduated effect.",'images/product/product8.jpg');

INSERT INTO product VALUES(9,'Le Specs The Prince Matte Black Aviator Sunglasses',118.9,6,null,"man",33,"Clear-frame eyewear is having a moment. So what better route into the look than Céline's D-frame acetate sunglasses? Based on the label's now-cult debut style' this pair boasts green-to-brown gradient lenses and signature studded temples.",'images/product/product9.jpg');


INSERT INTO orders VALUES (1,'c1','A step shipping',112233,'ka1','112.60');
INSERT INTO orderedproduct VALUES (1,1,'c1',3,31.40);
INSERT INTO orderedproduct VALUES (2,1,'c1',5,81.20);

INSERT INTO orders VALUES (2,'c2','B step processing',998877,'ka2','112.60');
INSERT INTO orderedproduct VALUES (2,2,'c2',2,81.20);
INSERT INTO orderedproduct VALUES (1,2,'c2',9,31.40);


INSERT INTO comment VALUES ('1998-8-9',2,'this is a good',1,'c1');
INSERT INTO comment VALUES ('1998-8-9',1,'this is a good too',2,'c1');
