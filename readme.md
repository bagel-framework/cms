translations _
attributes camelCase
post names and db fields _

Continue working on: translator

Translator notes:

Always based on current language
Autodetect if a value matches a locale -> fillup like that
->translate(en)->title should be possible

creating a new site in 1 language fires an event which in return
will create the site in all the other languages or alternatively
should this already be handled in the translator trait with as fiew sql queries as possible.

This will be reuised for the values!

--> https://raw.githubusercontent.com/dimsav/laravel-translatable/master/Translatable/Translatable.php