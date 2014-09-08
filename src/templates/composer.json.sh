
# src/templates/composer.json.sh

TMPLNAME+=('composer')
TMPLDESC['composer']="Basic compolser.json file."
TMPLFUNC['composer']=templates_page_composer

function templates_page_composer {
  
  local dst=$1

  printf -- "    Creating ${dst}.\n"
    
  cat > ${dst}<<COMPOSER

{
    "name": "tbd",
    "description": "TBD",
    "require": {
    },
    "require-dev": {
    },
    "autoload": {
        "psr-4": { "": "src"}
    },
    "authors": [
        {
            "name": "me",
            "email": "me@foo.com"
        }
    ],
    "comments": {
      "Add dependency": "composer require vendor/package:ver",
      "Add dev dependency": "composer require vendor/silex:ver --dev",
      "Add latest silex": "composer require silex/silex:1.1.*"
    }
}

COMPOSER

}
