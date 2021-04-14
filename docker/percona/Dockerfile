FROM percona/percona-server:latest

#ID юзера и группы текущего пользователя на хосте
ARG GROUP_ID
ARG USER_ID

#Заходим под рутом
USER root

#Ставим бэкапер от производителя бд
RUN yum install percona-xtrabackup-80 -y

#Магия с пользователями и группами. Делаем возможным запись от юзера контейнера в папку с бэкапом
RUN groupadd -g ${GROUP_ID} pilulka_testapp
RUN usermod -aG ${GROUP_ID} mysql
RUN mkdir /opt/mysql/backup -p
RUN mkdir /var/log/mysql -p
RUN chown ${USER_ID}:${GROUP_ID} /opt/mysql/backup/
RUN chmod 0775 /opt/mysql/backup/
RUN chmod 0775 /var/log/mysql

USER mysql