CREATE TABLE `users` (
	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
	`username` VARCHAR(128) NOT NULL,
	`password` VARCHAR(32) NOT NULL,
	`user_type` VARCHAR(5) NOT NULL,
	`cca` boolean NOT NULL DEFAULT false,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`username`)
) ENGINE = InnoDB;

CREATE TABLE `vhosts` (
	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
	`owner_id` INT(11) UNSIGNED NOT NULL,
	`hostname` VARCHAR(64) NOT NULL,
	`path_to` VARCHAR(256) NOT NULL,
	`info` TEXT,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`owner_id`,`hostname`),
    CONSTRAINT `vhost_owner` FOREIGN KEY (`owner_id`) REFERENCES users(`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE `custom_vhosts_configs` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
  `vhost_id` INT(11) UNSIGNED NOT NULL,
  `config` TEXT DEFAULT '',
  PRIMARY KEY (`id`),
  CONSTRAINT `vhost_config` FOREIGN KEY (`vhost_id`) REFERENCES vhosts(`id`) ON DELETE CASCADE
) ENGINE = InnoDB;
