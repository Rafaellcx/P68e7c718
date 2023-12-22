## PULSES

Project was created to test Pulses knowledge.  

## Solução

Created using the Laravel 8 framework, VueJS 2, MySQL database and Docker for application containerization. The code was written in English to maintain a better development standard and the return messages are purposely in Portuguese.

Obs: The `.env` file was sent with the project (**even though it is not a good practice**) with the aim of facilitating the execution of the project by ensuring that the evaluator does not have to make such configurations on it.
## How to execute the project

After downloading the **P68e7c718** repository, being in its main folder "**P68e7c718**", upload the structure made up of the following containers:

- **pulses_back:** Composed with Apache and PHP, with port `8000` being exposed;
- **pulses_front**: Using Nginx with the front-end application (VueJS), exposing port `8001`;
- **pulses_banco:** With the MySql database.

Through the following command:
```sh 
docker-compose up --build
```

After completing the creation of the containers, we must execute the commands below so that the environment is ready to be used:

> 1. Used to populate the database with the necessary solution tables:
   ```sh 
   docker exec -ti pulses_back php artisan migrate
   ```
> 2. Used to create user types:
```sh 
docker exec -it  pulses_back php artisan db:seed --class=TypeUserSeeder
```
> 3. Used to create an administrator type user:
```sh 
docker exec -it  pulses_back php artisan db:seed --class=UserSeeder
```
Now we can use the application using the address "http://localhost:8001".
To log in, we must use the E-mail: `admin@gmail.com` and the Password: `123456`

If you want to run the application later, check that the `pulses_back`, `pulses_front` and `pulses_banco` containers are active by running the following command:

```sh
docker container ls -a
```
If you want to start the `pulses_back`, `pulses_front` and `pulses_banco` containers, run the following command:
```sh
docker container start pulses_back pulses_front pulses_banco
```
If you want to stop the `pulses_back`, `pulses_front` and `pulses_banco` containers, run the following command:
```sh
docker container stop pulses_back pulses_front pulses_banco
```
## Endpoints for testing
##### Reminder: Since almost all wheels require authentication, don't forget to configure your endpoint's `Header` with key: `Authorization` and value: `bearer` `token value`

| USER | |
| ------ | ------ |
| List all | http://127.0.0.1:8000/api/user/all |
| Search for a specific user | http://127.0.0.1:8000/api/user/show/{id} |
| Save | http://127.0.0.1:8000/api/user/store |

## JSON structure for the following endpoints

### Example to save a user:
```sh
{
  "type_user_id": 1,
  "name": "admin",
  "email": "admin@gmail.com",
  "password": "123456"
}
```
| Caption | saving a user |
| ------ | ------ |
| type_user_id | User type code (1 - Administrator; 2 - Crew member; 3 - Control Room) |
| name | Username|
| email | User email |
| password | User password |


| MISSION | |
| ------ | ------ |
| Search latest open quest | http://127.0.0.1:8000/api/mission/findMostRecent |
| Finish mission | http://127.0.0.1:8000/api/mission/finish |
| List all missions | http://127.0.0.1:8000/api/mission/all |
| Save | http://127.0.0.1:8000/api/mission/store |
| Search for a specific mission | http://127.0.0.1:8000/api/mission/show/{1} |

### Example for saving a mission:
```sh
{
  "name": "Primeira Missão Tripulada",
  "user_id": 1
}
```
| Caption | saving a mission |
| ------ | ------ |
| name | Mission name |
| user_id | user code that saved the mission (Can be consulated in the `USER - List all` endpoint) |

### Example to finish a mission:
```sh
{
  "id": 1,
  "user_id": 1
}
```
| Caption | Finishing a mission |
| ------ | ------ |
| id | Mission ID (Can be consulted in the `MISSION - Search for the most recent open mission` endpoint) |
| user_id | user code that completed the mission (Can be consulated in the `USER - List all` endpoint) |

| AUTHENTICATE | |
| ------ | ------ |
| Authenticate the Token |http://127.0.0.1:8000/api/authtoken |
| Login | http://127.0.0.1:8000/api/authenticate/login |

### Example for logging in:
```sh
{
  "email": "silva@gmail.com",
  "password":"123"
}
```

| Caption | user login |
| ------ | ------ |
| email | User email |
| password | User password |

| USER TYPE | |
| ------ | ------ |
| List user types | http://127.0.0.1:8000/api/type-user/all |

## Running the endpoints through Insomnia
To facilitate testing, I made the file `InsomniaPulses.json` available at the root of the project, which can be imported and executed by `Insomnia`.

## Comments:
- Only `users` of type `Administrator` can:
-- Execute the `Start Launch` and `End Mission` commands;
-- Register new `mission`;
-- Register new `user`.
- A new `mission` can only be registered after the previous one is closed.
  
| User types | **Are you an administrator? (YES / NO)** |
| ------ | ------ |
| Administrator | YES |
| Crew | NO |
| Control Room | YES |

