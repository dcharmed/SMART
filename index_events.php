<?php
//BindEvents Method @1-3BD301E3
function BindEvents()
{
    global $loginForm;
    global $CCSEvents;
    $loginForm->Button_DoLogin->CCSEvents["OnClick"] = "loginForm_Button_DoLogin_OnClick";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//loginForm_Button_DoLogin_OnClick @46-C7DDF709
function loginForm_Button_DoLogin_OnClick(& $sender)
{
    $loginForm_Button_DoLogin_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $loginForm; //Compatibility
//End loginForm_Button_DoLogin_OnClick

//Login @47-430B5142
    global $CCSLocales;
    global $Redirect;
    if ($Container->autoLogin->Value != $Container->autoLogin->CheckedValue) {
        CCSetCookie("SMARTLogin", "");
    }
    if ( !CCLoginUser( $Container->login->Value, $Container->password->Value)) {
        $Container->Errors->addError($CCSLocales->GetText("CCS_LoginError"));
        $Container->password->SetValue("");
        $loginForm_Button_DoLogin_OnClick = 0;
        CCSetCookie("SMARTLogin", "");
    } else {
	
        if ($Container->autoLogin->Value == $Container->autoLogin->CheckedValue) {
            $ALLogin    = $Container->login->Value;
            $ALPassword = $Container->password->Value;
            CCSetALCookie($ALLogin, $ALPassword);
        }
		SetLoggedTime(CCGetSession("UserID"));
		LogActivity(CCGetSession("UserLogin"),"LOGIN","","Successfully Logged-in to SMART",date('Y-m-d H:i:s'));
		switch(CCGetSession("GroupID")) {
			case 1:
				$Redirect = "Admin/index.php";
				break;
			default :
				$Redirect = "mainpage.php";
				break;
		}
        //$Redirect = CCGetParam("ret_link", $Redirect);
        $loginForm_Button_DoLogin_OnClick = 1;
    }
//End Login

//Close loginForm_Button_DoLogin_OnClick @46-3FCD28F8
    return $loginForm_Button_DoLogin_OnClick;
}
//End Close loginForm_Button_DoLogin_OnClick

//Page_AfterInitialize @1-12769A36
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $index; //Compatibility
//End Page_AfterInitialize

//Custom Code @52-2A29BDB7
// -------------------------
    if(CCGetParam("Logout")=="True") {
		CCLogoutUser();
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize
?>
