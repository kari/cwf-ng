<?php
/**
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * Original file cake/libs/view/media.php
 * Modifications to original (c) CWF Development Team, 2009.
 */
class MediaView extends View {
/**
 * Holds known mime type mappings
 *
 * @var array
 * @access public
 */

	// TODO: Update mimeType array from downloads_controller. There's also lots of types we probably don't want to EVER serve in CWF-ng context (fe. Javascript).
	
	var $mimeType = array('ai' => 'application/postscript', 'bcpio' => 'application/x-bcpio', 'bin' => 'application/octet-stream',
								'ccad' => 'application/clariscad', 'cdf' => 'application/x-netcdf', 'class' => 'application/octet-stream',
								'cpio' => 'application/x-cpio', 'cpt' => 'application/mac-compactpro', 'csh' => 'application/x-csh',
								'csv' => 'application/csv', 'dcr' => 'application/x-director', 'dir' => 'application/x-director',
								'dms' => 'application/octet-stream', 'doc' => 'application/msword', 'drw' => 'application/drafting',
								'dvi' => 'application/x-dvi', 'dwg' => 'application/acad', 'dxf' => 'application/dxf', 'dxr' => 'application/x-director',
								'eps' => 'application/postscript', 'exe' => 'application/octet-stream', 'ez' => 'application/andrew-inset',
								'flv' => 'video/x-flv', 'gtar' => 'application/x-gtar', 'gz' => 'application/x-gzip',
								'bz2' => 'application/x-bzip', '7z' => 'application/x-7z-compressed', 'hdf' => 'application/x-hdf',
								'hqx' => 'application/mac-binhex40', 'ips' => 'application/x-ipscript', 'ipx' => 'application/x-ipix',
								'js' => 'application/x-javascript', 'latex' => 'application/x-latex', 'lha' => 'application/octet-stream',
								'lsp' => 'application/x-lisp', 'lzh' => 'application/octet-stream', 'man' => 'application/x-troff-man',
								'me' => 'application/x-troff-me', 'mif' => 'application/vnd.mif', 'ms' => 'application/x-troff-ms',
								'nc' => 'application/x-netcdf', 'oda' => 'application/oda', 'pdf' => 'application/pdf',
								'pgn' => 'application/x-chess-pgn', 'pot' => 'application/mspowerpoint', 'pps' => 'application/mspowerpoint',
								'ppt' => 'application/mspowerpoint', 'ppz' => 'application/mspowerpoint', 'pre' => 'application/x-freelance',
								'prt' => 'application/pro_eng', 'ps' => 'application/postscript', 'roff' => 'application/x-troff',
								'scm' => 'application/x-lotusscreencam', 'set' => 'application/set', 'sh' => 'application/x-sh',
								'shar' => 'application/x-shar', 'sit' => 'application/x-stuffit', 'skd' => 'application/x-koan',
								'skm' => 'application/x-koan', 'skp' => 'application/x-koan', 'skt' => 'application/x-koan',
								'smi' => 'application/smil', 'smil' => 'application/smil', 'sol' => 'application/solids',
								'spl' => 'application/x-futuresplash', 'src' => 'application/x-wais-source', 'step' => 'application/STEP',
								'stl' => 'application/SLA', 'stp' => 'application/STEP', 'sv4cpio' => 'application/x-sv4cpio',
								'sv4crc' => 'application/x-sv4crc', 'svg' => 'image/svg+xml', 'svgz' => 'image/svg+xml',
								'swf' => 'application/x-shockwave-flash', 't' => 'application/x-troff',
								'tar' => 'application/x-tar', 'tcl' => 'application/x-tcl', 'tex' => 'application/x-tex',
								'texi' => 'application/x-texinfo', 'texinfo' => 'application/x-texinfo', 'tr' => 'application/x-troff',
								'tsp' => 'application/dsptype', 'unv' => 'application/i-deas', 'ustar' => 'application/x-ustar',
								'vcd' => 'application/x-cdlink', 'vda' => 'application/vda', 'xlc' => 'application/vnd.ms-excel',
								'xll' => 'application/vnd.ms-excel', 'xlm' => 'application/vnd.ms-excel', 'xls' => 'application/vnd.ms-excel',
								'xlw' => 'application/vnd.ms-excel', 'zip' => 'application/zip', 'aif' => 'audio/x-aiff', 'aifc' => 'audio/x-aiff',
								'aiff' => 'audio/x-aiff', 'au' => 'audio/basic', 'kar' => 'audio/midi', 'mid' => 'audio/midi',
								'midi' => 'audio/midi', 'mp2' => 'audio/mpeg', 'mp3' => 'audio/mpeg', 'mpga' => 'audio/mpeg',
								'ra' => 'audio/x-realaudio', 'ram' => 'audio/x-pn-realaudio', 'rm' => 'audio/x-pn-realaudio',
								'rpm' => 'audio/x-pn-realaudio-plugin', 'snd' => 'audio/basic', 'tsi' => 'audio/TSP-audio', 'wav' => 'audio/x-wav',
								'asc' => 'text/plain', 'c' => 'text/plain', 'cc' => 'text/plain', 'css' => 'text/css', 'etx' => 'text/x-setext',
								'f' => 'text/plain', 'f90' => 'text/plain', 'h' => 'text/plain', 'hh' => 'text/plain', 'htm' => 'text/html',
								'html' => 'text/html', 'm' => 'text/plain', 'rtf' => 'text/rtf', 'rtx' => 'text/richtext', 'sgm' => 'text/sgml',
								'sgml' => 'text/sgml', 'tsv' => 'text/tab-separated-values', 'tpl' => 'text/template', 'txt' => 'text/plain',
								'xml' => 'text/xml', 'avi' => 'video/x-msvideo', 'fli' => 'video/x-fli', 'mov' => 'video/quicktime',
								'movie' => 'video/x-sgi-movie', 'mpe' => 'video/mpeg', 'mpeg' => 'video/mpeg', 'mpg' => 'video/mpeg',
								'qt' => 'video/quicktime', 'viv' => 'video/vnd.vivo', 'vivo' => 'video/vnd.vivo', 'gif' => 'image/gif',
								'ief' => 'image/ief', 'jpe' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpeg',
								'pbm' => 'image/x-portable-bitmap', 'pgm' => 'image/x-portable-graymap', 'png' => 'image/png',
								'pnm' => 'image/x-portable-anymap', 'ppm' => 'image/x-portable-pixmap', 'ras' => 'image/cmu-raster',
								'rgb' => 'image/x-rgb', 'tif' => 'image/tiff', 'tiff' => 'image/tiff', 'xbm' => 'image/x-xbitmap',
								'xpm' => 'image/x-xpixmap', 'xwd' => 'image/x-xwindowdump', 'ice' => 'x-conference/x-cooltalk',
								'iges' => 'model/iges', 'igs' => 'model/iges', 'mesh' => 'model/mesh', 'msh' => 'model/mesh',
								'silo' => 'model/mesh', 'vrml' => 'model/vrml', 'wrl' => 'model/vrml',
								'mime' => 'www/mime', 'pdb' => 'chemical/x-pdb', 'xyz' => 'chemical/x-pdb');
/**
 * Constructor
 *
 * @param object $controller
 */
	function __construct(&$controller) {
		parent::__construct($controller);
	}
/**
 * Display or download the given file
 *
 * @return unknown
 */
	function render() {
		$name = $download = $extension = $id = $modified = $path = $size = $cache = $mimeType = null;
		extract($this->viewVars, EXTR_OVERWRITE);

		if ($size) {
			$id = $id . '_' . $size;
		}

		// Not sure what's the function of this if block...
		if (is_dir($path)) {
			$path = $path . $id;
		} else {
			// TODO: We shouldn't be here. Fix error message.
			die("System error.");
		}

		if (is_null($name)) {
			$name = $id;
		}

		if (is_array($mimeType)) {
			$this->mimeType = array_merge($this->mimeType, $mimeType);
		}

		if (file_exists($path) && isset($extension) && isset($this->mimeType[$extension]) && connection_status() == 0) {
			$chunkSize = 8192;
			$buffer = '';
			$fileSize = @filesize($path);
			$handle = fopen($path, 'rb');

			if ($handle === false) {
				return false;
			}
			if (!empty($modified)) {
				$modified = gmdate('D, d M Y H:i:s', strtotime($modified, time())) . ' GMT';
			} else {
				$modified = gmdate('D, d M Y H:i:s') . ' GMT';
			}

			if ($download) {
				// WTF? Why we don't send it with the correct MIME-type? Apparently cakePHP devs are such super-gods they don't need to comment their code.
				$contentType = 'application/octet-stream';
				$agent = env('HTTP_USER_AGENT');

				if (preg_match('%Opera(/| )([0-9].[0-9]{1,2})%', $agent) || preg_match('/MSIE ([0-9].[0-9]{1,2})/', $agent)) {
					$contentType = 'application/octetstream';
				}
				header('Content-Type: ' . $contentType);
				header("X-Real-Content-Type: ".$this->mimeType[$extension]); # TODO: We probably should use this one.
				header('Content-Disposition: attachment; filename="' . $name . '.' . $extension . '";');
				header('Expires: 0');
				header('Accept-Ranges: bytes');
				header('Cache-Control: private', false);
				header('Pragma: private');

				$httpRange = env('HTTP_RANGE');
				if (isset($httpRange)) {
					list($toss, $range) = explode('=', $httpRange);

					$size = $fileSize - 1;
					$length = $fileSize - $range;

					header('HTTP/1.1 206 Partial Content');
					header('Content-Length: ' . $length);
					header('Content-Range: bytes ' . $range . $size . '/' . $fileSize);
					fseek($handle, $range);
				} else {
					header('Content-Length: ' . $fileSize);
				}
			} else {
				header('Date: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
				if ($cache) {
					if (!is_numeric($cache)) {
						$cache = strtotime($cache) - time();
					}
					header('Cache-Control: max-age=' . $cache);
					header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache) . ' GMT');
					header('Pragma: cache');
				} else {
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: no-cache');
				}
				header('Last-Modified: ' . $modified);
				header('Content-Type: ' . $this->mimeType[$extension]);
				header('Content-Length: ' . $fileSize);
			}
			@ob_end_clean();

			while (!feof($handle) && connection_status() == 0 && !connection_aborted()) {
				set_time_limit(0);
				$buffer = fread($handle, $chunkSize);
				echo $buffer;
				@flush();
				@ob_flush();
			}
			fclose($handle);
			exit(0);
		}
		return false;
	}
}
?>