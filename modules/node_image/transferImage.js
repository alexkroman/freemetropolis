function node_image_transferImageRef(){
  str='<img class="node-image"';
  str+=" width=\""+document.transferForm.elements['edit[width]'].value+"\"";
  str+=" height=\""+document.transferForm.elements['edit[height]'].value+"\"";
  str+=" src=\""+document.transferForm.elements['edit[src]'].value+"\"";
  str+=" title=\""+document.transferForm.elements['edit[title]'].value+"\"";
  if(document.transferForm.elements['edit[align]'].value!="none"){
    str+=' align="'+document.transferForm.elements['edit[align]'].value+'"';
  }
  str+=' />';
  opener.node_image_insertAtCursor(opener.document.forms['node-form'].elements['edit[body]'], str);
  window.close();
}