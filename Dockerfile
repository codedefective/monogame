FROM --platform=linux/x86_64 centos:7

LABEL maintainer="Erdem AKBULUT"
LABEL "description"="Centos 7, Php 7.4, Composer, Git, Phalcon 4.1.2, Nginx, Python 3, Supervisord, ImageMagick, Nodejs (with bower yarn and gulp-cli)"
LABEL version="1.0"


RUN yum -y install --nogpgcheck epel-release yum-utils
RUN rpm -qa | grep -q remi-release || rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN sed -i "s|enabled=1|enabled=0|" /etc/yum/pluginconf.d/fastestmirror.conf
RUN yum-config-manager --enable remi-php74

RUN yum --enablerepo=remi-php74,remi install -y  \
    --nogpgcheck          \
        \
        gcc               git       git-core            make \
        libev-devel       zlib      zlib-devel          openssl           openssl-devel \
        \
        wget          vim             nano              htop              gzip        zip         unzip     \
        nc            openssh         openssh-clients   openssh-server    bind-utils  netstat     telnet    \
        rsyslog       tcpdump         cronie            jpegoptim         pngquant    ntp         ntpdate   \
        net-tools     python36-pip    jq                gdb               memcached                         \
        \
        supervisor      redis       nginx               mysql\
        \
        php           php-fpm \
        php-mysqlnd   php-devel   php-pear    php-grpc    \
        php-gd        php-xml     php-gmp \
        php-json      php-soap    php-mcrypt    php-bcmath      php-mbstring\
        php-intl      php-pgsql   php-opcache \
        \
        php-pecl-psr        php-phalcon4-4.1.2-1.el7.remi.7.4     php-pecl-redis      \
        php-pecl-imagick    php-pecl-imagick-devel php-pecl-zip   php-pecl-xdebug \
        php-pecl-memcached  php-pecl-apcu


RUN rm -rf /etc/nginx/conf.d/default.conf &&     \
    rm -rf /etc/nginx/conf.d/ssl.conf &&     \
    rm -rf /etc/nginx/conf.d/virtual.conf &&     \
    rm -rf /etc/nginx/nginx.conf

RUN yum install --enablerepo=epel -y ImageMagick ImageMagick-devel

RUN curl -sL https://rpm.nodesource.com/setup_12.x | bash -

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer require friendsofphp/php-cs-fixer &&     \
    ln -s /vendor/bin/php-cs-fixer /usr/local/bin/php-cs-fixer &&     \
    mkdir /run/php-fpm &&     export LC_ALL=en_US.UTF-8

RUN yum install -y nodejs

RUN npm install -g bower yarn gulp-cli

RUN pip3.6 install --upgrade pip &&     pip install --upgrade setuptools &&     \
    pip install --upgrade awsebcli &&     echo "curl update" &&     \
    export CFLAGS='-march=native' &&     \
    export CPPFLAGS='-march=native' &&     \
    export CXXFLAGS='-march=native'

RUN yum -y --nogpgcheck update &&  TMPDIR=/tmp yum clean metadata &&     TMPDIR=/tmp yum clean all

