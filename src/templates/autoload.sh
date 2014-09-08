
# src/templates/autoload.sh

TMPLNAME+=('autoload')
TMPLDESC['autoload']="Basic autoload.php file."
TMPLFUNC['autoload']=templates_page_autoload

function templates_page_autoload {
  
  local dst=$1

  printf -- "    Creating ${dst}.\n"
    
  cat > ${dst}<<AUTOLOAD

<?php
function page_autoloader(\$class) {
    include  __DIR__ . '/' . \$class . '.php';
}
spl_autoload_register('page_autoloader');

AUTOLOAD

}
