
# src/commands/test.sh

function page_test_help {
  
  cat <<HELP
  
  Run unit tests
  
  Usage:

    page test 

  Options:

  -h    Display this message and exit.

HELP

# template_list test
}

#=============================================================================
#
# test command
#
# Format: page test
#
function page_cmd_test {
  
  page_options "$@"
  
  if [[ ${POPTHELP} ]]; then
    page_test_help
    exit 0; 
  fi
  
  phpunit --bootstrap src/autoload.php test/*.php
 
}
