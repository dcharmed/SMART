<?php

class clsMenumenunavbarMenuListHelpdesk extends clsMenu { //MenuListHelpdesk class @25-1890C6F4

//Class_Initialize Event @25-D2C3FFF6
    function clsMenumenunavbarMenuListHelpdesk($RelativePath, & $Parent)
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
        $this->StaticItems[] = array("item_id" => "MenuItem2", "item_id_parent" => null, "item_caption" => "Preventive Maintenance", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Preventive Maintenance");
		$this->StaticItems[] = array("item_id" => "MenuItem2Item1", "item_id_parent" => "MenuItem2", "item_caption" => "New PM", "item_url" => array("Page" => $this->RelativePath . "pmactivity.php", "Parameters" => null), "item_target" => "_self", "item_title" => "New PM");
        $this->StaticItems[] = array("item_id" => "MenuItem2Item2", "item_id_parent" => "MenuItem2", "item_caption" => "PM List", "item_url" => array("Page" => $this->RelativePath . "pmlist.php", "Parameters" => null), "item_target" => "_self", "item_title" => "PM List");
		$this->StaticItems[] = array("item_id" => "MenuItem5", "item_id_parent" => null, "item_caption" => "Assignments & Activities", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "");
        $this->StaticItems[] = array("item_id" => "MenuItem5Item1", "item_id_parent" => "MenuItem5", "item_caption" => "Calendar", "item_url" => array("Page" => $this->RelativePath . "calactivity.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Calendar Activities");
        $this->StaticItems[] = array("item_id" => "MenuItem5Item2", "item_id_parent" => "MenuItem5", "item_caption" => "Task Assignments", "item_url" => array("Page" => $this->RelativePath . "taskactivity.php", "Parameters" => null), "item_target" => "_self", "item_title" => "Task Assignments");
        $this->StaticItems[] = array("item_id" => "MenuItem3", "item_id_parent" => null, "item_caption" => "Spare Part", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "Spare Part");
        $this->StaticItems[] = array("item_id" => "MenuItem4", "item_id_parent" => null, "item_caption" => "Workshop", "item_url" => array("Page" => $this->RelativePath . "#", "Parameters" => null), "item_target" => "", "item_title" => "Workshop");
		$this->StaticItems[] = array("item_id" => "MenuItem6", "item_id_parent" => null, "item_caption" => "Reports", "item_url" => array("Page" => $this->RelativePath . "smartreports.php", "Parameters" => null), "item_target" => "", "item_title" => "Reports");

        $this->DataSource = new clsmenunavbarMenuListHelpdeskDataSource($this);
        $this->ds = & $this->DataSource;
        $this->DataSource->SetProvider(array("DBLib" => "Array"));

        parent::clsMenu("item_id_parent", "item_id", null);

        $this->ItemLink = & new clsControl(ccsLink, "ItemLink", "ItemLink", ccsText, "", CCGetRequestParam("ItemLink", ccsGet, NULL), $this);
        $this->controls["ItemLink"] = & $this->ItemLink;
        $this->ItemLink->Parameters = CCGetQueryString("QueryString", array("ccsForm","GSmartTaskOrder","GSmartTaskDir","new","tcktid","tid","rid","id","cid","s_state","s_branch","s_ref","s_sdate","s_edate","ftype","state"));
        $this->ItemLink->Page = "";
        $this->LinkStartParameters = $this->ItemLink->Parameters;
    }
//End Class_Initialize Event

//SetControlValues Method @25-B7BF812B
    function SetControlValues() {
        $this->ItemLink->SetValue($this->DataSource->ItemLink->GetValue());
        $LinkUrl = $this->DataSource->f("item_url");
        $this->ItemLink->Page = $LinkUrl["Page"];
        $this->ItemLink->Parameters = $this->SetParamsFromDB($this->LinkStartParameters, $LinkUrl["Parameters"]);
    }
//End SetControlValues Method

//ShowAttributes @25-17684C76
    function ShowAttributes() {
        $this->Attributes->SetValue("MenuType", "menu_htb");
        $this->Attributes->Show();
    }
//End ShowAttributes

} //End MenuListHelpdesk Class @25-FCB6E20C

//menunavbarMenuListHelpdeskDataSource Class @25-E29FABDA
class clsmenunavbarMenuListHelpdeskDataSource extends DB_Adapter {
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;
    var $wp;
    var $Record = array();
    var $Index;
    var $FieldsList = array();

    function clsmenunavbarMenuListHelpdeskDataSource($parent) {
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
//End menunavbarMenuListHelpdeskDataSource Class

class clsmenunavbar { //menunavbar class @1-7BC5D73E

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

//Class_Initialize Event @1-C0694D65
    function clsmenunavbar($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "menunavbar.php";
        $this->Redirect = "";
        $this->TemplateFileName = "menunavbar.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "CP1252";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-844E98B5
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->MenuListHelpdesk);
    }
//End Class_Terminate Event

//BindEvents Method @1-0DAD0D56
    function BindEvents()
    {
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

//Initialize Method @1-151BD6C9
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
        $this->MenuHelpdesk = & new clsPanel("MenuHelpdesk", $this);
        $this->MenuListHelpdesk = & new clsMenumenunavbarMenuListHelpdesk($this->RelativePath, $this);
        $this->MenuHelpdesk->AddComponent("MenuListHelpdesk", $this->MenuListHelpdesk);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-20D186AC
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
        $this->MenuHelpdesk->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End menunavbar Class @1-FCB6E20C


?>
