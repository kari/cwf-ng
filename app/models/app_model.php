<?
/*
The purpose of this model is to overcome the problem of encodings between application and database. 

The database is assumed to use MySQL's latin1_swedish_ci (or, cp1252 or Windows-1252) which is basically a superset of ISO-8859-1.

The application is assumed to use UTF-8.
*/
class AppModel extends Model {
	
	function array_walk_recursive(&$input, $funcname)
	# PHP4 compatibility. From PEAR/PHP/Compat.
	# FIXME: Does this return anything? It doesn't look like that it returns like PHP5...
  {
      if (!is_callable($funcname)) {
          if (is_array($funcname)) {
              $funcname = $funcname[0] . '::' . $funcname[1];
          }
          user_error('array_walk_recursive() Not a valid callback ' . $user_func,
              E_USER_WARNING);
          return;
      }

      if (!is_array($input)) {
          user_error('array_walk_recursive() The argument should be an array',
              E_USER_WARNING);
          return;
      }

      $args = func_get_args();

      foreach ($input as $key => $item) {
          if (is_array($item)) {
              $this->array_walk_recursive($item, $funcname, $args);
              $input[$key] = $item;
          } else {
              $args[0] = &$item;
              $args[1] = &$key;
              call_user_func_array($funcname, $args);
              $input[$key] = $item;
          }
      }
  }

	function array_toutf8(&$item,$key) {
		$item = iconv("cp1252","UTF-8//IGNORE",$item);
		# FIXME: Is the database actually 100% in latin1_swedish_ci? Reviews cause problems.
	}
	
	function array_tolatin1(&$item,$key) {
		$item = iconv("UTF-8","cp1252//TRANSLIT",$item);
		# FIXME: We can't preserve UTF-8 characters that do not have representation in cp1252.
	}

	function afterFind($results) {
		# Convert cp1252 to UTF-8
		if (!function_exists('array_walk_recursive')) { # PHP4 compat
			$ret = $this->array_walk_recursive($results,array("AppModel","array_toutf8"));
		} else {
			$ret = array_walk_recursive($results,array("AppModel","array_toutf8"));
		}
		# if (!$ret) { $this->log("Couldn't convert DB find results to UTF-8."); }
		return $results;
	}
	
	function beforeSave() {
		# Convert UTF-8 to cp1252
		# access $this->data
		if (!function_exists('array_walk_recursive')) { # PHP4 compat
			$ret = $this->array_walk_recursive($this->data,array("AppModel","array_tolatin1"));
		} else {
			$ret = array_walk_recursive($this->data,array("AppModel","array_tolatin1"));
		}
		if (!$ret) { $this->log("Couldn't convert data into CP1252 for DB save."); }
		return $ret;
	}
}

?>