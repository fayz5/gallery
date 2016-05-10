I have started this project with focus on only PHP and to cover the following aspects:

- OOP Programming in PHP
- PHP CRUD Operations
- Working with GET and POST requestes
- Working SESSIONs
- Working with FILES

Project structure:

Folders:
- includes			: contains reusable code such as classes, configuration files, functions
- public			: contains the website 
- public/admin		: admin user folder
- public/layouts	: currently only contain header and footer part of the web page
- public/images		: uploaded images are moved, kept and served from this folder
- public/scripts	: contains all the javascript files
- public/styles		: contains all the css files
- logs				: user activity logs are recorded and kept in this folder


Design Decisions & Project Issues:

(NOTE THIS PROJECT IS NOT COMPLETED YET AND CONTAINS VERY LITTLE DESIGN EFFORTS! :) )


For convenience purposes all the database related configurations are kept in one file which is located in 'includes/config.php'. From there one can change all the parameters required for connecting to and using the database.
Additionally, I have created several independent functions that simplifies certain tasks (i.e., logging, outputting success or error messages and etc) and stored the in 'includes/functions.php'.

Project uses object oriented approach, and creates several classes for working with database, query results, sessions and files.

Files containing classes and the description of their purposes:
- 'includes/database.php' file contains a class that simply a wrapper around mysqli and responsible for opening and closing connections to database, perform queries and etc.

- In this project every record in the database viewed as a database object or in other words instance of the DatabaseObject class ('includes/database_object.php'). User('includes/user.php') and Photograph('includes/photograph.php') classes extend DatabaseObject class and inherit its attributes and methods for performing CRUD operations.

- All the session related functionality is organized in the form of a Session class ('includes/session.php'). 

- 'includes/init.php' file is responsible for the initialization process which loads up all the classes, functions, configurations and instantiates required objects. 

This project assumes MySQL database (in our example "photo_gallery") with two tables (at current stage );
I have created those tables as follows:

CREATE TABLE users (
	id INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(30) NOT NULL,
	password VARCHAR(30) NOT NULL,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	PRIMARY KEY(id)
)


CREATE TABLE photos (
	id INT(11) NOT NULL AUTO_INCREMENT,
	filename VARCHAR(255) NOT NULL,
	type VARCHAR(100) NOT NULL,
	size INT(11) NOT NULL,
	caption varchar(255),
	PRIMARY KEY(id)
)

Length and type of some of the fields can be modified. Example: caption field can be text or id fields maybe unsigned.
Users table is used to contain admin priviliged users which are able to login and perform CRUD operations on photos table.






