#!/usr/bin/env bash

PTYPE='default'  # Default project type.
LIBROOT=$HOME/.page/lib

# 
# Templates
#
declare -a TMPLNAME
declare -A TMPLDESC
declare -A TMPLFUNC
declare -A TMPLDATA  # optional template data 

function page_print_templates {
  
  # TODO: Need to fix the length of the template ID and description fields!!
  
  #
  # List available templates.
  #
  printf -- "\nAvailable templates:\n"
  for i in "${!PAGETEMPLATES[@]}"
  do
    # echo "    key  : $i"
    # echo "    value: ${PAGETEMPLATES[$i]}"
    printf --  "    $i - ${PAGEDESC[$i]}\n"
  done
  printf -- "\n"
}

function page_usage {

    cat <<'USAGE'

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

USAGE
    
}
