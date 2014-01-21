<?php
	/**
	 * arquivo com funções que ainda nao receberam uma classe
	 */


	/**
	 * mostra um array e morre
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function dg($data) 
	{	
		echo '<pre>';
		if(is_array($data))
			print_r($data);
		else
			echo $data;
		echo '</pre>';
		die;
	}

	/**
	 * mostra um array e continua a execuçao
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function sw($data) 
	{	
		echo '<pre>';
		if(is_array($data))
			print_r($data);
		else
			echo $data;
		echo '</pre>';
	}
	

	function sstream_resolve_include_path($path) 
	{
		$prefixPaths = get_include_path();

		$separator = ":";
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { 
			$separator = ";";
		}

		$prefixPaths = explode($separator, $prefixPaths);


		foreach($prefixPaths as $prefixPath) {
			if(file_exists($prefixPath."/".$path))
				return $path;   
		}

		return null;
	}


	
?>
