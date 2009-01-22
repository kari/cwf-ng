<?
/*
The purpose of this model is to overcome the problem of encodings between application and database. 

The database is assumed to use MySQL's latin1_swedish_ci (or, cp1252 or Windows-1252) which is basically a superset of ISO-8859-1.

The application is assumed to use UTF-8.
*/
class AppModel extends Model {

	function array_toutf8(&$item,$key) {
		$item = iconv("cp1252","UTF-8//IGNORE",$item);
		# FIXME: Is the database actually 100% in latin1_swedish_ci? Reviews cause problems.
	}
	
	function array_tolatin1(&$item,$key) {
		$item = iconv("UTF-8","cp1252//TRANSLIT",$item);
		# FIXME: We can't preserve UTF-8 characters that do not have representation in cp1262.
	}

	function afterFind($results) {
		# Convert cp1252 to UTF-8
		array_walk_recursive($results,array("AppModel","array_toutf8"));
		return $results;
	}
	
	function beforeSave() {
		# Convert UTF-8 to cp1252
		# access $this->data
		$ret = array_walk_recursive($this->data,array("AppModel","array_tolatin1"));
		return $ret;
	}
}

?>