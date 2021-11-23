FROM node:12.22-alpine

RUN apk add yarn

# Set up work directory
WORKDIR /var/www/html

COPY package.json ./
COPY .env ./
COPY tsconfig.json ./
RUN yarn

# Configure host
EXPOSE 3000

CMD yarn dev
