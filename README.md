**A SIMPLE MAILING LIST**

**To run application**
1. Upload code to any LAMP server
3. Create database in mysql - testDB and table email_list, with columns id(int,pk) and email(varchar)
4. run script manage_list.php

**Project Requirements -** 
1. User can subscribe to mailing list
2. User can unsubscribe to mailing list
3. Owner can send mails to all subscribers in mailing list - can only open
if admin code is entered - here - admin_portal

**Procedure - **
1. Create database. 
In this case, only one table needed to store email
address of subscribers.
Database used here - testDB, Table used here - email_list
2. Create include script
3. Create Script for adding removing entry to
the email table.
4. Create a script to view all emails and send 
bulk email using php mail.

**Flow Charts -**
**FlowChart 1** 
1. form unsubmitted -> form displayed ->
enter email -> choose? a. subscribe or b. unsubscribe
Path a - subscribe 
2. User email checked if present in database -> already present?
path yes - o/p email already present -> return to form
path no - add email to database SQL Query -> if successful
o/p email added. -> return to form unsubmitted(refresh)
Path b - unsubscribe 
2. User email checked if present in database? present?
path yes - fetch id of entry in table -> delete record 
where id = fetch.id -> o/p successfully unsubscribed
path no - output no such email found. -> return to form
page

**Flow Chart2** - admin opens mailing form -> collect subject and content
from admin -> select all emails from table -> send email 
using phpmail()
1.Enter admin password, in this case 'admin_portal' at the home_page of 
application to access the bulk email page. Is password correct? 
Path TRUE:
2. Enter subject and message. CHECK if both !empty?
	PATH TRUE:
		3. fetch all emails from table, send email, one by one
	PATH FALSE:
		3. return to admin_panel page, no emails sent.
PATH FALSE:
3. Redirect to homepage of application.




**Thus scripts -**
1. include.php - includes functions. Which functions are 
repeatedly used? add them here to reuse them
	a. connect_to_db - to establish sql connection
	b. check_email_present($email) - to check if email present
in table returns - 0,id of email present
2. manage_list.php  - script for panel for users
3. admin_panel.php - script for panel for admin of mailing list


