#!/bin/bash
cd ..

#rm -rf vendor
#rm -rf composer.lock
#composer install

adapter=`cat phinx.yml | grep "adapter" | head -n 1 | awk -F": " '{print $2}'`
host=`cat phinx.yml | grep "host" | head -n 1 | awk -F": " '{print $2}'`
name=`cat phinx.yml | grep "neme" | head -n 1 | awk -F": " '{print $2}'`
user=`cat phinx.yml | grep "user" | head -n 1 | awk -F": " '{print $2}'`
pass=`cat phinx.yml | grep "pass" | head -n 1 | awk -F": " '{print $2}'`
port=`cat phinx.yml | grep "port" | head -n 1 | awk -F": " '{print $2}'`

if [ "x$adapter" = "xpgsql" ];
then
    psql -h $host -p $port -U $user $name -t -c "select 'drop table \"' || tablename || '\" cascade;' from pg_tables where schemaname='public'" | psql -h $host -p $port -U $user $name
else
echo "SET FOREIGN_KEY_CHECKS = 0; 
SET @tables = NULL;
SELECT GROUP_CONCAT(table_schema, '.', table_name) INTO @tables
  FROM information_schema.tables 
  WHERE table_schema = '$name'; -- specify DB name here.

SET @tables = CONCAT('DROP TABLE ', @tables);
PREPARE stmt FROM @tables;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
SET FOREIGN_KEY_CHECKS = 1; " | mysql -h $host -p $port -u $user $name
fi


vendor/bin/phinx migrate
vendor/bin/phinx seed:run -v  -s UserSeeder -s BudgetSeeder -s IntendSeeder


