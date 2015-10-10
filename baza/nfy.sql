drop database if exists nfy;
create database nfy character set utf8 collate utf8_general_ci;
use nfy;

#za potrebe mysql servera na webu
alter database character set utf8 collate utf8_general_ci;

create table korisnik (
	sifra int not null primary key auto_increment,
	nickname varchar(20) not null,
	ime varchar(20) not null,
	prezime varchar(20) not null,
	profilna varchar(100),
	adresa varchar(50) not null,
	grad varchar(20) not null,
	post_broj int not null,
	email varchar(50) not null,
	lozinka varchar(100) not null,
	ziro varchar(21),
	paypal varchar(50),
	administrator boolean default 0
);

create table ocjena(
	korisnik int not null,
	proizvod int not null,
	ocjena int not null
);

create table kor_pr(
	korisnik int not null,
	proizvod int not null,
	kolicina int not null,
	datum date not null,
	placanje varchar(10) not null
);

create table proizvod (
	sifra int not null primary key auto_increment,
	naziv varchar(20) not null,
	k_opis text not null,
	cijena decimal(18.2)not null,
	kategorija varchar(50) not null
);

create table komentar (
	korisnik int not null,
	proizvod int,
	opg int,
	komentar text not null,
	vrijeme datetime not null
);

create table opg_pr(
	opg int not null,
	proizvod int not null,
	kolicina int not null,
	potvrdi boolean
);

create table opg (
	sifra int not null primary key auto_increment,
	naziv varchar(50) not null,
	adresa varchar(50) not null,
	grad varchar(20) not null,
	post_broj int not null,
	email varchar(50) not null,
	lozinka varchar(100) not null,
	profilna varchar(100),
	ziro varchar(21),
	paypal varchar(50)
);

create table galerija (
	proizvod int not null,
	naslovna varchar(100) not null,
	slika0 varchar(100),
	slika1 varchar(100),
	slika2 varchar(100),
	slika3 varchar(100),
	slika4 varchar(100)	
);

alter table opg_pr add foreign key (opg) references opg(sifra);
alter table opg_pr add foreign key (proizvod) references proizvod(sifra);
alter table kor_pr add foreign key (korisnik) references korisnik(sifra);
alter table kor_pr add foreign key (proizvod) references proizvod(sifra);
alter table galerija add foreign key (proizvod) references proizvod(sifra);
alter table ocjena add foreign key (korisnik) references korisnik(sifra);
alter table ocjena add foreign key (proizvod) references proizvod(sifra);
alter table komentar add foreign key (korisnik) references korisnik(sifra);
alter table komentar add foreign key (proizvod) references proizvod(sifra);
alter table komentar add foreign key (opg) references opg(sifra);


insert into korisnik(ime, prezime, adresa, grad, post_broj, email, lozinka, administrator) values ("Luka", "Buljan", "A. Waldingera 5A", "Osijek", 31000, "admin@admin.os", md5("!admin@"), 1);

insert into opg(naziv, adresa, grad, post_broj, email, lozinka) values ("OPG Marić", "Vatroslava Doneganija 13", "Đakovo", 31400, "maric@opg.hr", md5("nemirna")),
	("OPG Stojanović", "Glavna ulica 41", "Branjin vrh", 31301, "dajana@opg.hr", md5("dstoja")), ("OPG Jakopec", "Lorenza Jaegera 9", "Osijek", 31000, "jakopec@opg.hr", md5("žakope"));
	
insert into proizvod(naziv, k_opis, cijena, kategorija) values ("Marić lubenice", "Najbolje lubenice u gradu, a ako ne u gradu, barem u ulici. Ako ne u ulici, onda ništa, barem se trudimo.", 1.80, "Voće"),
		("Marić kukuruz šećerac", "Najslađi kukuruz u okrugu. Definitivno, ovo je bez ikakve dvojbe.", 2.00, "Povrće"),
		("Stojanovićev med", "Slatki ko bombončić.", 40.00, "Pčelarski proizvod"), ("Jakopec Špice", "Prodajem bundevine sjemenke, pečene, po kili. PS: Dođite studirati informacijske tehnologije na filozofskom fakultetu u Osijeku!", 40.00, "Povrće");
insert into opg_pr(opg, proizvod, kolicina) values (1, 1, 20),
	(1, 2, 700), (2, 3, 1000), (3, 4, 500);
insert into galerija(proizvod, naslovna) values (1, "1_lubenica.jpg"), (2, "1_kukuruz.jpg"), (3, "2_med.jpg"), (4, "3_spica.jpg");