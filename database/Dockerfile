FROM mysql:8.0

WORKDIR /var/lib/mysql

# Variáveis de ambiente do MySQL
ENV MYSQL_ROOT_PASSWORD=rootpassword
ENV MYSQL_DATABASE=mydatabase
ENV MYSQL_USER=myuser
ENV MYSQL_PASSWORD=mypassword

ADD Sql.sql /docker-entrypoint-initdb.d/

# Porta padrão do MySQL
EXPOSE 3306

# O CMD e ENTRYPOINT já vêm configurados na imagem oficial mysql:8.0
# Não é necessário 

