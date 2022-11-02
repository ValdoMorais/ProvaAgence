// Daniel Sócrates
function Flash(swf, width, height, flashvars, id){
	var escreveFlash = new String();
	if (navigator.appName.indexOf("Microsoft") != -1){
		escreveFlash += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
		escreveFlash += 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=version=8,0,0,0" ';
		escreveFlash += 'width="' + width + '" height="' + height + '" name="' + id + '"id = '+ id +'">';
		escreveFlash += '<param name="movie" value="' + swf + '"/>';
		if(flashvars != null) {escreveFlash += '<param name="flashvars" value="' + flashvars + '"/>'};
		escreveFlash += '<param name="menu" value="false"/>';
		escreveFlash += '<param name="salign" value="LT"/>';
		escreveFlash += '<param name="scale" value="noscale"/>';
		escreveFlash += '<param name="wmode" value="transparent"/>';
		escreveFlash += '<param name="allowScriptAccess" value="sameDomain"/>';
		escreveFlash += '</object>';
	} else{
		escreveFlash += '<embed src="' + swf + '" ';
		escreveFlash += 'width="' + width + '" ';
		escreveFlash += 'height="' + height + '" ';
		escreveFlash += 'id="' + id + '" ';
		escreveFlash += 'name="' + id + '" ';
		escreveFlash += 'menu="false" ';
		escreveFlash += 'scale="noscale" ';
		escreveFlash += 'salign="LT" ';
		escreveFlash += 'wmode="transparent" ';
		escreveFlash += 'allowScriptAccess="sameDomain" ';
		if(flashvars != null) {escreveFlash += 'flashvars="' + flashvars + '" '};
		escreveFlash += 'type="application/x-shockwave-flash" ';
		escreveFlash += 'pluginspage="http://www.macromedia.com/go/getflashplayer">';
		escreveFlash += '</embed>';
	}
	document.write(escreveFlash);
}