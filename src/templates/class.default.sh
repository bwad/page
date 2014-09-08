
# src/templates/class.default.sh

TMPLNAME+=('class.default')
TMPLDESC['class.default']="Basic PHP Class."
TMPLFUNC['class.default']=templates_class_default

function templates_class_default {
  
  local dst=$1

  printf -- "    Creating ${dst}.\n"
    
  cat > ${dst}<<CLASS
  <?php  

  class ${TMPLDATA['class_name']}  {  

      public \$prop1 = "I'm a class property!";  

      public function __construct()  
      {  
          echo 'The class "', __CLASS__, '" was initiated!<br />';  
      }  
  }  

  ?>  
CLASS
}
