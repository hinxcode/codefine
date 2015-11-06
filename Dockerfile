FROM tutum/lamp:latest
FROM java:7

RUN rm -fr /app && git clone https://github.com/hinxcode/codefine.git /app
EXPOSE 80 3306
CMD ["/run.sh"]