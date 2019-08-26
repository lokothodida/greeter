# Greeting
This repo houses a sample application designed to showcase
some of the architectural benefits of dependency injection.

## Challenge
Design a system that greets the user depending on the time
of day and selected locale. Said system needs to be robust
enough to be thoroughly testable in a CI environment and
allow the internal clock to be changed for demonstrations.

```php
/**
 * @param  string $username Username of a user existing in the system
 * @param  string $language A language recognised by the system
 * @return string Greeting that is personalized to the user and language-dependent
 */
greet(string $username, string $language): string
```

## Running the code
```
$ ./bin/greet -u [username] -l [language]
```
