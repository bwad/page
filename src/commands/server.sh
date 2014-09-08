
# src/commands/server.sh

function page_server_help {
  
  cat <<HELP
  
  Run web server
  
  Usage:

    page server 

  Options:

  -h    Display this message and exit.

HELP

# template_list test
}

function page_cmd_server {
  page_options "$@"
  
  if [[ ${POPTHELP} ]]; then
    page_server_help
    exit 0; 
  fi
  
  ( sleep 1; open http://localhost:8000 ) &   # delayed subshell
  page_options "$@"
  if [[ $POPTROUTER ]]; then
      printf -- "php -S localhost:8000 -t pub router.php\n"
      php -S localhost:8000 -t pub router.php
  else
      printf -- "php -S localhost:8000 -t pub\n"
      php -S localhost:8000 -t pub
  fi
  
}
