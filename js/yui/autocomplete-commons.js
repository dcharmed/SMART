function initAutocomplete(controlId, serviceUrl)
{
    function createAutocomplete(id, serviceUrl)
    {
        function createSpanIfNotExists(id, parent)
        {
            var control;
            if (!(control = document.getElementById(id)))
            {
                control = document.createElement("div");
                control.setAttribute("id", id);
                parent.appendChild(control);
            }
            control.className = controlId + "_container";
        }
        var autocomplete_ds = new YAHOO.widget.DS_XHR(serviceUrl, ["Result", "0"]);
        autocomplete_ds.queryMatchContains = true;
        createSpanIfNotExists(id + "_container", document.getElementById(id).parentNode);
        autocomplete = new YAHOO.widget.AutoComplete(id, id + '_container', autocomplete_ds);
        autocomplete.highlightClassName = "YUIAutcompleteHighlight";
        autocomplete.prehighlightClassName = "YUIAutcompletePreHighlight";
        autocomplete.doBeforeExpandContainer = function(oTextbox, oContainer, sQuery, aResults) {
            var pos = YAHOO.util.Dom.getXY(oTextbox);
            pos[1] += YAHOO.util.Dom.get(oTextbox).offsetHeight;
            YAHOO.util.Dom.setXY(oContainer,pos);
            return true;
        };
    }
    
    if (document.getElementById(controlId))
        createAutocomplete(controlId, serviceUrl);
    var i = 0;
    while (document.getElementById(controlId + "_" + (++i)))
        createAutocomplete(controlId + "_" + i, serviceUrl);
}



