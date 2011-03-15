/* ADxMenu_IESetup - (c) Copyright 2003, Aleksandar Vacic, www.aplus.co.yu */
function ADxMenu_IESetup(id) {

	var aTmp2, i, j, oLI, aUL, aA;
	var aTmp = document.getElementById(id);
		
	aTmp2 = aTmp.getElementsByTagName("li");
	for (j=0;j<aTmp2.length;j++) {
		oLI = aTmp2[j];
		aUL = oLI.getElementsByTagName("ul");
		//	if item has submenu, then make the item hoverable
		if (aUL && aUL.length) {
			oLI.UL = aUL[0];	//	direct submenu
			aA = oLI.getElementsByTagName("a");
			if (aA && aA.length)
				oLI.A = aA[0];	//	direct child link
			//	li:hover
			oLI.onmouseenter = function() {
				this.className += " adxmhover";
				this.UL.className += " adxmhoverUL";
				if (this.A) this.A.className += " adxmhoverA";
				if (WCH) WCH.Apply( this.UL, this, true );
			};
			//	li:blur
			oLI.onmouseleave = function() {
				this.className = this.className.replace(/adxmhover/,"");
				this.UL.className = this.UL.className.replace(/adxmhoverUL/,"");
				if (this.A) this.A.className = this.A.className.replace(/adxmhoverA/,"");
				if (WCH) WCH.Discard( this.UL, this );
			};
		}
	}	//for-li.submenu
}

//	adds support for WCH. if you need WCH, then load WCH.js BEFORE this file
if (typeof(WCH) == "undefined") WCH = null;

/*	xGetElementsByClassName()
	Returns an array of elements which are
	descendants of parentEle and have tagName and clsName.
	If parentEle is null or not present, document will be used.
	if tagName is null or not present, "*" will be used.
	credits: Mike Foster, cross-browser.com.
*/
function xGetElementsByClassName(clsName, parentEle, tagName) {
	var elements = null;
	var found = new Array();
	var re = new RegExp('\\b'+clsName+'\\b');
	if (!parentEle) parentEle = document;
	if (!tagName) tagName = '*';
	if (parentEle.getElementsByTagName) {elements = parentEle.getElementsByTagName(tagName);}
	else if (document.all) {elements = document.all.tags(tagName);}
	if (elements) {
		for (var i = 0; i < elements.length; ++i) {
			if (elements[i].className.search(re) != -1) {
				found[found.length] = elements[i];
			}
		}
	}
	return found;
}

function CCSMenu_TreeMenuSetup(id)
{
	var treeMenu = document.getElementById(id);
	if (treeMenu.getElementsByTagName("ul")[0].className.indexOf("menu_vlr_tree") == -1) return;
	var childNodes = treeMenu.getElementsByTagName("ul")[0].childNodes;
	for (var j = 0; j < childNodes.length; j++)
	{
		if (!childNodes[j].tagName || childNodes[j].tagName.toLowerCase() != "li") continue;
		var li = childNodes[j];
		var selected = (li.className.indexOf("selected") != -1);
		var link = childNodes[j].childNodes[0];
		link.setAttribute("href", "javascript: ;");
		link.onclick = function() {
			var re = /(menu_vlr_tree_openedA|menu_vlr_tree_openedUL|menu_vlr_tree_closedUL)/gi;
			var submenu = this.parentNode.getElementsByTagName("ul")[0];
			var closed = (this.className.toLowerCase().indexOf("menu_vlr_tree_openeda") == -1);
			this.className = this.className.replace(re, "").replace(/[\s]{2,}/gi, " ");
			if (submenu) submenu.className = submenu.className.replace(re, "").replace(/[\s]{2,}/gi, " ");
			if (closed)
			{
				this.className += " menu_vlr_tree_openedA";
				if (submenu) submenu.className += " menu_vlr_tree_openedUL";
			}
			else
			{
				if (submenu) submenu.className += " menu_vlr_tree_closedUL";
			}
		};
		if (selected) link.onclick();
	}
}

function CCSMenu_SpansSetup(id)
{
	var menu = document.getElementById(id);
	var spans = "<span class=\"text\">{text}</span><span class=\"right2\"></span>";
	var elements = menu.getElementsByTagName("a");
	for (var j = 0; j < elements.length; j++)
	{
		var a = elements[j];
		var inner = a.innerHTML;
		if (inner.toLowerCase().indexOf("<span") == -1) a.innerHTML = spans.replace(/\{text\}/gi, inner);
	}
}

function menuMarkActLink(menuId)
{
    var menu = document.getElementById(menuId);
    var aTags = menu.getElementsByTagName("a");
    var i, cA=null;
    for (i=0;i<aTags.length;i++)
        //if (aTags[i].href == window.location.href)
        if (isIncluded(aTags[i].href, window.location.href))
        {
            cA = aTags[i];
            break;
        }
    if (cA == null)
        return;
    var par = cA.parentNode;
    while (par.parentNode.tagName.toLowerCase() == "ul" && par.parentNode.parentNode.tagName.toLowerCase() == "li")
        par = par.parentNode.parentNode;
    par.className = "selected";
}

function load_ADxMenu(sender)
{
   if (sender.id && sender.id != "")
   {
       var isIE = !!(window.attachEvent && !window.opera);
       var isIE6 = navigator.userAgent.toLowerCase().indexOf("msie 6.0") != -1;
       CCSMenu_SpansSetup(sender.id);
       if (isIE) ADxMenu_IESetup(sender.id);
       CCSMenu_TreeMenuSetup(sender.id);
       menuMarkActLink(sender.id);
   }
} 

// fix ie blinking
var m = document.uniqueID
&& document.compatMode
&& !window.XMLHttpRequest
&& document.execCommand;

try{
     if(!!m)
      {
         m("BackgroundImageCache", false, true)
      }
}
catch(oh){};
