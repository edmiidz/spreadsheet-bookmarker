# Spreadsheet Bookmarker

Chrome extension for capturing webpages installing in Google spreadsheet

How to configure the plugin:

1. Go the uncompiled version of the plugin

2. Open background.js and edit the js variable "url" with the adress where you ahve the php files of the plugin. 

3. open manifest.json and replace shoppia.ro with the domain where you have the php files

4. After you made all the modifications you must pack the extension. In order to do this go to chrome/extensions enable the developer mode. click on pack extension and select the folder where you have the unbuild version of the extension and then click on pack. you will have then 2 files  1 *.crx and 1 *.prm. The crx is the file you need for installing the extension

5. Creat a database for the plugin in your mysql server.

6. Import the sql file from the mysql table folder

7. Open config file from the php files/inc folder

8. edit the $server, $username, $password, $database with you mysql credentials

9. edit the $siteUrl with you url where you have the php files

10. edit $adminUser and $adminPassword with your login password and username to the admin panel.

11. open ajax.php from the inc folder inside the php files folder. You have there 2 variable $user and $pass. Edit them with your user and password of the gmail you are creating the spreadsheets.

