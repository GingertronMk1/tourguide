<?php

// echo "<pre>" . json_encode(get_defined_vars(), JSON_PRETTY_PRINT) . "</pre>"; die;

function adminer_object() {

  class AdminerSoftware extends Adminer {

    function credentials() {
      // server, username and password for connecting to database
      return ['database', 'laravel', '12345'];
    }

    function database() {
      // database name, will be escaped by Adminer
      return 'laravel';
    }

  }

  return new AdminerSoftware;
}

include './adminer.php';
