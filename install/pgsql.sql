CREATE TABLE users (
	id SERIAL PRIMARY KEY,
	username VARCHAR(128) UNIQUE NOT NULL,
	password VARCHAR(32) NOT NULL,
	user_type VARCHAR(5) NOT NULL
);

CREATE TABLE vhosts (
	id SERIAL PRIMARY KEY,
	owner_id INTEGER NOT NULL REFERENCES users(id),
	hostname VARCHAR(64) NOT NULL,
	path_to VARCHAR(256) NOT NULL,
	info TEXT DEFAULT '',
	UNIQUE (owner_id, hostname)
);