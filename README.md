# VRA-Central

The final version of this app will be hosted on GCP.  However, for testing and development purposes, we will use a local xampp database as well as a local xampp apache webserver.

## deploying on XAMPP

Instructions to deploy on xampp can be found here: https://www.cs.virginia.edu/~up3f/cs4640/supplement/basic-deployment.html#section1

For local development, navigate to your xampp/htdocs folder via the command line and type "git clone https://github.com/mattremigino1/vra-central" into the command line to place the folder in the correct spot.  From here, navigate into the folder using the comman "cd vra-central".  It is from this location you can create a new branch using "git branch --newbranchname" and develop code for whatever feature you wish.  

Once you have opened up the xampp app on your computer and started the apache webserver, you can view the app through your webbrowser at http://localhost/vra-central/index.php

## correctly connecting the DB

The connect-db.php folder contains the code to connect the webapp to a database.  Currently, it is configured through a local xampp database.  To ensure your data base works correctly you must ensure you local xampp database is set up in an identical way to how I have it configured.  To configure it correctly follow these steps:

1. Open up the apache app on your computer and start the MySQL and apache webserver features
2. go to your webbrowser and navigate to "localhost".  On the page that loads click on "phpMyAdmin" in the upper left part of the menubar
3. Once on the correct page, select "User Accounts" from the toolbar.  Create a new user with username "me" and password "1234"
4. Under "Database for user account" check both boxes and for "Global privileges" check the "checkall" box.  Finally click the button to create the user
5. create a database called "central"
6. Click on "import" and import the "createtables.sql" file from milestone 2.  (NOTE: download a new version of this from github since I have changed it)
7. everything should be up and running if you followed these steps correctly
