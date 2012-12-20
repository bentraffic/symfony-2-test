<?php

$commands = array(
  'Installing vendors' => '/usr/bin/php bin/vendors install',
  'Cleaning app/cache dir' => 'rm app/cache/* -rf',
  'Cleaning app/log dir' => 'rm app/log/* -rf',
  'Setting acl permissions on files in app/cache & app/log'
    => 'setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs',
  'Setting acl permissions on dirs app/cache & app/log'
    => 'setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs',
);

foreach ($commands as $action => $command)
{
  print("$action... ");flush();
  passthru($command);
  print("done\n");flush();
}

$dirs = array(

);

// create any missing dirs
foreach ($dirs as $dir)
{
  if (!file_exists($dir))
  {
    print("Creating $dir... ");flush();
    mkdir($dir);
    print("done\n");
  }
  else
  {
    print("Dir exists: $dir\n");
  }
}
