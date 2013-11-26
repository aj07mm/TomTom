<?php 
	session_start();
	
	$host = "localhost";
	$usuario = "root";
	$senha = "";//criar senha!
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
	
	$id=mt_rand(1, 24);
	
	$sql = "select id,nota,ogg
		from notas
		where id=$id";

	$resp = mysql_query($sql);

	if(!$resp)
	{
		echo "erro na consulta $sql";
		echo mysql_error();
		mysql_close($c);
		die();
	}

	$linha = mysql_fetch_assoc($resp);
	
	//ja começa com zero
	
	if($_SESSION["adcount"]==null)
		$_SESSION["adcount"]=0;
	if($_SESSION["count"]==null)
		$_SESSION["count"]=0;
	
	if($_SESSION["adcount"]!=NULL){
			$_SESSION["count"]=$_SESSION["count"]+$_SESSION["adcount"];	
			$_SESSION["adcount"]=0;
	}

	if($linha)
	{
?>
		<div align="center">
		<audio controls height="100" width="100" controls autoplay src="toca.php?id=<?php echo $linha['id']; ?>" type="audio/ogg"></audio>  
		</br>
		</div>
<?php	
	}else{
		echo "tabela vazia";
	}
?>
		<form name="myform" action="valida.php" method="POST">
			<div align="center">
				<ul>				
					<li class="li-no-arrow"><input type="hidden" name="id" value="<?php echo $linha['id']; ?>"></li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="1"> C3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="2"> C#3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="3"> D3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="4"> D#3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="5"> E3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="6"> F3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="7"> F#3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="8"> G#3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="9"> A3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="10"> A#3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="11"> B3</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="12"> C4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="13"> C#4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="14"> D4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="15"> D#4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="16"> E4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="17"> F4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="18"> F#4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="19"> G4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="20"> G#4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="21"> A4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="22"> A#4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="23"> B4</li>
					<li class="li-no-arrow"><input type="radio" name="nota" value="24"> C5</li>
					<li class="li-no-arrow"><input type="submit" value="Submit"></li>
				</ul>
			</div>
		</form>
		
<?php
	if(isset($_SESSION["id"])){
		echo $_SESSION["id"];
	}
?>

<html>
	<head>
		<title>TomTom</title>
		<style>
			.li-no-arrow{
				list-style-type: none;
			}
		</style>
	</head>
	<body>
		<div align="right">PONTUAÇÃO = <?php echo $_SESSION["count"]; ?></div>
	</body>
</html>