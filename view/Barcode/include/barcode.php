<?php
/*	require("barcode.inc.php");

	$encode=$_REQUEST['encode'];
	$bar= new BARCODE();
	
	if($bar==false)
		die($bar->error());
	// OR $bar= new BARCODE("I2O5");

	$barnumber=$_REQUEST['bdata'];
	
	$bar->setSymblogy($encode);
	$bar->setHeight($_REQUEST['height']);
	$bar->setScale($_REQUEST['scale']);
	$bar->setHexColor($_REQUEST['color'],$_REQUEST['bgcolor']);

	$return = $bar->genBarCode($barnumber,"png");
	
	if($return==false)
		$bar->error(true);*/
		
	//pdf support	
	require_once("barcode.inc.php");
	
	$isPdf = isset( $pdf );
	
	if( $isPdf )
	{
		$encode = $params['encode'];
		$barnumber = $params['bdata'];
		$height = $params['height'];
		$scale = $params['scale'];
		$color = $params['color'];
		$bgcolor = $params['bgcolor'];
	} 
	else 
	{
		$encode = $_REQUEST['encode'];
		$barnumber = $_REQUEST['bdata'];
		$height = $_REQUEST['height'];
		$scale = $_REQUEST['scale'];
		$color = $_REQUEST['color'];
		$bgcolor = $_REQUEST['bgcolor'];
	}
	
	$bar = new BARCODE();
	
	if( $bar == false )
		die( $bar->error() );
	// OR $bar= new BARCODE("I2O5");
	
	$bar->setSymblogy($encode);
	$bar->setHeight($height);
	$bar->setScale($scale);
	$bar->setHexColor($color,$bgcolor);

	if( $isPdf )
	{
		$return = $bar->genBarCode($barnumber,"png", "templates_c/tempBarcode");
		$file = myfile_get_contents( "templates_c/tempBarcode.png" );
		runner_delete_file("templates_c/tempBarcode.png");		
	} 
	else
	{
		$return = $bar->genBarCode($barnumber,"png");
		if( $return == false )
			$bar->error(true);
	}
	
?>