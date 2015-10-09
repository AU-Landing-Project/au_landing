function Save_Button_onclick() {
	if (document.getElementById("CodeArea").value == ''){
		tinyMCEPopup.close();
		return false;
	}
	else {
		var lang = document.getElementById("CodeLanguage").value;
		var code = "<pre>";
		if (lang == 'auto') {
			code += "<code>";
		}
		else {
			code += "<code class='" + lang + "'>";
		}
		code += EscapeHtml(document.getElementById("CodeArea").value);
		code += "</code></pre>";
		tinyMCEPopup.execCommand('mceInsertContent', false, code);
		tinyMCEPopup.close();
	}
}
    
function Cancel_Button_onclick() {
	tinyMCEPopup.close();
	return false;
}

function EscapeHtml(html) {
	return html.replace(/&/gm,'&amp;').replace(/</gm,'&lt;').replace(/>/gm,'&gt;').replace(/"/gm,'&quot;');
}