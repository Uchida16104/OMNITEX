FROM php:8.3-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y git unzip curl

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
