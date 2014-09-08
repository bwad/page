
# src/projects/new.list.sh

TMPLNAME+=('new.list')
TMPLDESC['new.list']="Simple list project template."
TMPLFUNC['new.list']=page_new_list

function page_new_list {
  
  #1. Project layout:
  local PAGE_PATH=$PNAME
  utils_project_common "$PAGE_PATH"
  
  #2. Generate files from templates
  unset TMPLDATA; declare -A TMPLDATA=( [part]='form' )
  generate page.index pub/index.php
  generate part.form part/form.php
  generate autoload src/autoload.php
  generate composer composer.json
  touch pub/js/${PAGE_PATH}.js
  touch pub/css/${PAGE_PATH}.css
  
  #3. Support files.
  utils_php_lib src/pagelib.php
  router_php router.php
  
  #4. CSS/JS Libraries
  resource jquery
  resource underscore
  resource favicon
  resource bootstrap
    
  #5. Project PHP files (if any).

  printf -- "\n...done\n\n"    
}
