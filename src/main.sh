
#=============================================================================
#
#   Main
#
#   Possible enchancements:
#       - 
#=============================================================================

#
# Handle lone -h option and zero argument command.
# 
if [[ $1 == "-h" || $# -eq 0 ]]; then page_usage; exit 0; fi
#
# Command processing.
#
CMD=$1; shift
case $CMD in
  
    new) 
      page_cmd_new "$@"
      ;;
      
    server) 
      page_cmd_server "$@"
      ;;
        
    add)
      page_cmd_add "$@"
      ;;
      
    part) 
      page_cmd_part "$@"
      ;;
      
    class) 
      page_cmd_class "$@"
      ;;
      
    test) 
      page_cmd_test "$@"
      ;;
      
    model) 
      page_cmd_model "$@"
      ;;
      
    *) printf -- "ERROR: Unknown command $CMD\n"
      ;;
esac


