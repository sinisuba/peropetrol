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
