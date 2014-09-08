
# src/projects/new.sink.sh

TMPLNAME+=('new.sink')
TMPLDESC['new.sink']="Kitchen-Sink project template."
TMPLFUNC['new.sink']=page_new_sink

function page_new_sink {
  
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
  resource jquery
  resource underscore
  resource favicon
  resource bootstrap
    
  #5. Project PHP files (if any).
  

  printf -- "\n...done\n\n"    
}






