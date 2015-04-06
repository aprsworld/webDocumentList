<?

function docFunctions_headMessage() {
	return "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.8.3.min.js\"></script><script src=\"http://www.aprsworld.com/documents/document.js\" type=\"text/javascript\"></script>";
}

/*
Example format for document tree:
$d=array();
$d[]='General Information';
$d[]='turbineOverallDims.WT10.1.pdf|WT10 Overall Dimensions|Overall dimensions of complete turbine assembly.';
$d[]='towerDetails.WT10.1.pdf|WT10 Tower Details';

$d[]='Bolt On Blades';
$d[]='boltOnBlades.WT10.2.pdf|WT10 Permanent Mount Blade Assembly Diagram';
*/

function docFunctions_build($d) {
$lastParts=0;
for ( $i=0 ; $i<count($d) ; $i++ ) {
	$doc=explode("|",$d[$i]);

	if ( 0==$lastParts && 1==count($doc) ) {
		/* just started ... print heading and open UL */
		printf("<h2 style=\"clear: both;\">%s</h2>\n",$doc[0]);
		printf("<ul>\n");

		$lastParts=count($doc);
		continue;
	} else if ( 0==$lastParts && count($doc)>=2 ) {
		printf("<ul>\n");
	} else if ( 1==count($doc) ) {
		/* already in a list ... close UL */
		printf("</ul>\n");
		printf("<h2 style=\"clear: both;\">%s</h2>\n",$doc[0]);
		printf("<ul>\n");

		$lastParts=count($doc);
		continue;
	}

	$extension=strtolower(substr($doc[0],strlen($doc[0])-3));
	if ( 'pdf' == $extension ) {
		$previewExtension='png';
		$type='PDF';
		$title='Document';
	} else if ( 'jpg' == $extension ) {
		$previewExtension='jpg';
		$type='JPEG';
		$title='Photo';
	}

	printf("\t<li class=\"docDisplay\">\n\t\t<a href=\"%s\" class=\"preview\" title=\"%s\"><img class=\"docDisplay\" src=\"previews/%s.%s\" alt=\"%s\" /></a>\n",
		$doc[0],
		$doc[1],
		substr($doc[0],0,strlen($doc[0])-3) . "preview220",
		$previewExtension,
		$doc[1]
	);

	printf("\t\t<h3>%s: <a href=\"%s\">%s</a></h3>\n",$title,$doc[0],$doc[1]);
	if ( $doc[2] != '' ) {
		printf("\t\t<b>Description:</b> %s<br />\n",$doc[2]);
	}
	printf("\t\t<b>Type:</b> %s<br />\n",$type);
	printf("\t\t<b>Size:</b> %s KB<br />\n",number_format(filesize($doc[0])/1024.0,0));
	printf("\t</li>\n");

	$lastParts=count($doc);
}
printf("</ul>\n");
}

?>
