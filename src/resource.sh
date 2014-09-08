
# page/src/resource.sh

# Definitions:
#   src - file path relative to ~/.page/resources/  (i.e. "jquery/jquery.js").
#   dst - file path relative to project root (i.e. "pub/js/jquery.js").
#   ResuourceID - string identifiying resource (i.e. "jquery").
#
declare -A RESDST # Key: src ; Value: project dst path for resource.
declare -A RESLST  # Key: ResourceID; Value: list of src's seperated by ':'.

# Default Resources
src='jquery/jquery.js'
RESLST['jquery']="$src"
RESDST["$src"]='pub/lib/jquery.js'

src='underscore.js'
RESLST['underscore']="$src"
RESDST["$src"]='pub/lib/underscore.js'

src='favicon.ico'
RESLST['favicon']="$src"
RESDST["$src"]='pub/favicon.ico'

src_css='bootstrap/css/bootstrap.css'
src_map='bootstrap/css/bootstrap.css.map'
RESLST['bootstrap']="${src_css}":"${src_map}"
RESDST["$src_map"]='pub/lib/bootstrap.css.map'
RESDST["$src_css"]='pub/lib/bootstrap.css'


#=============================================================================
#
# resource <id>
#
#   Install the resource specified by the ID (i.e. 'jquery').
#   Note: The src and dst directories are currently fixed.
#
#=============================================================================

function resource {
  local resID=$1
  if [[ ! ${RESLST[$resID]} ]]; then
   die "Bad resource ID: $resID"
  fi 
  local src=${RESLST[$resID]} 
  IFS=':' read -ra RES <<< "$src"
  for i in "${RES[@]}"; do
    if [[ ! ${RESDST[$i]} ]]; then
     die "Bad resource source [\'$i\']!"
    fi 
    local dst=${RESDST[$i]}
    local root=~/.page/resources
    if [[ $root/$i ]]; then
      cp $root/$i $dst
    fi
    
  done
  

}