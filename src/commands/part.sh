
# src/commands/part.sh

function page_part_help {
  
  cat <<HELP
  
  Create a new html partial file based on the default or optionally specified template.
  
  Usage:

    page part <name> [options]

  Options:

    -t    Specify name of template to use.
    -h    Display this message and exit.

HELP

template_list part
}

#=============================================================================
#
# part (partials) command
#
# Format: page part <name> -t <template>
#
function page_cmd_part {
  
  page_options "$@"
  
  if [[ ${POPTHELP} ]]; then
    page_part_help
    exit 0; 
  fi
  
  local fname=$1; shift  # Name of the new file
  local tmpl='hello'    # Default template
  if [[ ${POPTTMPL} ]]; then 
    if [[ ! ${TMPLFUNC[part.${POPTTMPL}]} ]]; then
      echo "ERROR: Unkown template: ${POPTTMPL}"
      exit 0;
    fi
    tmpl=${POPTTMPL}
  fi
  ${TMPLFUNC[part.${tmpl}]} part/${fname}.php # Execute approprate new command.

}
