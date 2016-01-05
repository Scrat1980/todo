CREATE TABLE todo(
	id INT(10) NOT NULL AUTO_INCREMENT,
	title VARCHAR(50),
	description VARCHAR(50),
	PRIMARY KEY (id)
)
DEFAULT CHARACTER SET utf8;

INSERT INTO todo VALUES 
	(1, 'Answer e-mails', 'Today before lunch'),
	(2, 'Feed the cat', 'Feed the nasty animal'),
	(3, 'Clean the kitchen', 'Tomorrow')
;
