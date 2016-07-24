<?php namespace fub;
  include 'file1.php';
  include 'file2.php';
  include 'file3.php';
  // Load class Cat from foo namespace
  use foo\Cat;
  // use bar under the name canine (Alias)
  use bar as canine;
  // use animate namespace
  use animate;
  // Cat is loaded as foo\Cat
  echo Cat::says(), "<br />\n";
  //
  echo canine\Dog::says(), "<br />\n";
  // Need to prefix by the namespace since the class is not loaded
  echo animate\Animal::breathes(), "<br />\n";
