
# src/projects/new.default.sh

TMPLNAME+=('new.default')
TMPLDESC['new.default']="Default project template."
TMPLFUNC['new.default']=page_new_default

function page_new_default {
  
  #1. Project layout:
  local PAGE_PATH=$PNAME
  utils_project_common "$PAGE_PATH"
    
  #2. Generate files from templates
  unset TMPLDATA; declare -A TMPLDATA=( [part]='hello' )
  generate page.index pub/index.php
  generate part.hello part/hello.php
  generate autoload src/autoload.php
  generate composer composer.json
  touch pub/js/${PAGE_PATH}.js
  touch pub/css/${PAGE_PATH}.css
  
  #3. Support files.
  router_php router.php
  utils_php_lib src/pagelib.php
  
  #4. CSS/JS Libraries
  #lib_install
  resource jquery
  resource underscore
  resource favicon
  resource bootstrap
  
  #5. Project PHP files (if any).
  

  printf -- "\n...done\n\n"    
}






