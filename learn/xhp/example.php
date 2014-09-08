<?php
require 'init.php';

if($_POST['name']){
echo new \xhp_span(array(), array('Hello, ',$_POST['name'],), __FILE__, 6);
}else {
echo 
new \xhp_form(array('method' => 'post',), array(
' What is your name?',new \xhp_br(array(), array(), __FILE__, 10),
new \xhp_input(array('type' => 'text','name' => 'name',), array(), __FILE__, 11),
new \xhp_input(array('type' => 'submit',), array(), __FILE__, 12),), __FILE__, 9);
}