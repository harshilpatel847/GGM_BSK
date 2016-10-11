CREATE TABLE `ggm_bsk`.`homework` ( 
	`id` INT(11) NOT NULL AUTO_INCREMENT, 
	`reg_id` INT(11) NOT NULL , 
	`homework_date` DATE NOT NULL ,
	`assignment_num` INT(11) NOT NULL ,
	`homework_score` TINYINT(1) NOT NULL DEFAULT '0' ,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;