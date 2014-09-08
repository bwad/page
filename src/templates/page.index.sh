
# src/templates/page.index.sh

TMPLNAME+=('page.index')
TMPLDESC['page.index']="Basic index.html page."
TMPLFUNC['page.index']=templates_page_index

function templates_page_index {
  
  local dst=$1

  printf -- "    Creating ${dst}.\n"
    
  cat > ${dst}<<INDEX
<?php 
include '../src/autoload.php'; 
include '../src/pagelib.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>${TMPLDATA['title']}</title>
    <link href="lib/bootstrap.css" rel="stylesheet">
    <link href="css/${PNAME}.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php part('${TMPLDATA['part']}'); ?>
    <script type="text/javascript" charset="utf-8" src="lib/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="lib/underscore.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/${PNAME}.js"></script>
  </body>
</html>

INDEX

}