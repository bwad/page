
# src/templates/part.hello.sh

TMPLNAME+=('part.hello')
TMPLDESC['part.hello']="Basic partial."
TMPLFUNC['part.hello']=templates_part_hello

function templates_part_hello {
  
  local dst=$1

  printf -- "    Creating ${dst}.\n"
    
  cat > ${dst}<<PART
<h1>Hello from page!</h1>
PART
}