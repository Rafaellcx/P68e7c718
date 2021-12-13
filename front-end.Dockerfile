# Buildando o front-end
FROM node:alpine3.10 as build-stage
WORKDIR /app

# Copiando arquivos de dependências para diretório de trabalho
COPY ./front-end/package*.json /app/

# Instalando os módulos
RUN npm install

# Copiando conteúdo do Front-end para a pasta /app/
COPY ./front-end/ /app/

# "Construíndo o projeto copiado
RUN npm run build

# nginx
FROM nginx:1.15

# Copiando o Build do front para o nginx
COPY --from=build-stage /app/dist/ /usr/share/nginx/html

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]