
# src/commands/new.sh

function page_new_help {
  #
  # 
  cat <<HELP
  
  Create a new project based on the default or optionally specified template.
  
  Usage:

    page new <name> [options]

  Options:

    -t    Specify name of project template to use.
    -h    Display this message and exit.

HELP

  template_list new
}


function page_cmd_new {
  
  page_options "$@"
  
  if [[ ${POPTHELP} ]]; then
    page_new_help
    exit 0; 
  fi
  
  PNAME=$1; shift

  if [[ ${POPTTMPL} ]]; then 
    if [[ ! ${TMPLFUNC[new.${POPTTMPL}]} ]]; then
      echo "ERROR: Unkown project type: ${POPTTMPL}"
      exit 0;
    fi
    PTYPE=${POPTTMPL}
  fi
  ${TMPLFUNC[new.$PTYPE]} "${name}"   # Execute approprate new command.

}
