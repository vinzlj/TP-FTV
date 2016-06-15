TP FTV
======

A Symfony project created on June 15, 2016, 10:04 am.

# Setup the project

1. Create the database:
`php bin/console doctrine:schema:create`
2. Load the fixtures:
`php bin/console doctrine:fixtures:load`
3. Install the assets:
`php bin/console assets:install web --symlink`
4. Run the server with `php bin/console server:run`

#### View available API routes:
`php bin/console debug:router | grep api`