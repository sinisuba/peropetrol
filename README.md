# peropetrol
 
The code used to build the sample database can be found in the `db_peropetrol.sql` file.

The file should be removed afterwards to make sure that users can't browse to, and potentionally view, sensitive information.

# Sample database - Login

The users provided in the sample database can be logged in by using the following credentials (`email:password`):

**Guests**: `firstname.lastname@domain.com:firstnamelastname`

**Employees**: `firstname.lastname@peropetrol.com:firstnamelastname`

**Administrator** credentials are as follows: `admin@peropetrol.com:peropetrol`

# Access levels

Guests have the following access:

- View gas information
- Manage their own credentials

Employees have the following access:

- View their own employment information
- View gas information
- Edit gas information*
- Add new gas*
- Manage their own credentials

\* = only available for the gas station where currently employed.

Administrators have the following access:

- View/Edit/Delete existing employees
- Add new employees
- View/Edit/Delete existing gas
- Add new gas

# Database Engine connection (XAMPP/WampServer)

WampServer supports both MariaDB and MySQL. 

If only one DB engine is enabled, there's no need to specify a port.

Otherwise, a port must be specified for the connection to be established.

If MySQL is the default DBMS, it uses port `3306` and therefore MariaDB will use port `3307`.

If MariaDB is the default DBMS, it uses port `3306` and therefore MySQL will use port `3308`.

Example connection for WampServer & MariaDB: `$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName, '3307');`

Since XAMPP only supports MariaDB there's no need to specify a port: `$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);`
