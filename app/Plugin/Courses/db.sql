SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `courses` ;

CREATE TABLE IF NOT EXISTS `courses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `professors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `professors` ;

CREATE TABLE IF NOT EXISTS `professors` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `venues`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `venues` ;

CREATE TABLE IF NOT EXISTS `venues` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `course_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `course_details` ;

CREATE TABLE IF NOT EXISTS `course_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` INT UNSIGNED NOT NULL,
  `professor_id` INT UNSIGNED NOT NULL,
  `venue_id` INT UNSIGNED NOT NULL,
  `horas_totales` VARCHAR(45) NOT NULL,
  `horario` VARCHAR(45) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_termino` DATE NOT NULL,
  `precio_general` FLOAT(8,2) NOT NULL,
  `precio_unam` FLOAT(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `details_courses_course_id_idx` (`course_id` ASC),
  INDEX `details_courses_professor_id_idx` (`professor_id` ASC),
  INDEX `details_courses_venue_id_idx` (`venue_id` ASC),
  CONSTRAINT `fk_details_courses_course_id`
    FOREIGN KEY (`course_id`)
    REFERENCES `courses` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_details_courses_professor_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `professors` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_details_courses_venue_id`
    FOREIGN KEY (`venue_id`)
    REFERENCES `venues` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `students` ;

CREATE TABLE IF NOT EXISTS `students` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido_paterno` VARCHAR(45) NOT NULL,
  `apellido_materno` VARCHAR(45) NOT NULL,
  `matricula` INT UNSIGNED NOT NULL,
  `teléfono` VARCHAR(45) NOT NULL,
  `celular` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `comunidad_unam` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `matricula_UNIQUE` (`matricula` ASC),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC, `apellido_paterno` ASC, `apellido_materno` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `course_students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `course_students` ;

CREATE TABLE IF NOT EXISTS `course_students` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` INT UNSIGNED NOT NULL,
  `course_detail_id` INT UNSIGNED NOT NULL,
  `estado_del_pago` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_courses_students_1_idx` (`course_detail_id` ASC),
  INDEX `fk_courses_students_2_idx` (`student_id` ASC),
  CONSTRAINT `fk_courses_students_1`
    FOREIGN KEY (`course_detail_id`)
    REFERENCES `course_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_courses_students_2`
    FOREIGN KEY (`student_id`)
    REFERENCES `students` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'details_course_id';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
