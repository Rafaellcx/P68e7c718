## PULSES

Projeto foi criado para o teste de conhecimentos da Pulses.  

## Solução

Elaborado utilizando o framework Laravel 8, VueJS 2,  banco de dados MySQL e Docker para conteinerização da aplicação. O código foi escrito em inglês para manter um melhor padrão de desenvolvimento e as mensagens de retorno estão propositalmente em português.

Obs: O arquivo `.env` foi enviado junto ao projeto(**mesmo ciente de que não é uma boa prática**) com o intuito de facilitar a execução do projeto fazendo com que o avaliador não tenha que fazer tais configurações no mesmo.
## Como executar o projeto

Após baixar o repositório **P68e7c718**, estando na pasta principal do mesmo"**P68e7c718**", suba a estrutura composta pelos seguintes containers:

- **pulses_back:** Composto com Apache e PHP, sendo exposta a porta `8000`;
- **pulses_front**: Usando Nginx com a aplicação front-end(VueJS), sendo exposta a porta `8001`;
- **pulses_banco:** Com o banco de dados MySql.

Através do seguinte comando:
```sh 
docker-compose up --build
```

Após a finalização da criação dos containers, devemos executar os comandos abaixo para que o ambiente esteja pronto para ser usado:

> 1. Utilizado para popular o banco com as tabelas necessárias da solução:
   ```sh 
   docker exec -ti pulses_back php artisan migrate
   ```
> 2. Utilizado para criar os tipos de usuários:
```sh 
docker exec -it  pulses_back php artisan db:seed --class=TypeUserSeeder
```
> 3. Utilizado para criar um usuário do tipo administrador:
```sh 
docker exec -it  pulses_back php artisan db:seed --class=UserSeeder
```
Agora podemos utilizar a aplicação através do endereço "http://localhost:8001". 
Para fazer o login, devemos utilizar o E-mail: `admin@gmail.com` e a Senha: `123456`

Caso queira rodar a aplicação posteriormente, verifique se os containers `pulses_back`, `pulses_front` e `pulses_banco` estão ativos executando o seguinte comando:

```sh
docker container ls -a
```
Caso queira iniciar os containers  `pulses_back`, `pulses_front` e `pulses_banco`, execute o seguinte comando:
```sh
docker container start pulses_back pulses_front pulses_banco
```
Caso queira parar os containers `pulses_back`, `pulses_front` e `pulses_banco`, execute o seguinte comando:
```sh
docker container stop pulses_back pulses_front pulses_banco
```
## Endpoints para testes
##### Lembrete: Como quase todas as rodas requerem autenticação, não se esqueça de configurar o `Header` do seu endpoint com a chave: `Authorization`  e o valor: `bearer`  `valor do token`

| USER |  |
| ------ | ------ |
| Listar todos | http://127.0.0.1:8000/api/user/all |
| Buscar um usuário em específico | http://127.0.0.1:8000/api/user/show/{id} |
| Salvar | http://127.0.0.1:8000/api/user/store |

## Estrutura JSON para os seguintes endpoints

### Exemplo para salvar um usuário:
```sh
{
  "type_user_id": 1,
  "name": "admin",
  "email": "admin@gmail.com",
  "password": "123456"
}
```
| Legenda | salvando um usuário |
| ------ | ------ |
| type_user_id | Código do tipo de usuário(1 - Administrador; 2 - Tripulante; 3 - Sala de Controle) |
| name | Nome do usuário|
| email | E-mail do usuário |
| password | Senha do usuário |


| MISSION |  |
| ------ | ------ |
| Buscar missão em aberto mais recente | http://127.0.0.1:8000/api/mission/findMostRecent |
| Finalizar missão | http://127.0.0.1:8000/api/mission/finish |
| Listar todas as missões | http://127.0.0.1:8000/api/mission/all |
| Salvar | http://127.0.0.1:8000/api/mission/store |
| Buscar por uma missão em específico | http://127.0.0.1:8000/api/mission/show/{1} |

### Exemplo para salvar uma missão:
```sh
{
  "name": "Primeira Missão Tripulada",
  "user_id": 1
}
```
| Legenda | salvando uma missão |
| ------ | ------ |
| name | Nome da missão |
| user_id | código do usuário que salvou a missão (Pode ser consulado no endpoint `USER - Listar todos`) |

### Exemplo para finalizar uma missão:
```sh
{
  "id": 1,
  "user_id": 1
}
```
| Legenda | Finalizando uma missão |
| ------ | ------ |
| id | ID da missão(Pode ser consultado no endpoint `MISSION - Buscar missão em aberto mais recente`) |
| user_id | código do usuário que finalizou a missão(Pode ser consulado no endpoint `USER - Listar todos`) |

| AUTHENTICATE |  |
| ------ | ------ |
| Autentica o Token |http://127.0.0.1:8000/api/authtoken |
| Login | http://127.0.0.1:8000/api/authenticate/login |

### Exemplo para fazer login:
```sh
{
  "email": "silva@gmail.com",
  "password":"123"
}
```

| Legenda | login do usuário |
| ------ | ------ |
| email | E-mail do usuário |
| password | Senha do usuário |

| USER TYPE |  |
| ------ | ------ |
| Listar os tipos de usuários | http://127.0.0.1:8000/api/type-user/all |

## Executando os endpoints pelo Insomnia
Para facilitar os testes, disponibilizei na raíz do projeto o arquivo `InsomniaPulses.json` que pode ser importado e executado pelo `Insomnia`.

## Observações:
- Somente `usuários` do tipo `Administrador` podem:
-- Executar dos comandos `Iniciar Lançamento` e `Encerrar Missão`;
-- Cadastrar nova `missão`;
-- Cadastrar novo `usuário`.
- Só poderá ser cadastrada nova `missão` após a anterior ser encerrada.

| Tipos de usuários | **É administrador?(SIM / NÃO)** |
| ------ | ------ |
| Administrador | SIM |
| Tripulante | NÃO |
| Sala de Controle | SIM |

