#! /usr/local/bin/bash

# test/example_test.sh

# . ../src/resource.sh  # We can do this here to get global RESLST/RESDST definitions.

testJQuery()
{
  # Source'ing code under test here is because'declare -A' creates locals when used in
  # function bodies. Since oneTimeSetUp is a function, RESLST and RESDST definitions
  # are gone by the time the test case is called.
  . ../src/utils.sh   # possible dependency on die().
  . ../src/resource.sh  
  resource jquery
  assertTrue " 'pub/js/jquery.js' not created " "[ -e pub/lib/jquery.js ]"
} 

testFavicon()
{
  . ../src/utils.sh   # possible dependency on die().
  . ../src/resource.sh  
  resource favicon
  assertTrue " 'pub/favicon.ico' not created " "[ -e pub/favicon.ico ]"
} 

testBootstrap() {
  . ../src/utils.sh   # possible dependency on die().
  . ../src/resource.sh  
  resource bootstrap
  assertTrue " 'pub/css/bootstrap.css' not created " "[ -e pub/lib/bootstrap.css ]"
  assertTrue " 'pub/css/bootstrap.css.map' not created " "[ -e pub/lib/bootstrap.css.map ]"
  
}

testUnderscore() {
  . ../src/utils.sh   # possible dependency on die().
  . ../src/resource.sh  
  resource underscore
  assertTrue " 'pub/js/underscore.js' not created " "[ -e pub/lib/underscore.js ]"
  
}

setUp() {
  rm -rf pub   # Deals with case where test exits early.
  mkdir -p pub/lib
}

tearDown() {
  rm -rf pub
}

oneTimeSetUp()
{
  # load code to test
  # . ../src/resource.sh
  :
}

# suite() {
#   suite_addTest btestResourceOne
#   suite_addTest btestResourceTwo
# }

# load and run shUnit2
. ../shunit2/src/shunit2
