FROM php

COPY . /app
WORKDIR /app
CMD [ "php", "./index.php" ]