FROM node:20-alpine3.16

RUN apk --update --no-cache add \
    bash

WORKDIR /app

COPY . .
