<?php
class clsMenusmartnavmenuMenuListHelpdesk extends clsMenu { //MenuListHelpdesk class @4-3FAB25D0

//Class_Initialize Event @4-3102B249
    function clsMenusmartnavmenuMenuListHelpdesk($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "MenuListHelpdesk";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu MenuListHelpdesk";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => "HOME", "item_url" => array("Page" => $this->RelativePath . "mainpage.php", "Parameters" => null), "item_target" => "", "item_title" => "Home");
        $this->StaticItems[] = array("item_id" => "MenuItem7", "item_id_parent" => null, "item_caption" => "Ticket List", "item_url" => array("Page" => $this->RelativePath . "ticketlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Ticket List");
        $this->StaticItems[] = array("item_id" => "MenuItem7Item1", "item_id_parent" => "MenuItem7", "item_caption" => "New Ticket", "item_url" => array("Page" => $this->RelativePath . "ticketdetails.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Register New Ticket");
        $this->StaticItems[] = array("item_id" => "MenuItem7Item2", "item_id_parent" => "MenuItem7", "item_caption" => "Ticket List", "item_url" => array("Page" => $this->RelativePath . "ticketlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Ticket List");
		$this->StaticItems[] = array("item_id" => "MenuItem7Item2", "item_id_parent" => "MenuItem7", "item_caption" => "Ticket Summary", "item_url" => array("Page" => $this->RelativePath . "ticketlistsum.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Ticket Smmary");
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => "Preventive Maintenance", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Preventive Maintenance");
		$this->StaticItems[] = array("item_id" => "MenuItem2Item1", "item_id_parent" => "MenuItem2", "item_caption" => "New PM", "item_url" => array("Page" => $this->RelativePath . "pmactivity.php", "Parameters" => null), "item_target" => "", "item_title" => "");
		$this->StaticItems[] = array("item_id" => "MenuItem2Item2s", "item_id_parent" => "MenuItem2", "item_caption" => "PM List", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem8", "item_id_parent" => null, "item_caption" => "Reports", "item_url" => array("Page" => $this->RelativePath . "reports.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => "Assignments & Activities", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem5Item1", "item_id_parent" => "MenuItem5", "item_caption" => "Calendar", "item_url" => array("Page" => $this->RelativePath . "calactivity.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Calendar Activities");
        $this->StaticItems[] = array("item_id" => "MenuItem5Item2", "item_id_parent" => "MenuItem5", "item_caption" => "Task Assignments", "item_url" => array("Page" => $this->RelativePath . "taskactivity.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Task Assignments");
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => "Spare Part", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "Spare Part");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item1", "item_id_parent" => "MenuItem3", "item_caption" => "Requisition List", "item_url" => array("Page" => $this->RelativePath . "smartpreq.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Requisition List");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item3", "item_id_parent" => "MenuItem3", "item_caption" => "Returned List", "item_url" => array("Page" => $this->RelativePath . "smartprtn.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Returned List");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item2", "item_id_parent" => "MenuItem3", "item_caption" => "Stocks", "item_url" => array("Page" => $this->RelativePath . "smartpstock.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Stocks");
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => "Workshop & Equipment", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "Workshop");
		$this->StaticItems[] = array("item_id" => "MenuItem11", "item_id_parent" => null, "item_caption" => "Maintenance & Loans", "item_url" => array("Page" => $this->RelativePath . "smartloan.php", "Parameters" => null), "item_target" => "", "item_title" => "Maintenance & Loans");
		$this->StaticItems[] = array("item_id" => "MenuItem6", "item_id_parent" => null, "item_caption" => "Damaged Passport", "item_url" => array("Page" => $this->RelativePath . "smartdp.php", "Parameters" => null), "item_target" => "", "item_title" => "Damaged Passport");
		$this->StaticItems[] = array("item_id" => "MenuItem9", "item_id_parent" => null, "item_caption" => "Site Info", "item_url" => array("Page" => $this->RelativePath . "smartsite.php", "Parameters" => null), "item_target" => "", "item_title" => "Site Info");
		$this->StaticItems[] = array("item_id" => "MenuItem10", "item_id_parent" => null, "item_caption" => "Site Report", "item_url" => array("Page" => $this->RelativePath . "smartsitereport.php", "Parameters" => null), "item_target" => "", "item_title" => "Site Report");

        $this->DataSource = new clssmartnavmenuMenuListHelpdeskDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);
        $this->Visible = (CCSecurityAccessCheck("5") == "success");

        $this->ItemLink = & new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("ccsForm","qryc","qryn","aprv","prcs","rtn","set","st","view","sid","uid","rf","GSmartPreventivePage","id","rid","pmid","tcktid","smart_ticketPage","s_state","s_branch","s_ref","s_sdate","s_edate","new","newrs","eq","msr","rplc","det","tid","s_svr","smart_ticketOrder","smart_ticketDir","mode","s_status","month","year","set","opt","type"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @4-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @4-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End MenuListHelpdesk Class @4-FCB6E20C

//smartnavmenuMenuListHelpdeskDataSource Class @4-EA1CF344
class clssmartnavmenuMenuListHelpdeskDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clssmartnavmenuMenuListHelpdeskDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu MenuListHelpdesk";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End smartnavmenuMenuListHelpdeskDataSource Class

class clsMenusmartnavmenuMenuListEngineer extends clsMenu { //MenuListEngineer class @16-94BC6EF4

//Class_Initialize Event @16-8CE1095F
    function clsMenusmartnavmenuMenuListEngineer($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "MenuListEngineer";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu MenuListEngineer";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem7", "item_id_parent" => null, "item_caption" => "HOME", "item_url" => array("Page" => $this->RelativePath . "mainpage.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => "Ticket List", "item_url" => array("Page" => $this->RelativePath . "ticketlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => "Preventive Maintenance", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem2Item2", "item_id_parent" => "MenuItem2", "item_caption" => "New PM", "item_url" => array("Page" => $this->RelativePath . "pmactivity.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem2Item1", "item_id_parent" => "MenuItem2", "item_caption" => "PM List", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => "Assignment & Activity", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem3Item1", "item_id_parent" => "MenuItem3", "item_caption" => "Calendar", "item_url" => array("Page" => $this->RelativePath . "calactivity.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem3Item2", "item_id_parent" => "MenuItem3", "item_caption" => "Task Assignments", "item_url" => array("Page" => $this->RelativePath . "taskactivity.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem6", "item_id_parent" => null, "item_caption" => "Reports", "item_url" => array("Page" => $this->RelativePath . "reports.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => "Spare Part", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => "Workshop & Equipment", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");

        $this->DataSource = new clssmartnavmenuMenuListEngineerDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);
		$this->Visible = (CCSecurityAccessCheck("3") == "success");

        $this->ItemLink = & new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("ccsForm","qryc","qryn","aprv","prcs","rtn","set","st","uid","GSmartPreventivePage","rf","id","rid","pmid","tcktid","smart_ticketPage","s_state","s_branch","s_ref","s_sdate","s_edate","new","newrs","eq","msr","rplc","det","tid","s_svr","smart_ticketOrder","smart_ticketDir","mode","s_status","month","year","set","opt","type"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @16-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @16-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End MenuListEngineer Class @16-FCB6E20C

//smartnavmenuMenuListEngineerDataSource Class @16-428D3E3B
class clssmartnavmenuMenuListEngineerDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clssmartnavmenuMenuListEngineerDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu MenuListEngineer";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End smartnavmenuMenuListEngineerDataSource Class

class clsMenusmartnavmenuMenuListAdmin extends clsMenu { //MenuListAdmin class @3-D32F331C

//Class_Initialize Event @3-178461DE
    function clsMenusmartnavmenuMenuListAdmin($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "MenuListAdmin";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu MenuListAdmin";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => "HOME", "item_url" => array("Page" => $this->RelativePath . "Admin/index.php", "Parameters" => null), "item_target" => "", "item_title" => "Home");
        $this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => "Tickets", "item_url" => array("Page" => $this->RelativePath . "Admin/AdmTicMngmt.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => "Preventive Maintenance", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Preventive Maintenance");
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => "Spare Part", "item_url" => array("Page" => $this->RelativePath . "smartspart.php", "Parameters" => null), "item_target" => "", "item_title" => "Spare Part");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item1", "item_id_parent" => "MenuItem3", "item_caption" => "Requisition List", "item_url" => array("Page" => $this->RelativePath . "smartpreq.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Requisition List");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item3", "item_id_parent" => "MenuItem3", "item_caption" => "Returned List", "item_url" => array("Page" => $this->RelativePath . "smartprtn.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Returned List");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item2", "item_id_parent" => "MenuItem3", "item_caption" => "Stocks", "item_url" => array("Page" => $this->RelativePath . "smartpstock.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Stocks");
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => "Workshop & Equipment", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "Workshop & Equipment");

        $this->DataSource = new clssmartnavmenuMenuListAdminDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);
        $this->Visible = (CCSecurityAccessCheck("1") == "success");

        $this->ItemLink = & new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("ccsForm","qryc","qryn","aprv","prcs","rtn","set","st","uid","rf","GSmartPreventivePage","id","rid","pmid","tcktid","smart_ticketPage","s_state","s_branch","s_ref","s_sdate","s_edate","new","newrs","eq","msr","rplc","det","tid","s_svr","smart_ticketOrder","smart_ticketDir","mode","s_status","month","year","set","opt","type"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @3-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @3-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End MenuListAdmin Class @3-FCB6E20C

//smartnavmenuMenuListAdminDataSource Class @3-A9FEDE55
class clssmartnavmenuMenuListAdminDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clssmartnavmenuMenuListAdminDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu MenuListAdmin";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End smartnavmenuMenuListAdminDataSource Class

class clsMenusmartnavmenuMenuListManager extends clsMenu { //MenuListManager class @68-8E180274

//Class_Initialize Event @68-F98457B6
    function clsMenusmartnavmenuMenuListManager($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "MenuListManager";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu MenuListManager";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => "HOME", "item_url" => array("Page" => $this->RelativePath . "mainpage.php", "Parameters" => null), "item_target" => "", "item_title" => "Home");
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => "Tickets", "item_url" => array("Page" => $this->RelativePath . "ticketlist.php", "Parameters" => null), "item_target" => "", "item_title" => "Tickets List");
		$this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => "Reports", "item_url" => array("Page" => $this->RelativePath . "reports.php", "Parameters" => null), "item_target" => "", "item_title" => "Reports");
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => "Preventive Maintenance", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "", "item_title" => "PM List");
        $this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => "Task History", "item_url" => array("Page" => $this->RelativePath . "taskhistory.php", "Parameters" => null), "item_target" => "", "item_title" => "Task History");

        $this->DataSource = new clssmartnavmenuMenuListManagerDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);
        $this->Visible = (CCSecurityAccessCheck("2") == "success");

        $this->ItemLink = & new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("ccsForm","qryc","qryn","aprv","prcs","rtn","set","st","uid","rf","GTaskHistoryPage","GSmartPreventivePage","id","rid","pmid","tcktid","smart_ticketPage","s_state","s_branch","s_ref","s_sdate","s_edate","new","newrs","eq","msr","rplc","det","tid","s_svr","smart_ticketOrder","smart_ticketDir","mode","s_status","month","year","set","opt","type"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @68-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @68-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End MenuListManager Class @68-FCB6E20C

//smartnavmenuMenuListManagerDataSource Class @68-076D903A
class clssmartnavmenuMenuListManagerDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clssmartnavmenuMenuListManagerDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu MenuListManager";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End smartnavmenuMenuListManagerDataSource Class

class clsMenusmartnavmenuMenuListInHouseEng extends clsMenu { //MenuListInHouseEng class @92-20DF8946

//Class_Initialize Event @92-9DFDB352
    function clsMenusmartnavmenuMenuListInHouseEng($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "MenuListInHouseEng";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu MenuListInHouseEng";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => "HOME", "item_url" => array("Page" => $this->RelativePath . "index.php", "Parameters" => null), "item_target" => "", "item_title" => "Home");
        $this->StaticItems[] = array("item_id" => "MenuItem7", "item_id_parent" => null, "item_caption" => "Ticket List", "item_url" => array("Page" => $this->RelativePath . "ticketlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Ticket List");
        $this->StaticItems[] = array("item_id" => "MenuItem7Item1", "item_id_parent" => "MenuItem7", "item_caption" => "New Ticket", "item_url" => array("Page" => $this->RelativePath . "ticketdetails.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Register New Ticket");
        $this->StaticItems[] = array("item_id" => "MenuItem7Item2", "item_id_parent" => "MenuItem7", "item_caption" => "Ticket List", "item_url" => array("Page" => $this->RelativePath . "ticketlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Ticket List");
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => "Preventive Maintenance", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Preventive Maintenance");
        $this->StaticItems[] = array("item_id" => "MenuItem8", "item_id_parent" => null, "item_caption" => "Report", "item_url" => array("Page" => $this->RelativePath . "smartreports.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => "Assignments & Activities", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem5Item1", "item_id_parent" => "MenuItem5", "item_caption" => "Calendar", "item_url" => array("Page" => $this->RelativePath . "calactivity.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Calendar Activities");
        $this->StaticItems[] = array("item_id" => "MenuItem5Item2", "item_id_parent" => "MenuItem5", "item_caption" => "Task Assignments", "item_url" => array("Page" => $this->RelativePath . "taskactivity.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Task Assignments");
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => "Spare Part", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "Spare Part");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item1", "item_id_parent" => "MenuItem3", "item_caption" => "Requisition List", "item_url" => array("Page" => $this->RelativePath . "smartpreq.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Requisition List");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item3", "item_id_parent" => "MenuItem3", "item_caption" => "Returned List", "item_url" => array("Page" => $this->RelativePath . "smartprtn.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Returned List");
		$this->StaticItems[] = array("item_id" => "MenuItem3Item2", "item_id_parent" => "MenuItem3", "item_caption" => "Stocks", "item_url" => array("Page" => $this->RelativePath . "smartpstock.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Stocks");
        $this->StaticItems[] = array("item_id" => "MenuItem9", "item_id_parent" => null, "item_caption" => "Maintenance & Loans", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "Maintenance & Loans");
		$this->StaticItems[] = array("item_id" => "MenuItem10", "item_id_parent" => null, "item_caption" => "Workshop & Equipment", "item_url" => array("Page" => $this->RelativePath . "smartworkshop.php", "Parameters" => null), "item_target" => "", "item_title" => "Workshop & Equipment");

        $this->DataSource = new clssmartnavmenuMenuListInHouseEngDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);
        $this->Visible = (CCSecurityAccessCheck("7") == "success");

        $this->ItemLink = & new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("ccsForm","qryc","qryn","aprv","prcs","rtn","set","st","view","uid","rf","GTaskHistoryPage","GSmartPreventivePage","id","rid","pmid","tcktid","smart_ticketPage","s_state","s_branch","s_ref","s_sdate","s_edate","new","newrs","eq","msr","rplc","det","tid","s_svr","smart_ticketOrder","smart_ticketDir","mode","s_status","month","year","set","opt","type"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @92-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @92-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End MenuListInHouseEng Class @92-FCB6E20C

//smartnavmenuMenuListInHouseEngDataSource Class @92-B1A99B69
class clssmartnavmenuMenuListInHouseEngDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clssmartnavmenuMenuListInHouseEngDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu MenuListInHouseEng";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End smartnavmenuMenuListInHouseEngDataSource Class

class clsMenusmartnavmenuMenuListSenior extends clsMenu { //MenuListSenior class @108-2B6FAA45

//Class_Initialize Event @108-D8353CE8
    function clsMenusmartnavmenuMenuListSenior($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "MenuListSenior";
        $this->Visible = True;
        $this->controls = array();
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->ErrorBlock = "Menu MenuListSenior";

        $this->StaticItems = array();
        $this->StaticItems[] = array("item_id" => "MenuItem7", "item_id_parent" => null, "item_caption" => "Home", "item_url" => array("Page" => $this->RelativePath . "mainpage.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem1", "item_id_parent" => null, "item_caption" => "Ticket List", "item_url" => array("Page" => $this->RelativePath . "ticketlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => "Preventive Maintenance", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem2Item2", "item_id_parent" => "MenuItem2", "item_caption" => "New PM", "item_url" => array("Page" => $this->RelativePath . "pmactivity.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem2Item1", "item_id_parent" => "MenuItem2", "item_caption" => "PM List", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem6", "item_id_parent" => null, "item_caption" => "Reports", "item_url" => array("Page" => $this->RelativePath . "smartreports.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => "Assignment & Activity", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem3Item1", "item_id_parent" => "MenuItem3", "item_caption" => "Calendar", "item_url" => array("Page" => $this->RelativePath . "calactivity.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem3Item2", "item_id_parent" => "MenuItem3", "item_caption" => "Task Assignments", "item_url" => array("Page" => $this->RelativePath . "taskactivity.php", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => "Spare Part", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => "Workshop & Equipment", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");

        $this->DataSource = new clssmartnavmenuMenuListSeniorDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);
        $this->Visible = (CCSecurityAccessCheck("4") == "success");

        $this->ItemLink = & new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("ccsForm","qryc","qryn","aprv","prcs","rtn","set","st","view","uid","rf","GTaskHistoryPage","GSmartPreventivePage","id","rid","pmid","tcktid","smart_ticketPage","s_state","s_branch","s_ref","s_sdate","s_edate","new","newrs","eq","msr","rplc","det","tid","s_svr","smart_ticketOrder","smart_ticketDir","mode","s_status","month","year","set","opt","type"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @108-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @108-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End MenuListSenior Class @108-FCB6E20C

//smartnavmenuMenuListSeniorDataSource Class @108-D243FD4E
class clssmartnavmenuMenuListSeniorDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clssmartnavmenuMenuListSeniorDataSource($parent) {
        $this->Parent = & $parent;
        $this->ErrorBlock = "Menu MenuListSenior";
        $this->ItemLink = new clsField("ItemLink", ccsText, "");
        $this->FieldsList["ItemLink"] = & $this->ItemLink;
    }

    function Prepare()
    {
    }

    function Open()
    {
        $this->query($this->Parent->StaticItems);
    }

    function SetValues()
    {
        $this->ItemLink->SetDBValue($this->f("item_caption"));
    }
}
//End smartnavmenuMenuListSeniorDataSource Class

class clssmartnavmenu { //smartnavmenu class @1-7CDEF82E

//Variables @1-9721D5A2
    var $ComponentType = "IncludablePage";
    var $Connections = array();
    var $FileName = "";
    var $Redirect = "";
    var $Tpl = "";
    var $TemplateFileName = "";
    var $BlockToParse = "";
    var $ComponentName = "";
    var $Attributes = "";

    // Events;
    var $CCSEvents = "";
    var $CCSEventResult = "";
    var $RelativePath;
    var $Visible;
    var $Parent;
//End Variables

//Class_Initialize Event @1-0F39E997
    function clssmartnavmenu($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "smartnavmenu.php";
        $this->Redirect = "";
        $this->TemplateFileName = "smartnavmenu.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-7776054D
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->MenuListHelpdesk);
        unset($this->MenuListEngineer);
        unset($this->MenuListAdmin);
        unset($this->MenuListManager);
        unset($this->MenuListInHouseEng);
        unset($this->MenuListSenior);
    }
//End Class_Terminate Event

//BindEvents Method @1-65526148
    function BindEvents()
    {
        $this->CCSEvents["AfterInitialize"] = "smartnavmenu_AfterInitialize";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-15A98A70
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->MenuListHelpdesk = & new clsMenusmartnavmenuMenuListHelpdesk($this->RelativePath, $this);
        $this->MenuListEngineer = & new clsMenusmartnavmenuMenuListEngineer($this->RelativePath, $this);
        $this->MenuListAdmin = & new clsMenusmartnavmenuMenuListAdmin($this->RelativePath, $this);
        $this->MenuListManager = & new clsMenusmartnavmenuMenuListManager($this->RelativePath, $this);
        $this->MenuListInHouseEng = & new clsMenusmartnavmenuMenuListInHouseEng($this->RelativePath, $this);
        $this->MenuListSenior = & new clsMenusmartnavmenuMenuListSenior($this->RelativePath, $this);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-3C8073E7
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->MenuListHelpdesk->Show();
        $this->MenuListEngineer->Show();
        $this->MenuListAdmin->Show();
        $this->MenuListManager->Show();
        $this->MenuListInHouseEng->Show();
        $this->MenuListSenior->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End smartnavmenu Class @1-FCB6E20C

//Include Event File @1-695B8327
include_once(RelativePath . "/smartnavmenu_events.php");
//End Include Event File


?>
