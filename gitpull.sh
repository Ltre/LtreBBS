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

mv /home/wwwroot/ltrebbs /home/wwwroot/ltrebbs.trash;
cp /home/wwwsrc/ltrebbs -r /home/wwwroot/ltrebbs;
rm /home/wwwroot/ltrebbs/.git -rf
rm /home/wwwroot/ltrebbs/core/data -rf
cp -r /home/wwwroot/ltrebbs.trash/core/data /home/wwwroot/ltrebbs/core/
chmod -R 767 /home/wwwroot/ltrebbs/core/data;
chmod +x /home/wwwroot/ltrebbs/core/setting/gitpull.sh;
rm -f -r /home/wwwroot/ltrebbs.trash;

cd /home/wwwroot/ltrebbs

service nginx restart
service php-fpm reload
