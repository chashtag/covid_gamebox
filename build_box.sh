#!/bin/bash
wget https://images.offensive-security.com/virtual-images/kali-linux-2020.1-vmware-i386.7z
7z x kali-linux-2020.1-vmware-i386.7z
qemu-img convert  Kali-Linux-2020.1-vmware-i386/Kali-Linux-2020.1-vmware-i386.vmdk -O qcow2 ./kali.qcow2
virt-sysprep -a kali.qcow2
virt-sparsify --inplace kali.qcow2
ROOT_PASS=`head -n 20 /dev/urandom  | sha1sum | cut -f 1 -d ' '`
echo root password will be: $ROOT_PASS
virt-customize --smp 4 -a kali.qcow2 \
--hostname covid \
--install nginx,qemu-guest-agent,php7.3-common,php7.3-cli,php7.3-fpm,nipper-ng \
--root-password password:$ROOT_PASS \
--run-command 'systemctl disable apache2' \
--run-command 'systemctl enable ssh' \
--run-command 'systemctl enable nginx' \
--run-command 'systemctl enable php7.3-fpm' \
--run-command 'rm /etc/nginx/sites-enabled/default' \
--run-command 'rm -rf /var/www/html ' \
--copy-in html/:/var/www/ \
--run-command 'chown -R www-data /var/www/html' \
--run-command 'systemctl set-default multi-user.target' \
--run-command 'echo "www-data ALL=(root) NOPASSWD:/usr/bin/nipper" >> /etc/sudoers' \
--copy-in covid_web_conf/nginx.conf:/etc/nginx/ \
--copy-in covid_web_conf/covid:/etc/nginx/sites-enabled/ \
--copy-in covid_web_conf/php.ini:/etc/php/7.3/fpm/ \
--copy-in covid_web_conf/issue:/etc/ \
--run-command 'userdel -rf kali || true' \
--run-command 'echo "PermitRootLogin yes" >> /etc/ssh/sshd_config' \
--run-command 'echo -e "www-data soft nofile 100000\nwww-data hard nofile 120000\nwww-data soft nproc 100000\nwww-data hard nproc 120000" >> /etc/security/limits.conf'