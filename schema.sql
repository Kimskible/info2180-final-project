DROP DATABASE IF EXISTS bugme;
CREATE DATABASE bugme;
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER ON bugme.* TO 'bugmeapp'@'localhost' IDENTIFIED BY 'password';
USE bugme;

/*Currently hashing in database it might be better to do it in PHP*/
CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`firstname` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL UNIQUE,
	`password` CHAR(32) NOT NULL,
	`date_joined` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);
/* Added role table to differentiate between an admin and regular user*/
CREATE TABLE `roles` (
	`roleid` INT NOT NULL AUTO_INCREMENT,
	`role_name` varchar(255),
	PRIMARY KEY (`roleid`)
);

INSERT into roles(role_name)
VALUES('admin'),('reg');

CREATE TABLE `userroles` (
	`userid` INT NOT NULL UNIQUE,
	`roleid` INT NOT NULL DEFAULT 2,
	FOREIGN KEY (`userid`) REFERENCES `users`(`id`) ON DELETE CASCADE,
	FOREIGN KEY (`roleid`) REFERENCES `roles`(`roleid`)
	
);

CREATE TABLE `issues` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`description` TEXT,
	`type` enum('bug','proposal','task') NOT NULL,
	`priority` enum('minor','major','critical') NOT NULL,
	`status` enum('open','closed','inprogress') NOT NULL,
	`assigned_to` INT NOT NULL,
	`created_by` INT NOT NULL,
	`created` DATETIME NOT NULL,
	`updated` DATETIME,
	PRIMARY KEY (`id`)
);

ALTER TABLE `issues` ADD CONSTRAINT `issues_fk0` FOREIGN KEY (`assigned_to`) REFERENCES `users`(`id`);
ALTER TABLE `issues` ADD CONSTRAINT `issues_fk1` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`);
 
 
 
DELIMITER // 

CREATE PROCEDURE `login`(IN `email` varchar(255), IN `password` char(32))
BEGIN
	SELECT * 
	FROM users 
	INNER JOIN userroles ON users.id=userroles.userid 
	WHERE users.email = email and users.password=password;
END //


/*SELECT * FROM `users`
 WHERE `email` = '<the email address entered by the user>'
   AND `password` = ;*/

/*  assigned to USER-ISSUES Query
*CREATE PROCEDURE*
SELECT * FROM `issues` FROM
INNER JOIN users ON users.id=issues.id WHERE user.id="USERID";*/


/*  1 -Administrator 2-Regular*/

CREATE PROCEDURE `add_User`(IN `firstname` VARCHAR(45),IN `lastname` VARCHAR(45),IN `email` VARCHAR(45),IN `p_Passw` VARCHAR(200))
BEGIN
	INSERT into users(`firstname`,lastname,email,`password`,date_joined) 
	VALUES (`firstname`,`lastname`,`email`,MD5(`p_Passw`),CURDATE());
	INSERT INTO userroles(userid) VALUES (LAST_INSERT_ID());

	
END //

CREATE PROCEDURE `add_adminUser`(IN `firstname` VARCHAR(45),IN `lastname` VARCHAR(45),IN `email` VARCHAR(45),IN `p_Passw` VARCHAR(200))
BEGIN
	INSERT into users(`firstname`,lastname,email,`password`,date_joined) 
	VALUES (`firstname`,`lastname`,`email`,MD5(`p_Passw`),CURDATE());
	INSERT INTO userroles(userid,roleid) VALUES (LAST_INSERT_ID(),1);

	
END //

/*

CREATE PROCEDURE `getIssuesAssgnTo`(IN `userid` INT)
BEGIN
	SELECT * FROM `issues`
	INNER JOIN users ON users.id=issues.id ;
END //

*/

CREATE PROCEDURE `createIssue`(IN `title` varchar(255),
	IN `description` TEXT,
	IN `type` enum('bug','proposal','task'),
	IN `priority` enum('minor','major','critical'),
	IN `status` enum('open','closed','inprogress') ,
	IN `assigned_to` INT,
	IN `created_by` INT)
	BEGIN
	INSERT into issues(title,description,type,priority,status,assigned_to,created_by,created)
	VALUES (title,`description`,`type`,priority,`status`,assigned_to,created_by,NOW());
	END //



CREATE PROCEDURE `updateIssue`(IN `issueID` INT,IN `title` varchar(255),
	IN `description` TEXT,
	IN `type` enum('bug','proposal','task'),
	IN `priority` enum('minor','major','critical'),
	IN `status` enum('open','closed','inprogress') ,
	IN `assigned_to` INT,
	IN `created_by` INT,
	`created` DATETIME,
	`updated` DATETIME)
BEGIN
	UPDATE issues SET issues.updated = CURDATE(), issues.description = issues.description,
	type=type,priority = priority
	WHERE issues.id = issueID

END // 

DELIMITER ;


/*Adding admin user*/
CALL add_adminUser('Phil','Rich','admin@bugme.com','password123');
/*Making user Admin*/

/*
