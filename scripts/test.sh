git submodule init
git submodule update
cp examples/plurals/backend/example.settings.php examples/plurals/backend/settings.php
cp examples/plurals/frontend/example.settings.php examples/plurals/frontend/settings.php
phpunit ./
