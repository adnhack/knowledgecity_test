<?php

  spl_autoload_register(function ($class) {
    include 'app/'.$class . '.php';
  });
