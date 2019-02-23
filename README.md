# messenger-transaction-test

This is a test project to implement and test [this Symfony Messenger pull request](https://github.com/symfony/symfony/pull/28849).

## Setup

1. Install dependencies: `composer install`
2. Create the database (sqlite by default): `bin/console doctrine:database:create`
3. Migrate database: `bin/console doctrine:database:migrate`

## Test

Use the `app:add-book` command to run tests. The command requires an ID and Name for the book.

- For success: Use a unique ID: `bin/console app:add-book {uniqueId} {some name}
  - On success you _should_ see a `VarDump` of the `BookCreatedEvent` with the new book's ID.
- For failure: Reuse an ID: `bin/console app:add-book 1 foo && bin/console app:add-book 1 foo`
  - On failure, you _should not_ see the `VarDump` (which is located in the Event Subscriber)
  
The files for the Messenger transaction middleware are in `App\Lib\Messenger`.
