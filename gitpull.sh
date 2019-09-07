if [ ! -d "/home/wwwroot" ]; then
    mkdir /home/wwwroot;
fi;
if [ ! -d "/home/wwwbackup" ]; then
    mkdir /home/wwwbackup;
fi;
zip -r /home/wwwbackup/ltrebbs.zip /home/wwwroot/ltrebbs/*


if [ ! -d "/home/wwwsrc" ]; then
    mkdir /home/wwwsrc;
fi;

if [ ! -d "/home/wwwsrc/ltrebbs" ]; then
    cd /home/wwwsrc;
    git clone https://github.com/Ltre/ltrebbs.git;
else
    cd /home/wwwsrc/ltrebbs;
    git pull;
fi

if [ ! -d "/home/wwwroot/ltrebbs" ]; then
    mkdir /home/wwwroot/ltrebbs;
fi

if [ ! -d "/home/wwwroot/ltrebbs/protected" ]; then
    mkdir /home/wwwroot/ltrebbs/protected;
fi

if [ ! -d "/home/wwwroot/ltrebbs/protected/data" ]; then
    mkdir /home/wwwroot/ltrebbs/protected/data;
fi

mv /home/wwwroot/ltrebbs /home/wwwroot/ltrebbs.trash;
cp /home/wwwsrc/ltrebbs -r /home/wwwroot/ltrebbs;
rm /home/wwwroot/ltrebbs/.git -rf
rm /home/wwwroot/ltrebbs/protected/data -rf
cp -r /home/wwwroot/ltrebbs.trash/protected/data /home/wwwroot/ltrebbs/protected/
chmod -R 767 /home/wwwroot/ltrebbs/protected/data;
chmod +x /home/wwwroot/ltrebbs/gitpull.sh;
rm -f -r /home/wwwroot/ltrebbs.trash;

cd /home/wwwroot

service nginx restart
service php-fpm reload