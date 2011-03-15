if (typeof window.AjaxPanelEvents == "undefined") window.AjaxPanelEvents = [];
window.AjaxPanel = AjaxPanel = {
    init: function(panel, pageName) {
    AjaxPanel.callEvent(panel.id, "beforeInitialize");
        if (panel.filterId == null) {
            panel.filterId = panel.id;
        }
        panel.location = window.location.toString();
        panel.href = panel.location;
        if (panel.href.match(/\/$/)) {
            panel.href += pageName;
            panel.location += pageName;
        }
        AjaxPanel.callEvent(panel.id, "afterInitialize");
    },

    reload: function(panel) {
        if (!panel.location)
            return;
        var requestUrl = panel.location;
        requestUrl = AjaxPanel._addParam(requestUrl, "FormFilter", panel.filterId);
        AjaxPanel._showProgress();
        AjaxPanel.callEvent(panel.id, "beforeReload");
        new Ajax.Request(requestUrl, {
            method: 'get',
            requestHeaders: ['If-Modified-Since', new Date(0)],
            onSuccess: function(transport) {
                panel.location = requestUrl;
                AjaxPanel._update(panel, transport.responseText);
                AjaxPanel.callEvent(panel.id, "afterReload");
                AjaxPanel._hideProgress();
                if (Prototype.Browser.IE)
                    document.fireEvent("onreadystatechange");
            }
        });
    },

    _bind: function(panel) {
	AjaxPanel.callEvent(panel.id, "beforeBind");
        var links = $$("#" + panel.id + " a");
        var inputs = $$("#" + panel.id + " input");
        var forms = $$("#" + panel.id + " form");
        for (var i = 0; i < links.length; i++) {
            var link = links[i];
            if (link.target == "" || link.target.toLowerCase() == "_self")
            if (AjaxPanel._matchPages(panel.href, link.href)) {
                link.panel = panel;
                link.onclick = function() { return false; }
                link.observe("click", AjaxPanel._linkClick);
            }
        }
        for (var i = 0; i < forms.length; i++) {
            var currentForm = forms[i];
            currentForm.panel = panel;
            currentForm.firstInput = null;
            var inputs = currentForm.getElementsByTagName('input');
            for (var j = 0; j < inputs.length; j++) {
                var input = inputs[j];
                if (input.type != null && (input.type.toLowerCase() == "submit" || input.type.toLowerCase() == "image")) {
                    if (currentForm.firstInput == null) {
                        currentForm.firstInput = input;
                    }
                    input.panel = panel;
                    input.observe("click", AjaxPanel._inputClick);
                }
            }
                var existingSubmit = currentForm.onsubmit ? currentForm.onsubmit : function() {};
                currentForm.onsubmit = function() {
                    if (existingSubmit.apply(this) != false) {
						try {
							if (typeof(FCKeditorAPI) == "object") {
								var textareas = this.getElementsByTagName("textarea");
								for (var t = 0; t < textareas.length; t++) {
									var textareaId = textareas[t].getAttribute("id");
									if (textareaId && textareaId != "") {
										var fckInstance = FCKeditorAPI.GetInstance(textareaId);
										if (fckInstance) 
											fckInstance.UpdateLinkedField();
									}
								}
							}
						} 
						catch (err) {
						}
						AjaxPanel._submitForm(this);
					}
					return false;
                }

        }
        if(panel.onrefresh) {
            panel.onrefresh.apply(panel);
        }
	AjaxPanel.callEvent(panel.id, "afterBind");
    },

    _inputClick: function(event) {
        var sender = Event.element(event);
        sender.form.lastClick = sender;
    },

    _submitForm: function(form) {
        if (form != null) {
            AjaxPanel._showProgress();
            var submitButton = false;
            if (form.lastClick) {
                submitButton = form.lastClick.name;
            } else if (form.firstInput){
                submitButton = form.firstInput.name;
            }
            var method = "post";
            if (form.hasAttribute('method')) {
              method = form.method;
            }
            var action = form.readAttribute('action') || '';
            if (action.blank()) action = form.panel.location;
            if (method == "get" && action.indexOf("?") != -1) {
                action = action.substring(0, action.indexOf("?"));
            }
            action = AjaxPanel._addParam(action, "FormFilter", form.panel.filterId);
            var formInputs = $A($(form).getElementsByTagName('*')).inject([],
                function(elements, child) {
                    if (Form.Element.Serializers[child.tagName.toLowerCase()]) {
                        if (!child.type || (child.type != "image" && child.type != "submit") || submitButton == child.name) {
                            elements.push(Element.extend(child));
                        }
                    }
                    return elements;
                }
            );
            var parameters = Form.serializeElements(formInputs, {submit: submitButton});
            
            new Ajax.Request(action, {
                method: method,
                requestHeaders: ['If-Modified-Since', new Date(0)],
                parameters: parameters,
                onSuccess: function(transport) {
                    form.panel.location = action;
                    AjaxPanel._update(form.panel, transport.responseText);
                    AjaxPanel._hideProgress();
                    if (Prototype.Browser.IE)
                        document.fireEvent("onreadystatechange");
                }
            });
        }
        return false;
    },

    _linkClick: function(event) {
        var sender = Event.element(event);
        while (!sender.panel) sender = sender.parentNode;
        if (sender.href.indexOf("javascript:") == 0)
            return false;
        var getUrl = AjaxPanel._addParam(sender.href, "FormFilter", sender.panel.filterId);
        AjaxPanel._showProgress();
        new Ajax.Request(getUrl, {
            method: "get",
            requestHeaders: ['If-Modified-Since', new Date(0)],
            onSuccess: function(transport) {
                sender.panel.location = getUrl;
                AjaxPanel._update(sender.panel, transport.responseText);
                AjaxPanel._hideProgress();
                if (Prototype.Browser.IE)
                    document.fireEvent("onreadystatechange");
            }
        });
        return false;
    },

    _update: function(panel, content) {
    	AjaxPanel.callEvent(panel.id, "beforeUpdate");
        // IE removes a <script> tag if it goes first, so we should add something before it
        if ((new RegExp("^<script", "m")).test(content)) content = "<span style='display:none;'>&nbsp;</span>" + content;
        $(panel.id).innerHTML = content;
        var scrs = $(panel.id).getElementsByTagName('script');
        // if there is a javascript inside a HTML comment IE will not exec this script
        var re1 = /^\s*<!--/m, re2 = /-->\s*$/m;
        for(var i = 0; i < scrs.length; i++){
             eval(scrs[i].innerHTML.replace(re1, "").replace(re2, ""));
        }
        AjaxPanel._bind(panel);
        try {
            eval(panel.id + "_bind();");
        } catch(e) {};
        AjaxPanel.callEvent(panel.id, "afterUpdate");
    },

    _matchPages: function(pageUrl, linkUrl) {
        if (linkUrl == null || linkUrl == "#" || linkUrl == "") { return false; }
        if (AjaxPanel._getScriptPath(pageUrl).toLowerCase() == AjaxPanel._getScriptPath(linkUrl).toLowerCase()) {
            return true;
        }
        return false;
    },

    _getScriptPath: function(fullUrl) {
        var questPos = fullUrl.indexOf("?");
        if (questPos == -1) { return fullUrl };
        return fullUrl.substring(0, questPos);
    },

    _showProgress: function() {
        if ($("AjaxPanelProgress") != null) {
            return false;
        }
        var progressSpan = document.createElement("div");
        progressSpan.style.position = "absolute";
        progressSpan.style.zIndex = 1000;
        progressSpan.style.top = "3px";
        progressSpan.style.right = "3px";
        progressSpan.id = "AjaxPanelProgress";
        progressSpan.innerHTML = "<div style=\"background-color: #D33333; font-family: Tahoma; font-size: 8pt; padding:1px; color: #FFFFFF;\">&nbsp;Loading...&nbsp;</div>";
        document.body.appendChild(progressSpan);
    },

    _hideProgress: function() {
        if ($("AjaxPanelProgress") == null) {
            return false;
        }
        document.body.removeChild($("AjaxPanelProgress"));
    },

    _addParam: function(queryStr, paramName, paramValue) {
        queryStr = decodeURI(queryStr);
        queryStr = queryStr.replace(/\+/g, " ");
        var queryParts = queryStr.split("?");
        var params = new Hash();
        if (queryParts.length > 1) {
            params = new Hash(queryStr.toQueryParams());
        }
        params.set(paramName, paramValue);
        return queryParts[0] + "?" + params.toQueryString();
    },

    _removeParam: function(queryStr, paramName) {
        var queryParts = queryStr.split("?");
        var params = new Hash();
        if (queryParts.length > 1) {
            params = new Hash(queryStr.toQueryParams());
            params.unset(paramName);
        }
        return queryParts[0] + "?" + params.toQueryString();
    },
    
    callEvent: function (panelId, eventName) {
    	for (var i = 0; i < window.AjaxPanelEvents.length; i++) {
    		if (eventName == window.AjaxPanelEvents[i].eventName) {
    			window.AjaxPanelEvents[i].func($(panelId));
    		}
    	}
    }
}
