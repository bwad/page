#!/usr/bin/env bash
#
# Strip version off direcotry/file name
#

# Test Data
VERA="jquery.mobile-1.4.0"
VERB="html5-boilerplate-4.3.0"

regex='\-+([[:digit:]])\.+([[:digit:]])\.+([[:digit:]])'
shopt -s extglob
result_a=${VERA%\-+([[:digit:]])\.+([[:digit:]])\.+([[:digit:]])}
echo $result_a

result_b=${VERB%${regex}}
echo $result_b