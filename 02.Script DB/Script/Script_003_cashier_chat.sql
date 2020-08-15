CREATE TABLE `primpijt_primevideo`.`cashier_chat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_transaccion` INT NOT NULL,
  `id_user` INT NULL,
  `message` VARCHAR(255) NULL,
  `fecha_hora` TIMESTAMP NULL,
  PRIMARY KEY (`id`));
