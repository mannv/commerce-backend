FROM node:lts-alpine

#The host is set to 0.0.0.0 to give full external access to the app container.
ENV HOST 0.0.0.0

ENV APP_ROOT /var/www

RUN apk add bash \
    && apk add nano

WORKDIR ${APP_ROOT}

EXPOSE 3000
