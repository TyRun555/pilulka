FROM nginx:1.17.8

ARG USER_ID
ARG GROUP_ID

RUN groupadd -g "$GROUP_ID" pilulka_testapp
RUN useradd -l -u "${USER_ID}" -g pilulka_testapp pilulka_testapp
RUN install -d -m 0755 -o pilulka_testapp -g pilulka_testapp /home/pilulka_testapp

WORKDIR /var/www
