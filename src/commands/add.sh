
# src/commands/html.sh

function page_add_help {
  
  cat <<HELP
  
  Create a new html file based on the default or optionally specified template.
  
  Usage:

    page add <name> [options]

  Options:

    -t    Specify name of template to use.
    -h    Display this message and exit.

HELP

template_list page
}


#=============================================================================
#
# html Command.
#
# Format: page html <name> -t <template>
#
function page_cmd_add {
  
  page_options "$@"
  
  if [[ ${POPTHELP} ]]; then
    page_add_help
    exit 0; 
  fi
    
  local fname=$1; shift  # Name of the new file
  local tmpl='index'    # Default template
  if [[ ${POPTTMPL} ]]; then 
    if [[ ! ${TMPLFUNC[page.${POPTTMPL}]} ]]; then
      echo "ERROR: Unkown template: ${POPTTMPL}"
      exit 0;
    fi
    tmpl=${POPTTMPL}
  fi
  unset TMPLDATA; declare -A TMPLDATA=( [title]=$fname )  # unset to prevent old data.
  ${TMPLFUNC[page.${tmpl}]} "pub/$fname.php" # Execute approprate new command.
  mkdir part/$fname # Create pages partial directory.
  generate part.hello part/${fname}/hello.php
}

