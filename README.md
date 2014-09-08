#page 

---

`page` is a small bash application for generating HTML pages/partials within a simple project structure that facilitates servering the pages using the builtin PHP web server.  It's primary purpose is generating a quick support infastructure for experiments.

## Features
- Project/Page/Partial Templates
- Create pages
- Create partials
- Create php classes and testcases
- Built-in web server
- PHP templating
- Twitter Boostrap (+jQuery) support
- PHPUnit support for php code.
- PHP class autoload support
- Composer support for PHP

## Installation

1. Clone the project somewhere convenient (i.e. ~/bin/src).
2. Run `make` to ensure the  `bin/page` shell script is up-to-date.
3. Add the shell script (bin/page) to your path if you like.

**Note:** `make install` will copy the shell script to `~/bin/page`. 

##Dependencies
`page` is developed and used on OSX (10.8) with the folloing dependencies:

- PHP5.4+ (builtin web server).
- Bash 4.2 
- GNU Make 3.81

Your mileage may vary with other environments/versions.


##Basic Usage <small>( page -h )</small>

     Create html page from template.

     Usage:

       page [command] [command parameters] [options]

     Commands:

       new <name>   - Create new project (use -t option to select type)
       add <name>   - Create an page (use -t option to select template)
       part <name>  - Create an html partial (use -t option to select template)
       class <name> - Create a php class (and test class).
       model <name> - Create a php DAO object.
       server       - Start web server (use -r option to enable router.php usage.)  
       test         - Run php unit tests.

     Options:

       -t    Specify name of template/type to use.
       -h    Display this message and exit.
       -r    Causes router.php to be used with server command.
 
## Generated Project Structure
`page new example` generates:

    example/
    ├── composer.json
    ├── part
    │   └── hello.php
    ├── pub
    │   ├── css
    │   │   └── example.css
    │   ├── favicon.ico
    │   ├── img
    │   ├── index.php
    │   ├── js
    │   │   └── example.js
    │   └── lib
    │       ├── backbone.js
    │       ├── bootstrap.css
    │       ├── jquery.js
    │       └── underscore.js
    ├── router.php
    ├── src
    │   ├── autoload.php
    │   └── pagelib.php
    └── test

## CSS/JS Library Support

The following libaries are downloaded from the standard CDN by default (using curl):

- jquery.js
- underscore.js
- backbone.js
- bootstrap.css

### License

  [MIT](LICENSE)

