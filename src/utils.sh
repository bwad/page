
# src/utils.sh

function page_options {
  # Process options
  #
  
  # We have to remove any leading non-option arguments in order
  # for getopts to work properly.
  while [[ $# -gt 0 &&  ! $1 =~ ^[[:blank:]]*\-+ ]]; do
    shift
  done
  
  while getopts "ht:r" opts; do
      case $opts in 
      	h)  POPTHELP=1 ;;
        t)  POPTTMPL=$OPTARG ;;
        r)  POPTROUTER=1 ;;
      esac
  done
  
  # printf -- "POPTHELP: ${POPTHELP}\n"
  # printf -- "POPTTMPL: ${POPTTMPL}\n"
  # printf -- "POPTROUTER: ${POPTROUTER}\n"

}

function page_utils_check_path {
  local cur_path="$(pwd)"
  if [[ ! -e $cur_path/.page ]]; then
    echo "ERROR: Must be in project top level directory to run command!"
    exit 0;
  fi
  PAGE_PROJECT_PATH=$cur_path
}

#=============================================================================
#
# Template handling
#
#=============================================================================

function template_list {
  local type=$1
  printf -- "  Available Templates:\n\n"
  for name in ${TMPLNAME[*]}; do
    if [[ ${name} =~ ^${type}. ]]; then
      printf -- "    %-10s - %-50s\n" "${name#${type}.}" "${TMPLDESC[$name]}"
    fi
  done
  printf -- "\n"
}

function generate {
  local tmpl_id=$1    # type.name format
  local dst=$2        # destination path
  ${TMPLFUNC[$tmpl_id]} $dst
}

#=============================================================================
#
# Project utilites
#
#=============================================================================

function utils_project_common {
  
  local PAGE_PATH=$1
    
  # Create project directory.

  printf -- "\nCreating project ${PAGE_PATH}...\n\n"
  mkdir ${PAGE_PATH}
  cd ${PAGE_PATH}
  PAGE_PROJECT_HOME="$(pwd)"

  # Create project sub-directories

  mkdir src
  mkdir test
  mkdir part
  mkdir -p pub/lib 
  mkdir -p pub/js
  mkdir -p pub/css
  mkdir -p pub/img
}

#=============================================================================
#
# Router generator
#
#=============================================================================

function router_php {
    
    ROUTER_PATH=$1; shift

    printf -- "    Creating $ROUTER_PATH.\n"
    
    cat > ${ROUTER_PATH}<<ROUTER
<?php
// router.php
if (preg_match('/\.(?:png|jpg|jpeg|gif)\$/', \$_SERVER["REQUEST_URI"]) || \$_SERVER["REQUEST_URI"] == '/') {
    return false;    // serve the requested resource as-is.
} else { 
    echo "<p>Welcome to PHP</p>";
}
?>
ROUTER

}

#=============================================================================
#
# PHP lib
#
#=============================================================================

function utils_php_lib {

    
    PHPLIB_PATH=$1; shift

    printf -- "    Creating $PHPLIB_PATH.\n"
    
    cat > ${PHPLIB_PATH}<<PHPLIB
<?php
function part(\$name) {
    include '../part/' . \$name . '.php';
}
PHPLIB

}


#=============================================================================
#
# die
#
#   Exit with error message.
#
#=============================================================================
function die {
  local msg=$1
  printf -- "ERROR: $msg\n"
  exit 1
}



