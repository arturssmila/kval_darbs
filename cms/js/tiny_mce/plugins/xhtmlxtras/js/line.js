/**
 * line.js //added by LEO
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

function init() {
	SXE.initElementDialog('line');
	if (SXE.currentAction == "update") {
		SXE.showRemoveButton();
	}
}

function insertLine() {
	SXE.insertElement('line');
	tinyMCEPopup.close();
}

function removeLine() {
	SXE.removeElement('line');
	tinyMCEPopup.close();
}

tinyMCEPopup.onInit.add(init);
