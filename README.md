Desafio técnico 

## Descrição
O projeto foi feito com docker e docker-compose, para rodar o projeto é necessário ter o docker e docker-compose instalado na máquina.

Ele está focado em containers para desenvolvimento. Ou seja, o php roda com o artisan e o next.js roda com o npm dev, de forma que a aplicação fica no modo 
hot reload.

## Instalação
  
  ```docker-compose up --d``	

# Informações importantes para rodar o projeto

  ## Backend

  O backend foi feito com Laravel 9, e está rodando na porta 8000.

  É necessário renomear o arquivo .env.example para .env 

  O script deve ser capaz de rodar o comando composer install

  Após isso, é necessário rodar o comando php artisan key:generate utilizando o comando docker:

  ```docker-compose exec api php artisan key:generate```

  A API conta com documentação no swagger, que pode ser acessada em:
  
    ```http://localhost:8000/api/documentation```


  ## Frontend

  O frontend foi feito com Next.js, e está rodando na porta 3000.

  É necessário renomear o arquivo .env.example para .env.local

  O script deve ser capaz de rodar o comando npm install


  ## Banco de dados

  O banco de dados foi feito com MySQL, e está rodando na porta 3306.

  É necessário rodar o comando do artisan para criar as tabelas:

  ```docker-compose exec api php artisan migrate```


  ## Testes

  Para rodar os testes, é necessário rodar o comando:

  ```docker-compose exec api php artisan test```

  ```docker-compose exec app npm run test```



