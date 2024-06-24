## Liven API


A API permite gerenciar cadastro de usuários e seus endereços utilizando token JWT para autenticação.
<br>
Um usuário pode realizar o cadastro, login no sistema, gerenciar seus próprios endereços e visualizá-los.
Porém ele possui acesso somente aos seus dados e endereços.
Além dos campos obrigatórios como name, email e password, o usuário pode opcionalmente registrar um cpf, o qual é único entre os registros.



A arquitetura do projeto segue o padrão MVC (Model-View-Controller), estruturado de forma modular. 
<br>
No diretório ```app/services```, estão os serviços que encapsulam a lógica de negócios da aplicação.
<br>
E em ```routes/api.php``` é possível ter uma visão geral das rotas além da documentação fornecida.


A documentação se encontra nesse link: https://app.swaggerhub.com/apis-docs/FABIOAUGUSTORODRIG/liven/1.0.0#/ 
<br>
Embora toda a aplicação e o ecossistema tenham sido escritos em inglês para manter um padrão, a documentação está em português apenas por questões de praticidade.


### Stack do projeto
- Laravel, Laravel foi escolhido como o framework para que fosse possível se dedicar apenas na regra de negócio e sua implementação;
- MySQL;
- PHP ^8.2;


### Configuração do Ambiente
1. **Arquivo de Configuração `.env`**
   - Faça uma cópia do arquivo `.env.example` e renomeie para `.env`.
   - Insira as informações do banco de dados no arquivo `.env`, incluindo o nome do banco de dados, usuário e senha.

2. **Instalação de Dependências**
   - No terminal, execute o comando abaixo para instalar as dependências do Composer:
     ```
     composer install
     ```

3. **Geração JWT Secret Key**
   - Execute o seguinte comando para gerar a secret key para jwt:
     ```
     php artisan jwt:secret
     ```

4. **Execução das Migrações do Banco de Dados**
   - Utilize o comando a seguir para aplicar as migrações do banco de dados:
     ```
     php artisan migrate
     ```


### Execução
Para executar o projeto utilize o seguinte comando para iniciar o servidor de desenvolvimento local: ```php artisan serve```
<br>
<b>Importante</b>: No projeto, o prefixo para todos os endpoints é <b>api</b>, por exemplo: ```GET http://127.0.0.1:8000/api/users```


### Testes automatizados
- Faça uma cópia do arquivo `.env` para `.env.testing`
- Insira as informações do banco de dados de <b>teste</b> no arquivo `.env.testing`, incluindo o nome do banco de dados, usuário e senha.
- Execute o comando ```php artisan test``` para ter o overview dos testes.
