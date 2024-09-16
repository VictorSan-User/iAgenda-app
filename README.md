Agenda Laravel

Desafio
Desenvolver uma agenda utilizando PHP, MySQL e o Framework Laravel. O objetivo do projeto é testar habilidades na linguagem orientada a objetos e no padrão MVC, aproveitando a elegância do Laravel para criar páginas simples e intuitivas.

Objetivo
O projeto visa implementar um sistema de agenda multiusuário que permite o cadastro e gerenciamento de tarefas. O sistema deve garantir que não haja tarefas agendadas para o mesmo dia e horário para um único usuário.

Descrição do Projeto
O projeto inclui as seguintes funcionalidades:

Tela de Login: Sistema de autenticação de usuários.
Cadastro de Usuário: Permite o registro de novos usuários.
Cadastro de Tarefas: Usuários podem adicionar tarefas, com a validação para evitar tarefas no mesmo dia e horário.
Interface: Utiliza o Bootstrap (ou outra biblioteca CSS) para uma interface amigável e responsiva.
Validação: Validação de entradas para evitar duplicidade de tarefas.
Multiusuário: Sistema deve permitir múltiplos usuários com autenticação e gerenciamento de tarefas específicos para cada um.

Tecnologias Utilizadas
PHP: Linguagem de programação para o backend.
MySQL: Banco de dados relacional para armazenamento de dados.
Laravel: Framework PHP para desenvolvimento web.
Bootstrap & TailWind: Bibliotecas CSS para estilização.

Requisitos
PHP 8.2 ou superior
MySQL
Composer
Laravel 11.x
Instalação

Clone o repositório:


git clone https://github.com/yourusername/agenda-laravel.git
Navegue até o diretório do projeto:


cd agenda-laravel
Instale as dependências do projeto:


composer install
Configure o arquivo .env:

Copie o arquivo .env.example para .env e ajuste as configurações do banco de dados e outras variáveis conforme necessário.


cp .env.example .env
Gere a chave de aplicação do Laravel:


php artisan key:generate
Execute as migrations para criar as tabelas no banco de dados:


php artisan migrate
Inicie o servidor local:


php artisan serve
Acesse o projeto em: http://localhost:8000

Uso
Registro de Usuário: Acesse a página de registro para criar uma nova conta.
Login: Acesse a página de login para autenticar-se no sistema.
Gerenciamento de Tarefas: Após o login, você pode adicionar, visualizar e gerenciar suas tarefas. As tarefas são agendadas e não podem se sobrepor.
Testes
Os testes são importantes para garantir o funcionamento do sistema. Execute os testes utilizando o PHPUnit:


php artisan test
Observação: Caso algum teste não esteja passando, verifique as mensagens de erro e ajuste conforme necessário.


Licença
Este projeto é licenciado sob a Licença MIT - consulte o arquivo LICENSE para mais detalhes.

Contato
Se você tiver alguma dúvida ou sugestão, entre em contato:

Victor Henrique: vihenriquesan@outlook.com
