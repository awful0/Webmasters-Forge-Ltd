create database social;
use social;
create table users (
	id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,   /* БУДЕТ БОЛЬШЕ ПОЛЬЗОВАТЕЛЕЙ, УВЕЛИЧИМ ДО MEDIUMINT */
	name CHAR(15) UNIQUE NOT NULL,                    /* ИСПОЛЬЗУЕМ CHAR так так будем работать с ним при авторизации и char быстрей, */
						         /* к тому же это поле в индекс так как будет выборка по этому полю при */
							/* авторизации пользователей */
                                                       /* на свою страницу, естественно уникальный */
	email CHAR(80) NOT NULL,		      /* тоже работаем при авторизации */
	passwd CHAR(40) NOT NULL,		     /* тоже работаем при авторизации */
	avatar VARCHAR(50),                         /* а вот здесь уже экономим память */
	date DATE NOT NULL,			   /* дата регистрации пользователя */
	INDEX(name)				  /* добавляем в индекс */
);
