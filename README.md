# SeniorCapstoneProject
This is a progressive web app stack for keeping track of shared equipment and managing client use of said equipment
---
**Currently Working Features**:
- the ability to check equipment in and out on the faculty side page
- user validation on login
- student request equipment
- faculty approve student request
- Apache Configured on Server

**Features that should be added**
- faculty creating student user
- student account verification
- email notification (optional)
- ensure security 

**Notes regarding the webserver**
- GitHub command line feature is in use as you can no longer use the git command
- When updating the live server
    - first navigate to the DataBase folder and run: ``` sql < file_name.sql ``` to run SQL
    - second run ```gh repo clone bagert/SeniorCapstoneProject ~/home/github/``` 
    - this will probably take some working on as verification tends to be a problem with gh cli
    - then run ``` sudo systemctl restart``` to restart the server, and then it is up
- When trying to identify errors on the webserver
    ``` sudo nano /var/log/apache2/error.log``` 
    this will load the file of all error messages for apache2
- To get access to the existing server, please contact IT offices for the information.
