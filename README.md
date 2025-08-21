> En tu .env para la base de datos
```
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=nombre_de_la_base_de_datos
DB_USERNAME=dba_produccion
DB_PASSWORD='contraceña_para_base_de_datos'
```

>comandos para docker

```
docker compose up --build -d

docker ps

docker compose down
```