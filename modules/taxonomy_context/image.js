function preload(imgObj,imgSrc) {
  if (document.images) {
    eval(imgObj+' = new Image()')
    eval(imgObj+'.src = "modules/taxonomy_context/images/'+imgSrc+'"')
  }
}
function switchImg(elt,str){
  elt.style.backgroundImage="url(modules/taxonomy_context/images/"+str+".gif)";
}
preload('tab_on','tab_on.gif');
preload('tab','tab.gif');
