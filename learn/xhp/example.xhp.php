<?php
require 'init.php';

// note: includes omitted
if ($_POST['name']) {
  echo <span>Hello, {$_POST['name']}</span>;
} else {
  echo
    <form method="post">
      What is your name?<br />
      <input type="text" name="name" />
      <input type="submit" />
    </form>;
}