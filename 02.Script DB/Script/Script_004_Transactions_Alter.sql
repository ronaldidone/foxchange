ALTER TABLE `primpijt_primevideo`.`transactions` 
ADD COLUMN `id_cashier` INT NULL DEFAULT 0 AFTER `payer_fee`;