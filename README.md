# SISTEMA DE CADASTRO

Sistema para cadastrar clientes

### **GIT:**
- [https://github.com/tisomar/atacadao_rest.git](https://github.com/tisomar/atacadao_rest.git)

### **Desenvolvedor:**
- Tiago de Souza Marques Rodrigues - [tisomar@gmail.com](mailto:tisomar@gmail.com)

---

### **Pré-requisitos**
```
Docker
docker-compose
```
### **Build Docker**

```
docker-compose up -d --build
```

### **Sem Uso do Docker**

```

Para executar a aplicação sem docker: 
é necessário acessar o arquivo api/config/bancodados.php e 
alterar os parâmetros de conexão do banco de dados.

Instalar:

PHP 7.4
MySql 5.7
Apache

Adicionar Virtualhost ao apache:

<VirtualHost *:80>

    ServerAdmin admin@localhost
    ServerName  localhost

    DocumentRoot /var/www/html/

    <Directory /var/www/html/>
        Options Indexes FollowSymLinks
        AllowOverride All
    </Directory>

</VirtualHost>

```


### ** Rotas ** ###

criar novo cliente: [http://localhost/api/cliente/criar.php](http://localhost/api/cliente/criar.php)

buscar clientes: [http://localhost/api/cliente/buscar.php?cpf=41531963390&nome=Geraldo](http://localhost/api/cliente/buscar.php?cpf=41531963390&nome=Geraldo)


### ** JSON Para Cadastrar Clientes ** ###
```
{
"cpf": "41531963390",
"nome": "José Geraldo",
"dt_nascimento": "1987-06-01",
"rg": "9999999"
}
```

| Banco de Dados|                         |
|---------------|---------------          | 
| **Host**             | 35.197.112.231   |
| **Porta**            | 3306             |
| **banco de dados**   | atacadao         |
| **Usuário**          | atacadao         |
| **Senha**            | atacadao         |


----

### **TABELAS DO SISTEMA**

|                   |                    |
|-------------------|--------------------|
| tbl_clientes 		| cadastro clientes  | 

