
# src/commands/model.sh

function page_model_help {
  
  cat <<HELP
  
  Create a new php DAO object.
  
  Usage:

    page model <name> [options]

  Options:

    -t    Specify name of template to use.
    -h    Display this message and exit.

HELP

template_list model
}

#=============================================================================
#
# model command
#
# Format: page model <name> -t <template>
#
function page_cmd_model {
  
  page_options "$@"
  
  if [[ ${POPTHELP} ]]; then
    page_model_help
    exit 0; 
  fi
  
  local fname=$1; shift  # Name of the new file
  local tmpl='default'    # Default template
  if [[ ${POPTTMPL} ]]; then 
    if [[ ! ${TMPLFUNC[part.${POPTTMPL}]} ]]; then
      echo "ERROR: Unkown template: ${POPTTMPL}"
      exit 0;
    fi
    tmpl=${POPTTMPL}
  fi
  unset TMPLDATA; declare -A TMPLDATA=( [model_name]=${fname^[a-z]} )  # unset to prevent old data.
  ${TMPLFUNC[model.${tmpl}]} src/${fname}DAO.php # Execute approprate new command.

}
