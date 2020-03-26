FROM centos:7

RUN yum -y install https://centos7.iuscommunity.org/ius-release.rpm

RUN yum -y install nginx git

RUN yum -y install php73 php73-mcrypt php73-pear php73-bcmath php73-gd php73-imap php73-pspell php73-tidy php73-devel \
    php73-mysqlnd php73-common php73-ldap php73-process php73-embedded php73-enchant php73-mbstring \
    php73-opcache php73-pecl-apcu-devel php73-fpm php73-xmlrpc php73-cli php73-odbc php73-xml mod_php73 \
    php73-soap php73-pecl-apcu-panel php73-gmp php73-pgsql php73-pecl-imagick php73-intl php73-pdo \
    php73-pecl-apcu php73-dbg php73-json php73-dba php73-recode php73-snmp php73-pecl-redis

RUN yum -y install libsemanage-python python27-python-setuptools python-pyudev libselinux-python python-pycurl \
    python27-runtime python2-pip python-iniparse python-firewall rh-java-common-python-javapackages \
    policycoreutils-python python-lxml python python-decorator python-perf python-slip-dbus python27-python-libs \
    python-backports python-IPy python-javapackages python27-python python-libs newt-python python-slip \
    python-urlgrabber rpm-python python-backports-ssl_match_hostname python-setuptools python-configobj \
    audit-libs-python python27-python-pip dbus-python

RUN yum install -y python-setuptools
RUN easy_install pip
RUN pip install supervisor
RUN mkdir /run/php-fpm

EXPOSE 80

CMD ["supervisord", "-n"]
