#copy over any environment variables that are set by heroku
for var in `env|cut -f1 -d=`; do
  echo "PassEnv $var" >> /app/apache/conf/httpd.conf;
done
echo "Include /app/www/conf/httpd/*.conf" >> /app/apache/conf/httpd.conf


echo "Launching apache"
exec /app/apache/bin/httpd -DNO_DETACH
exec chmod -R 775 /app/www/web