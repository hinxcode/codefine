FROM php

COPY . /app
WORKDIR /app
EXPOSE 8080

CMD [ "php", "./index.php" ]