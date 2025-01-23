# Api Symfony + VueJs 

### O repositorio contem dois projeto , uma api criada com symfony 7.2 , e um frontend criado com Vuejs 3



## Sumário
- [Frontend](#frontend)
   - [Requisitos](#requisitos-frontend)
   - [Passo a Passo](#passo-a-passo-frontend)
   - [Arquitetura](#decisões-arquiteturais-frontend)
- [Backend](#backend)
   - [Requisitos](#requisitos)
   - [Passo a Passo](#passo-a-passo)
      - [Rodando com Docker](#rodando-com-docker)
      - [Rodando Fora do Docker](#rodando-fora-do-docker)
   - [Comandos Úteis](#comandos-úteis)
   - [Solução de Problemas](#solução-de-problemas)
   - [Arquitetura](#decisões-arquiteturais)
   - [Collection Postman](./backend/api.postman_collection.json)

---

# Frontend

## Requisitos Frontend
Para rodar este projeto Vue.js, você precisa dos seguintes requisitos:

1. **Node.js**
   - Versão recomendada: 20 ou superior.

2. **npm** (geralmente instalado junto com o Node.js)
   - Alternativamente, você pode usar o `yarn` como gerenciador de pacotes.

3. **Git**
   - Para clonar o repositório.

4. **Navegador Web**
   - Para acessar a aplicação em desenvolvimento.

---

## Passo a Passo frontend

### 1. Clone o Repositório
Clone o repositório do projeto para a sua máquina local:
```bash
git clone <URL_DO_REPOSITORIO>
cd <PASTA_DO_REPOSITORIO>
```

### 2. Instale as Dependências
Certifique-se de que está na raiz do projeto e instale as dependências:
```bash
npm install
```

### 3. Configure o Ambiente
Renomeie o arquivo de exemplo `.env.example` para `.env` e edite conforme necessário:
```bash
cp .env.example .env
```
Adapte a a variavel `VITE_API_URL` para conter a url da api

```bash
VITE_API_URL=http://localhost:8080/api
```


### 4. Inicie o Servidor de Desenvolvimento
Inicie o servidor local para o projeto:
```bash
npm run dev
```

O servidor será iniciado, e você verá algo como:
```bash
  App running at:
  - Local:   http://localhost:5173/
  - Network: http://192.168.X.X:5173/
```
Abra o navegador e acesse o endereço exibido.

## Decisões Arquiteturais Frontend

### Estrutura de Pastas
A organização da estrutura de pastas segue as boas práticas de desenvolvimento, utilizando:

- **src/assets**: Para armazenar recursos estáticos como imagens, fontes e arquivos CSS globais. Centralizar esses arquivos facilita a manutenção e permite que sejam acessíveis por todo o projeto.

- **src/components**: Para componentes reutilizáveis. Essa separação promove modularidade e permite o reaproveitamento de código em diferentes partes da aplicação.

- **src/model**: Para definir as estruturas de dados ou classes de modelo que representam as entidades do sistema. Essa organização centraliza as definições das entidades, facilitando integrações com APIs e manutenções futuras.

- **src/router**: Para gerenciar as rotas do Vue Router. Centralizar as rotas em um único lugar torna a navegação da aplicação mais organizada e escalável.

- **src/services**: Para encapsular regras de negócio e integrações com APIs externas. Essa separação melhora o reaproveitamento de código e a manutenção.

- **src/stores**: Para gerenciar o estado global da aplicação usando o Pinia. Separar o estado global dos componentes facilita a organização e melhora o desempenho.

- **src/views**: Para armazenar as páginas da aplicação, geralmente vinculadas diretamente às rotas. Isso ajuda a manter uma separação clara entre os componentes reutilizáveis e as páginas completas.

---

Essa estrutura foi projetada para manter o projeto organizado e modular, facilitando a manutenção e o crescimento da aplicação.





## Backend

## Requisitos
Para rodar este projeto Symfony, você precisa dos seguintes requisitos:

1. **Docker** (opcional, caso queira rodar com Docker)
   - Certifique-se de que o Docker esteja instalado na máquina.
   - Recomendado: Docker Desktop (Windows/Mac) ou Docker CLI (Linux).

2. **Docker Compose** (opcional, caso queira rodar com Docker)
   - Geralmente incluído na instalação do Docker.

3. **PHP CLI** (opcional, caso queira rodas em sua propria maquina(fora do docker) )
   - Versão recomendada: PHP 8.2 ou superior.

4. **Composer** (opcional, caso queira rodas em sua propria maquina(fora do docker) )
   - Gerenciador de dependências do PHP.

5. **MySQL** (opcional, caso queira rodas em sua propria maquina(fora do docker) )
   - Instale o servidor MySQL localmente ou use um banco de dados remoto.

6. **Git**
   - Para clonar o repositório.

---

## Passo a Passo

### Rodando com Docker

Recomendo essa opção para nao ser nescessario criar fazer instalações das dependências na sua maquina

#### 1. Clone o Repositório
Clone o repositório do projeto para a sua máquina local:
```bash
git clone <URL_DO_REPOSITORIO>
cd <PASTA_DO_REPOSITORIO>
```

#### 2. Acesse a pasta backend
Clone o repositório do projeto para a sua máquina local:
```bash
cd backend
```

#### 3. Configure o Arquivo de Ambiente
Renomeie o arquivo de exemplo `.env.example` para `.env`:
```bash
cp .env.example .env
```

Edite o arquivo `.env` para garantir que a variável `DATABASE_URL` esteja configurada corretamente para o Docker:
```env
DATABASE_URL=mysql://symfony:symfony@mysql:3306/app-user?serverVersion=8.0.32&charset=utf8mb4
```

#### 4. Suba os Containers Docker
Inicie os serviços necessários com Docker Compose:
```bash
docker-compose up --build
```
Esse comando irá:
- Criar o container para o backend Symfony.
- Criar o container para o banco de dados MySQL.

#### 5. Instale as Dependências do Projeto
Entre no container do Symfony:
```bash
docker exec -it backend-symfony bash
```
Dentro do container, instale as dependências:
```bash
composer install
```

#### 6. Configure o Banco de Dados
Ainda dentro do container do Symfony, execute o seguinte comando para configurar o banco de dados:
```bash
php bin/console doctrine:database:create
```

#### 7. Executar migrations
rode o seguinte comando pra criar as tabelas no banco, execute:
```bash
php bin/console doctrine:migrations:migrate
```

Apos isso a api estara pronta para ser utilizada no seguinte endereço

```
http://localhost:8080
```

---

### Rodando Fora do Docker

#### 1. Clone o Repositório
Clone o repositório do projeto para a sua máquina local:
```bash
git clone <URL_DO_REPOSITORIO>
cd <PASTA_DO_REPOSITORIO>
```

#### 2. Configure o Ambiente Local
Renomeie o arquivo de exemplo `.env.example` para `.env`:
```bash
cp .env.example .env
```

Edite o arquivo `.env` para configurar a conexão com o banco de dados local:
```env
DATABASE_URL=mysql://<USUARIO>:<SENHA>@127.0.0.1:3306/<NOME_DO_BANCO>?serverVersion=8.0.32&charset=utf8mb4
```
Substitua `<USUARIO>`, `<SENHA>` e `<NOME_DO_BANCO>` pelos valores do seu ambiente MySQL.

#### 3. Instale o Composer
Certifique-se de que o Composer esteja instalado. Para instalar as dependências do projeto, execute:
```bash
composer install
```

#### 4. Configure o Banco de Dados
Crie o banco de dados localmente:
```bash
php bin/console doctrine:database:create
```
rode as migrations
```bash
php bin/console doctrine:migrations:migrate
```

#### 5. Instale o symfony cli
Inicie o servidor de desenvolvimento:
```bash
wget https://get.symfony.com/cli/installer -O - | bash
```

apos rodar esse comando se atente na saida do terminal pois haverá instrucoes pra rodar os comandos symfony

### 6. Verifique se seu ambiente tem todas as dependências necessários
```bash
symfony check:requirements  
```

#### 7. Inicie o servidor de desenvolvimento
```bash
symfony server:start  
```


#### 8. Acesse a Aplicação
apos executar o comando anterior a api ficara pronta para uso no seguinte endereço
```
http://127.0.0.1:8000
```

---

## Comandos Úteis

### Parar os Containers (se estiver usando Docker)
```bash
docker-compose down
```

### Reconstruir os Containers (se estiver usando Docker)
Se você alterar algo na configuração do Docker, reconstrua os containers:
```bash
docker-compose up --build
```

### Acessar o Container do Symfony (se estiver usando Docker)
```bash
docker exec -it backend-symfony bash
```

### Acessar o Container do MySQL (se estiver usando Docker)
```bash
docker exec -it mysql-symfony bash
```

### Ver Logs (se estiver usando Docker)
- Logs do Symfony:
  ```bash
  docker logs backend-symfony
  ```
- Logs do MySQL:
  ```bash
  docker logs mysql-symfony
  ```

---

## Solução de Problemas

1. **Erro de Permissão no Banco de Dados**:
   - Certifique-se de que o usuário, senha e nome do banco configurados em `.env` correspondem aos valores configurados no seu banco de dados.

2. **Portas em Uso**:
   - Se as portas `8000` ou `3306` já estiverem sendo usadas, altere-as nas configurações locais ou no `docker-compose.yml` (se estiver usando Docker).

3. **Dependências Faltando**:
   - Verifique se todas as dependências foram instaladas com `composer install`.

4. **Erro de Rede (Docker)**:
   - Certifique-se de que os containers estão na mesma rede do Docker (`network-app`).


## Decisões Arquiteturais

### Configuração de CORS no Symfony
Foi configurado o suporte a CORS para permitir que o frontend em outro domínio/porta consiga acessar os endpoints. Isso foi implementado no arquivo de configuração `config/packages/nelmio_cors.yaml`, onde definimos as regras para quais métodos, cabeçalhos e origens são permitidos.

### Estrutura de Pastas
A organização da estrutura de pastas segue as práticas recomendadas do Symfony, utilizando:
- **src/Controller**: Para gerenciar requisições e respostas
- **src/Entity**: Para definir as entidades do banco de dados.
- **src/Repository**: Para consultas personalizadas ao banco.
- **src/Service**: Para encapsular lógicas de negócios reutilizáveis. Essa separação melhora a testabilidade e a legibilidade do código.
- **src/DTO**: Camada que contem a representação dos objetos que seram transportados entre as camadas , e reponsavel pela validação dos dados das request