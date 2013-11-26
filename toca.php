<?php
	$host = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "tomtom";

	$c = mysql_connect($host,$usuario,$senha);

	if(!$c)
	{
		echo "erro na conexão";
		echo mysql_error();
		die();
	}

	if(!mysql_select_db($banco))
	{
		echo "erro no select_db";
		echo mysql_error();
		mysql_close($c);
		die();
	}

	$id = $_REQUEST["id"];
	$sql = "select ogg from notas where id = {$id}";// seleciona o ogg da nota

	$resp = mysql_query($sql);

	if(!$resp)
	{
		echo "erro na consulta $sql";
		echo mysql_error();
		mysql_close($c);
		die();
	}

	$linha = mysql_fetch_assoc($resp);
	if($linha)
	{
		$mime = "audio/ogg";
		header('Content-Description: File Transfer');
		header('Content-Type: '.$mime);
		header('Content-Disposition: inline; filename=musica.ogg');//baixa o file, inline faz o q?
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');	
		echo $linha["ogg"];
	}
	mysql_free_result($resp);
	mysql_close($c);

?>