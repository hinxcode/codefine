FROM reinblau/lamp

MAINTAINER hinx

RUN apt-get update -y
RUN apt-get install git -y
#RUN apt-get install software-properties-common -y
#RUN add-apt-repository ppa:openjdk-r/ppa
#RUN apt-get update -y
#RUN apt-get upgrade -y
#RUN apt-get install -y openjdk-8-jre-headless

# RUN rm -fr /var/www/html
# COPY . /var/www/html

RUN rm -fr /var/www/html
RUN git clone https://github.com/hinxcode/codefine.git /var/www/html

EXPOSE 80