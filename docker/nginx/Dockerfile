# docker/nginx/Dockerfile

FROM nginx:alpine
WORKDIR /var/www

# Initialize
RUN apk update && apk upgrade

# Install Node
RUN apk add "nodejs>=14.17.1-r0" "npm>=7.17.0-r0" g++ make python2

CMD ["nginx"]
EXPOSE 80
