
# Look for leading '-' in string.
#

foo="  -x foo bar -x"

if [[ $foo =~ ^[[:blank:]]*\-+ ]]; then
  echo "leading options"
fi