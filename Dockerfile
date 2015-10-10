FROM docker pull maxexcloo/nginx-php

COPY . /app
WORKDIR /app
EXPOSE 80

CMD [ "php", "./index.php" ]