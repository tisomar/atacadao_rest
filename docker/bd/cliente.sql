CREATE TABLE IF NOT EXISTS `tbl_clientes` (
                                              `id` integer not null,
                                              `cpf` varchar(11) NOT NULL,
    `nome` varchar(256) NOT NULL,
    `dt_nascimento` date NOT NULL,
    `rg` char(25) NOT NULL
    );
ALTER TABLE `tbl_clientes` ADD INDEX(`id`);
ALTER TABLE `tbl_clientes` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
