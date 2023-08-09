Lista de Compras App

Este é um projeto simples de Lista de Compras construído com Vue.js no frontend e Laravel no backend. Ele permite que você crie listas de compras e adicione itens a essas listas.

Requisitos

Certifique-se de ter o Docker e o Docker Compose instalados em sua máquina.

    Docker: https://docs.docker.com/get-docker/
    Docker Compose: https://docs.docker.com/compose/install/

Como Executar

    Clone este repositório:


git clone https://github.com/morty-maligno/teste.git
cd lista-de-compras-app

    Crie um arquivo .env baseado no arquivo .env.example tanto para o backend quanto para o frontend:


cd backend
cp .env.example .env

cd ../frontend
cp .env.example .env

    No diretório backend, crie as imagens Docker e inicie o serviço Laravel e o banco de dados:



docker-compose up -d

    Acesse o container do backend e execute as migrações e as seeds:


docker-compose exec -it web bash
php artisan migrate
php artisan db:seed
exit

    No diretório frontend, inicie o serviço Vue.js:


docker-compose up -d

    Abra o navegador e acesse a URL http://localhost:8000 para ver a aplicação em funcionamento.

Parando e Removendo os Containers

Para parar e remover os containers, execute:


docker-compose down

Isso encerrará todos os serviços e removerá os containers, mas manterá os dados do banco de dados. Se você deseja remover os dados do banco de dados também, adicione a opção -v:


docker-compose down -v
