# Agents

## Cursor Cloud specific instructions

This is a WordPress theme ("Agentic Workflow" by Tom de Visser). It is not a standalone application — it requires a WordPress + MySQL environment to run.

### Local Development Environment

The development environment uses:
- **PHP 8.3** with built-in development server
- **MariaDB** for the WordPress database
- **WordPress** installed at `/var/www/wordpress`
- **WP-CLI** for WordPress management

The theme is symlinked into WordPress: `/var/www/wordpress/wp-content/themes/agentic-workflow -> /workspace`

### Starting the dev server

```bash
sudo service mariadb start
cd /var/www/wordpress && php -S localhost:8080
```

The site is then available at `http://localhost:8080/`. Admin panel at `http://localhost:8080/wp-admin/` (credentials: admin/admin).

### Linting

Run PHP syntax checks:
```bash
php -l functions.php
php -l index.php
```

### Key gotchas

- There is no `package.json`, `composer.json`, or build step. The theme is pure PHP + CSS.
- The theme symlink must point to `/workspace` for live-editing to work.
- MariaDB must be started before the PHP dev server (`sudo service mariadb start`).
- WordPress salts in `wp-config.php` are auto-generated during setup; no secrets from the repo are needed for local dev.
- The deployment workflow (`.github/workflows/deploy-kinsta.yml`) uses SFTP secrets that only exist in GitHub — not needed locally.
