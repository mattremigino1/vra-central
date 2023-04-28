# VRA-Central
We will use the CS server database as well as a local xampp apache webserver.

## deploying on XAMPP

Instructions to deploy on xampp can be found here: https://www.cs.virginia.edu/~up3f/cs4640/supplement/basic-deployment.html#section1

For local development, navigate to your xampp/htdocs folder via the command line and type "git clone https://github.com/mattremigino1/vra-central" into the command line to place the folder in the correct spot.  From here, navigate into the folder using the command "cd vra-central".  It is from this location you can create a new branch using "git branch --newbranchname" and develop code for whatever feature you wish.  

Once you have opened up the xampp app on your computer and started the apache webserver, you can view the app through your webbrowser at http://localhost/vra-central/index.php

## correctly connecting the CS server database

The connect-db.php folder contains the code to connect the webapp to a database.  Currently, it is configured through the CS server database.  There is nothing that should need to be done to connect to the database... it should connect automatically.  However, if you wish to change the database (example: add a table or something) navigate to http://mysql01.cs.virginia.edu/phpmyadmin/ and login with the username "mr3ea" and the password ")4/egLRTZAYEj)pC".

Note: the database we are using is called "mr3ea"
