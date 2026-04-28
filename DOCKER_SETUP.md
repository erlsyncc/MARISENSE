# MARISENSE — Docker One-Command Setup

This file gives a simple, copy-pasteable workflow to start the app with Docker and import the provided database dump (NO migrations). Follow the steps exactly in a terminal (macOS / Linux / Git Bash). See the Windows PowerShell note at the end.

## 1) Build and start containers (one command)

Open a terminal, navigate to the project root, then run:

```bash
cd src && \
docker compose up -d --build
```

This builds and starts the app, database, phpMyAdmin and mail server.

## 2) Build, start, wait for DB, then import the SQL dump (single paste)

Copy-paste the entire block below into the terminal (it will wait for MySQL and then import the dump):

```bash
cd src && \
docker compose up -d --build && \
echo "Waiting for database (may take 10-60s)..." && \
until docker exec marisense-db mysqladmin ping -uroot -proot --silent; do sleep 2; done && \
echo "Importing database dump (NO migrations)..." && \
docker exec -i marisense-db mysql -uroot -proot marisense_vrbms < ../marisense_db.sql && \
echo "Import complete. App: http://localhost:8080  phpMyAdmin: http://localhost:8081 (user=root pass=root)"
```

What this does (brief):
- `cd src` — uses the compose file inside `src/`.
- `docker compose up -d --build` — builds and starts the services defined in `src/docker-compose.yml`.
- `until ... mysqladmin ping` — waits until MySQL accepts connections.
- `docker exec -i marisense-db mysql ... < ../marisense_db.sql` — imports the provided SQL dump into database `marisense_vrbms`.

## 3) Stop and remove containers + volumes

```bash
cd src && docker compose down -v
```

## Windows PowerShell (if not using WSL / Git Bash)

1) From `src` run:

```powershell
docker compose up -d --build
```

2) After DB is healthy, import the dump with:

```powershell
Get-Content ..\marisense_db.sql | docker exec -i marisense-db mysql -uroot -proot marisense_vrbms
```

## Notes & credentials
- Default DB credentials (from compose): user `root` with password `root`, DB name `marisense_vrbms`.
- The import uses the provided `marisense_db.sql` which contains schema and dummy data — no migrations are required.
- If Docker asks for permissions, accept them. On Windows prefer WSL or Git Bash for best compatibility.
