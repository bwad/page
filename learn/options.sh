#!/usr/bin/env bash

# Experiments with placement of command line options before and after command
# line arguments.
#
#
#   page new blue -t php
#
#   VS
#
#   page -t php new blue
#


# NOTES:
# - If the leading arguments shifted off, the switches/options are processed
#   normally by getopts.
#

pargs="-h -t php new foo -t php"

function p_args {
  
  while [[ $1 =~ ^[[:blank:]]*\-+ ]]; do
    if getopts "ht:" opt
      then 
        case $opt in
          h) echo help
            ;;
          t) printf -- "TYPE: $OPTARG\n"
            shift
            ;;
          *) echo unkown
            ;;
        esac
    fi
    shift
    echo "$*"
  done
  echo "$*"  
}

p_args $pargs

