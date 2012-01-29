CREATE TABLE users (
	id SERIAL PRIMARY KEY,
	username VARCHAR(128) UNIQUE NOT NULL,
	password VARCHAR(32) NOT NULL,
	user_type VARCHAR(5) NOT NULL,
	cca boolean NOT NULL DEFAULT false;
);

CREATE TABLE vhosts (
	id SERIAL PRIMARY KEY,
	owner_id INTEGER NOT NULL REFERENCES users(id),
	hostname VARCHAR(64) NOT NULL,
	path_to VARCHAR(256) NOT NULL,
	info TEXT DEFAULT '',
	UNIQUE (owner_id, hostname)
);

create table custom_vhosts_configs (
  id SERIAL PRIMARY KEY,
  vhost_id INTEGER NOT NULL  REFERENCES vhosts(id) ON DELETE CASCADE,
  config TEXT DEFAULT ''
);