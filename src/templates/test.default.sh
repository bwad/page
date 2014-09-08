
# src/templates/test.default.sh

TMPLNAME+=('test.default')
TMPLDESC['test.default']="Basic PHP Test Class."
TMPLFUNC['test.default']=templates_test_default

function templates_test_default {
  
  local dst=$1

  printf -- "    Creating ${dst}.\n"
    
  cat > ${dst}<<CLASS
<?php  

class ${TMPLDATA['class_name']}Test  extends PHPUnit_Framework_TestCase {  


  public function testCanBeNegated()
  {
      // Arrange
      \$cut = new ${TMPLDATA['class_name']}();

      // Assert
      \$this->assertEquals(1, 1);
  } 
}  

CLASS
}
