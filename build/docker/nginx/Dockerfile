FROM nginx:alpine as prod

WORKDIR /var/www/

COPY . /etc/nginx/conf.d/

CMD ["nginx", "-g", "daemon off;"]
