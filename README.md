hackathon
=========


// setup the project...
> git clone https://github.com/arrobeusa/hackathon.git


// push assets; images, tech documents any old thing...
1) add files to the FILES directory
2) git push


Apache
<VirtualHost *:80>
  ServerName hack
  DocumentRoot "/Users/Rob/Sites/hackathon"
  DirectoryIndex index.php
  <Directory "/Users/Rob/Sites/hackathon">
    Options +Indexes FollowSymLinks +ExecCGI
    AllowOverride All
    Allow from All
  </Directory>
</VirtualHost>
