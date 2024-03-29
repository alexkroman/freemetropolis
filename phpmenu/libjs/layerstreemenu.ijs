// PHP Layers Menu 3.1.3 (C) 2001-2004 Marco Pratesi (marco at marcopratesi dot it)

function {toggle_function_name}(nodeid) {
	if ((!DOM || Opera56 || Konqueror22) && !IE4) {
		return;
	}
	layersMoved = 0;
	parseExpandString();
	parseCollapseString();
	if (!IE4) {
		sonLayer = document.getElementById('jt' + nodeid + 'son');
		nodeLayer = document.getElementById('jt' + nodeid + 'node');
		folderLayer = document.getElementById('jt' + nodeid + 'folder');
	} else {
		sonLayer = document.all('jt' + nodeid + 'son');
		nodeLayer = document.all('jt' + nodeid + 'node');
		folderLayer = document.all('jt' + nodeid + 'folder');
	}
	if (sonLayer.style.display == 'none') {
		sonLayer.style.display = 'block';
		if (nodeLayer.src.indexOf('{img_expand}') > -1) {
			nodeLayer.src = '{img_collapse}';
		} else if (nodeLayer.src.indexOf('{img_expand_first}') > -1) {
			nodeLayer.src = '{img_collapse_first}';
		} else {
			nodeLayer.src = '{img_collapse_corner}';
		}
		folderLayer.src = '{img_folder_open}';
		phplm_expand[nodeid] = 1;
		phplm_collapse[nodeid] = 0;
	} else {
		sonLayer.style.display = 'none';
		if (nodeLayer.src.indexOf('{img_collapse}') > -1) {
			nodeLayer.src = '{img_expand}';
		} else if (nodeLayer.src.indexOf('{img_collapse_first}') > -1) {
			nodeLayer.src = '{img_expand_first}';
		} else {
			nodeLayer.src = '{img_expand_corner}';
		}
		folderLayer.src = '{img_folder_closed}';
		phplm_expand[nodeid] = 0;
		phplm_collapse[nodeid] = 1;
	}
	saveExpandString();
	saveCollapseString();
}

