// adapted from phpMyAdmin as posted on alexking.org
var node_image_mode;
function node_image_insertAtCursor(myField, myValue) {
  if(node_image_mode == "prompt") {
    prompt("Copy and paste this text into the \"body\" field.", myValue);
  }
  else {
    //IE support
  //  myField=eval(myField);
    if (document.selection) {
      myField.focus();
      sel = document.selection.createRange();
      sel.text = myValue;
    }
    //MOZILLA/NETSCAPE support
    else if (myField.selectionStart || myField.selectionStart == '0') {
      var startPos = myField.selectionStart;
      var endPos = myField.selectionEnd;
      myField.value = myField.value.substring(0, startPos)
      + myValue
      + myField.value.substring(endPos, myField.value.length);
    } else {
      myField.value += myValue;
    }
  }
}
// calling the function
// insertAtCursor(document.formName.fieldName, 'this value');

// from http://www.quirksmode.org/js/croswin.html
var newwindow = '';

function node_image_popitup(url)
{
	if (!newwindow.closed && newwindow.location)
	{
		newwindow.location.href = url;
	}
	else
	{
		newwindow=window.open(url,'name','height=200,width=450');
		if (!newwindow.opener) newwindow.opener = self;
	}
	if (window.focus) {newwindow.focus()}
	return false;
}
