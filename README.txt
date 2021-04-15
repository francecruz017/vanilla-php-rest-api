Hi,

Been a while to code in PHP w/o not using any packages and frameworks ! :D

SETTING UP:

install XAMPP.
Put project on HTDOCS dir.
Name it apiSample [you can change this by the way, you just have to follow the instructions below].
RUN XAMPP.
RUN APACHE and MYSQL
IMPORT SQL [located at ./sql_dump/api_sample.sql]

NOTE:

FOR PASSING PAYLOADS or FORM DATA use x-www-form-urlencoded

IF you''ve changed the project's folder name.
For the project to work you have to change the value of $projectBase under config/router.php
example :
	$projectBase = "/my-new-proj/";

IF you have changed the project's DB name change the value of $db_name under config/Database.php
example:
	$db_name = "new_db";

I know i should've made an env or config where i store all those vars but I can only do these before going in to my current work so I had to rush. Terribly sorry on that part :D


Next, if you want to add a route... go to ./index.php.
See array $routes.
Add in your route there and its specifications. [it was made to cater 1 parameter at the moment was building a simple router WITHOUT the use of any packages :D it could cater the requirements somehow :D and i came up with that idea might need to improve it in the future tho ;) ]


Allow Origins are also under ./index.php
I have set it to "*" by default.

My tests are under test_capture.

For question or suggestions you can email me at adan.france.cruz@gmail.com

Kind Regards,
Adan France E. Cruz