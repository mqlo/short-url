FROM nginx:1.17-alpine

COPY ./development/nginx/conf.d /etc/nginx/conf.d

WORKDIR /app

RUN unset `env | grep proxy | cut -d= -f1`
