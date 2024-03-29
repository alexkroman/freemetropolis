// PHP Layers Menu 3.1.3 (C) 2001-2004 Marco Pratesi (marco at marcopratesi dot it)

function scanChildren(element) {
	var counter = element.childNodes.length;
        for (var i=0; i<counter; i++) {
                foobar = element.childNodes.item(i);
		if (	( (Konqueror22 || Konqueror30 || Konqueror31) &&
			 (  foobar.nodeName == 'INPUT' || foobar.nodeName == 'input'
			 || foobar.nodeName == 'SELECT' || foobar.nodeName == 'select'
			 || foobar.nodeName == 'TEXTAREA' || foobar.nodeName == 'textarea'
			 )
			)
			||
// Konqueror 3.2 needs hiding only for the following two form elements, but, alas,
// at the time of this writing (Konqueror 3.2.2), hiding of such two form elements
// on Konqueror 3.2.x does not work, it is affected by the following bug: http://bugs.kde.org/72885
			( Konqueror32 &&
			 ( (foobar.nodeName == 'SELECT' || foobar.nodeName == 'select') && foobar.size > 1 )
			 || foobar.nodeName == 'TEXTAREA' || foobar.nodeName == 'textarea'
			)
			|| 
			( IE &&
			 ( foobar.nodeName == 'SELECT' || foobar.nodeName == 'select' )
			)
		) {
			toBeHidden[toBeHidden.length] = foobar;
		}
                if (foobar.childNodes.length > 0) {
                        scanChildren(foobar);
                }
        }
}

//document.write("<br />\nSCANNING STARTED<br />\n");
//scanChildren(document.getElementsByTagName('BODY').item(0));
if ((Konqueror || IE5) && document.getElementById('phplmseethrough')) {
	scanChildren(document.getElementById('phplmseethrough'));
}
//document.write("<br />\nSCANNING COMPLETED<br />\n");

if ((Konqueror && !Konqueror22) || IE5) {
	for (i=0; i<toBeHidden.length; i++) {
		object = toBeHidden[i];
		toBeHiddenLeft[i] = object.offsetLeft;
		while (object.tagName != 'BODY' && object.offsetParent) {
			object = object.offsetParent;
			toBeHiddenLeft[i] += object.offsetLeft;
		}
		object = toBeHidden[i];
		toBeHiddenTop[i] = object.offsetTop;
		while (object.tagName != 'BODY' && object.offsetParent) {
			object = object.offsetParent;
			toBeHiddenTop[i] += object.offsetTop;
		}
	}
}

