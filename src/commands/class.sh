
# src/commands/class.sh

function page_class_help {
  
  cat <<HELP
  
  Create a new php class based on the default or optionally specified template.
  
  Usage:

    page class <name> [options]

  Options:

    -t    Specify name of template to use.
    -h    Display this message and exit.

HELP

template_list class
}

#=============================================================================
#
# class command
#
# Format: page class <name> -t <template>
#
function page_cmd_class {
  
  page_options "$@"
  
  if [[ ${POPTHELP} ]]; then
    page_class_help
    exit 0; 
  fi
  
  local fname=$1; shift  # Name of the new file
  local tmpl='default'    # Default template
  if [[ ${POPTTMPL} ]]; then 
    if [[ ! ${TMPLFUNC[class.${POPTTMPL}]} ]]; then
      echo "ERROR: Unkown template: ${POPTTMPL}"
      exit 0;
    fi
    tmpl=${POPTTMPL}
  fi
  
  if [[ $fname == '' ]]; then
    echo "No class name specified!"
    exit 0;
  fi
  
  unset TMPLDATA; declare -A TMPLDATA=( [class_name]=${fname^[a-z]} )  # unset to prevent old data.
  ${TMPLFUNC[class.${tmpl}]} src/${fname}.php # Execute approprate new command.
  ${TMPLFUNC[test.${tmpl}]} test/${fname}.php # Execute approprate new command.

}
