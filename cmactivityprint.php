<?php
define("RelativePath", ".");
define("PathToCurrentPage", "/");
include_once('fpdf/fpdf.php');
include_once(RelativePath . "/Common.php");
class pdf extends FPDF {
	var $B;
	var $I;
	var $U;
	var $HREF;

	function PDF($orientation='P',$unit='mm',$format='A4')
	{
		//Call parent constructor
		$this->FPDF($orientation,$unit,$format);
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';
	}

	function WriteHTML($html)
	{
		//HTML parser
		$html=str_replace("\n",' ',$html);
		$html=str_replace("&nbsp;",' ',$html);
		$html=str_replace("&quot;",'"',$html);
		$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e)
		{
			if($i%2==0)
			{
				//Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				else
					$this->Write(5,$e);
			}
			else
			{
				//Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else
				{
					//Extract attributes
					$a2=explode(' ',$e);
					$tag=strtoupper(array_shift($a2));
					$attr=array();
					foreach($a2 as $v)
					{
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])]=$a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}

	function OpenTag($tag,$attr)
	{
		//Opening tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF=$attr['HREF'];
		if($tag=='BR')
			$this->Ln(5);
	}

	function CloseTag($tag)
	{
		//Closing tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='A')
			$this->HREF='';
	}

	function SetStyle($tag,$enable)
	{
		//Modify style and select corresponding font
		$this->$tag+=($enable ? 1 : -1);
		$style='';
		foreach(array('B','I','U') as $s)
		{
			if($this->$s>0)
				$style.=$s;
		}
		$this->SetFont('',$style);
	}

	function PutLink($URL,$txt)
	{
		//Put a hyperlink
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}
}
$pdf = new PDF();
$db = new clsDBSMART();
$SQL = "SELECT Date, RefNumber, Title, Content FROM doc_template WHERE Type=" . CCGetParam("did");
$db->query($SQL);
$Result = $db->next_record();
if ($Result) {
	CCSetSession("Date", "Tarikh :".$db->f("Date"));
	CCSetSession("RefNumber", "Rujukan :".$db->f("RefNumber"));
	CCSetSession("Title", $db->f("Title"));
	CCSetSession("Content", $db->f("Content"));
}
$content = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="Styles/smartStyleTurqoise/Style_printing.css">
</head>

<body><table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="62"><img src="images/banner2.gif" width="61" height="57"></td>
          <td><div id="logoHeader">TECHNOLOGY ASIAN RESOURCES - GET SDN BHD</div>
			  <div id="logoHeaderSmall">C-19-05, Dataran 32, No. 2, Jalan 19/1, 46300 Petaling Jaya, Selangor<br>
              Tel: 03-7968 2225 | Fax: 03-7958 2211 | E-mail: support@target.net.my</div>
            </td>
        </tr>
      </table></td>
    <td width="50%" id="logoHeader"><div align="right">SERVICE NO. : XXXXXX </div></td>
  </tr>
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
          <td colspan="2" id="HeadTitle">MAINTENANCE WORKSHEET</td>
        </tr>
        <tr> 
          <td width="30%">LOCATION/CODE</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
        <tr> 
          <td>REPORT DATE</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
        <tr> 
          <td>SERVICE DATE</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
        <tr> 
          <td>TICKET NO.</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
      </table></td>
    <td>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
          <td width="30%">SERVICE TYPE</td>
          <td class="tdBordered"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td>PREVENTIVE</td>
                <td width="10%" class="tdBordered">&nbsp;</td>
                <td>CORRECTIVE</td>
                <td width="10%" class="tdBordered">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td>ARRIVAL TIME</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
        <tr> 
          <td>DEPARTURE TIME</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
        <tr> 
          <td>CUSTOMER</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
        <tr> 
          <td>CONTACT NO.</td>
          <td class="tdBordered">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2" id="HeadTitleTdColored">ACTIVITIES</td>
  </tr>
  <tr> 
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td class="tdHeader">EQUIPMENT</td>
          <td class="tdHeader">SERIAL NUMBER</td>
        </tr>
        <tr> 
          <td class="tdContent">&nbsp;</td>
          <td class="tdContent">&nbsp;</td>
        </tr>
      </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td class="tdHeader" width="30%">MEASURE</td>
          <td class="tdHeader" width="10%">BEFORE</td>
          <td class="tdHeader" width="10%">AFTER</td>
          <td class="tdHeader">REMARKS</td>
        </tr>
        <tr> 
          <td class="tdContent">&nbsp;</td>
          <td class="tdContent">&nbsp;</td>
          <td class="tdContent">&nbsp;</td>
          <td class="tdContent">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td id="HeadTitleTdColored">PROBLEM / INSPECTION</td>
    <td id="HeadTitleTdColored">ACTION TAKEN</td>
  </tr>
  <tr> 
    <td class="tdBordered">&nbsp;</td>
    <td class="tdBordered">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" id="HeadTitleTdColored">PARTS REPLACEMENT</td>
  </tr>
  <tr> 
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td class="tdHeader" width="5%">NO.</td>
          <td class="tdHeader" width="30%">PART NAME</td>
          <td class="tdHeader" width="20%">SERIAL NUMBER</td>
          <td class="tdHeader">REMARKS</td>
        </tr>
        <tr> 
          <td class="tdContent">&nbsp;</td>
          <td class="tdContent">&nbsp;</td>
          <td class="tdContent">&nbsp;</td>
          <td class="tdContent">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td id="HeadTitleTdColored">FOLLOW UP ACTION</td>
    <td id="HeadTitleTdColored">RESULT</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
          <td class="tdBold">1ST TAR-GET ENGINEER</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>Signature:</td>
        </tr>
        <tr>
          <td>Name:</td>
        </tr>
      </table></td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
          <td class="tdBold">CUSTOMER COMMENTS:</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
          <td class="tdBold">2ND TAR-GET ENGINEER</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>Signature:</td>
        </tr>
        <tr>
          <td>Name:</td>
        </tr>
      </table></td>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
          <td class="tdBold">CLIENT OFFICE REPRESENTATIVE</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>Signature:</td>
        </tr>
        <tr> 
          <td>Name:</td>
        </tr>
        <tr> 
          <td>Designation:</td>
        </tr>
        <tr>
          <td>Date:</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>'; 
$pdf->SetFont('Arial', '', 11);
$pdf->SetFont('');
$pdf->AddPage();
$pdf->SetMargins(500,50,20);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->WriteHTML("adda<br>".$content);
$pdf->Output();


?>