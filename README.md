# Virtual Bank
This project is a simple bank simulator. It allows you to transfer funds between two accounts, as well as withdraw and deposit money.

To start the bank, run the following command in the console.
```
php index.php
```

### Output
```
John's balance: 500
Smith's balance: 200
-----------------------------------------
Transferring 200 from John to Smith...
John's balance: 300
Smith's balance: 400
-----------------------------------------
Smith withdraws 400...
Smith's balance after withdrawal: 0
-----------------------------------------
John deposits 500...
John's balance after deposit: 800
-----------------------------------------
```

### Running Tests
```
composer test
```