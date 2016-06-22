SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `calendar` ;
CREATE SCHEMA IF NOT EXISTS `calendar` DEFAULT CHARACTER SET latin1 ;
USE `calendar` ;

-- -----------------------------------------------------
-- Table `calendar`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calendar`.`roles` ;

CREATE  TABLE IF NOT EXISTS `calendar`.`roles` (
  `id` INT(11) NOT NULL ,
  `nom` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `calendar`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calendar`.`Users` ;

CREATE  TABLE IF NOT EXISTS `calendar`.`Users` (
  `id` INT(11) NOT NULL ,
  `nom` VARCHAR(50) NOT NULL ,
  `login` VARCHAR(50) NOT NULL ,
  `pwd` VARCHAR(32) NOT NULL ,
  `email` VARCHAR(50) NULL DEFAULT NULL ,
  `ip` VARCHAR(20) NULL DEFAULT NULL ,
  `fk_role` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `login` (`login` ASC) ,
  INDEX `role` (`fk_role` ASC) ,
  CONSTRAINT `role`
    FOREIGN KEY (`fk_role` )
    REFERENCES `calendar`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `calendar`.`type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calendar`.`type` ;

CREATE  TABLE IF NOT EXISTS `calendar`.`type` (
  `id` INT NOT NULL ,
  `type` VARCHAR(45) NOT NULL DEFAULT 'private' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `calendar`.`calendar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calendar`.`calendar` ;

CREATE  TABLE IF NOT EXISTS `calendar`.`calendar` (
  `id` VARCHAR(50) NOT NULL ,
  `nom` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(50) NULL DEFAULT NULL ,
  `fk_type` INT NULL ,
  `fk_proprietaire` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_` (`fk_proprietaire` ASC) ,
  INDEX `type` (`fk_type` ASC) ,
  CONSTRAINT `fk_`
    FOREIGN KEY (`fk_proprietaire` )
    REFERENCES `calendar`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `type`
    FOREIGN KEY (`fk_type` )
    REFERENCES `calendar`.`type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `calendar`.`events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calendar`.`events` ;

CREATE  TABLE IF NOT EXISTS `calendar`.`events` (
  `id` SMALLINT(6) NOT NULL ,
  `date_from` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `date_to` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `libelle` VARCHAR(50) NOT NULL ,
  `calendar_fk` VARCHAR(50) NOT NULL ,
  `fk_proprietaire` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `events_calendar_fk_idx` (`calendar_fk` ASC) ,
  INDEX `fk_calendar` (`calendar_fk` ASC) ,
  INDEX `proprio` (`fk_proprietaire` ASC) ,
  CONSTRAINT `fk_calendar`
    FOREIGN KEY (`calendar_fk` )
    REFERENCES `calendar`.`calendar` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `proprio`
    FOREIGN KEY (`fk_proprietaire` )
    REFERENCES `calendar`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `calendar`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `calendar`;
INSERT INTO `calendar`.`roles` (`id`, `nom`) VALUES (1, 'proprietaire');
INSERT INTO `calendar`.`roles` (`id`, `nom`) VALUES (2, 'collaborateur');
INSERT INTO `calendar`.`roles` (`id`, `nom`) VALUES (3, 'lecteur');

COMMIT;

-- -----------------------------------------------------
-- Data for table `calendar`.`Users`
-- -----------------------------------------------------
START TRANSACTION;
USE `calendar`;
INSERT INTO `Users` (`id`,`nom`,`login`,`pwd`,`email`,`ip`,`fk_role`) VALUES (1,'Denis','Dragon Rouge','5d933eef19aee7da192608de61b6c23d','dboogaerts@gmail.com','127.12.12.34',1);
INSERT INTO `Users` (`id`,`nom`,`login`,`pwd`,`email`,`ip`,`fk_role`) VALUES (2,'Emilie','emo','df90e13fa7699df8a377946815cf5dc4',NULL,NULL,3);
INSERT INTO `Users` (`id`,`nom`,`login`,`pwd`,`email`,`ip`,`fk_role`) VALUES (3,'Carmelo','carme','f71dbe52628a3f83a77ab494817525c6',NULL,NULL,2);
COMMIT;

-- -----------------------------------------------------
-- Data for table `calendar`.`type`
-- -----------------------------------------------------
START TRANSACTION;
USE `calendar`;
INSERT INTO `calendar`.`type` (`id`, `type`) VALUES (1, 'public');
INSERT INTO `calendar`.`type` (`id`, `type`) VALUES (2, 'private');
INSERT INTO `calendar`.`type` (`id`, `type`) VALUES (3, 'shared');

COMMIT;
