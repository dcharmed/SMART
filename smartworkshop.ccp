<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="smartheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_workshop" name="GEquipmentList" pageSizeLimit="100" wizardCaption="List of Smart Workshop " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
<Components>
<Label id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GEquipmentListlblNumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_serial" fieldSource="wkshp_serial" wizardCaption="Wkshp Serial" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentListwkshp_serial">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="21" fieldSourceType="DBColumn" dataType="Date" html="False" name="wkshp_date" fieldSource="wkshp_date" wizardCaption="Wkshp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentListwkshp_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_donumber" fieldSource="wkshp_donumber" wizardCaption="Wkshp Donumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentListwkshp_donumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_equipment" fieldSource="wkshp_equipment" wizardCaption="Wkshp Equipment" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentListwkshp_equipment">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_mtn_serialnumber" fieldSource="wkshp_mtn_serialnumber" wizardCaption="Wkshp Mtn Serialnumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentListwkshp_mtn_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_loan_serialnumber" fieldSource="wkshp_loan_serialnumber" wizardCaption="Wkshp Loan Serialnumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentListwkshp_loan_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_requestedby" fieldSource="wkshp_requestedby" wizardCaption="Wkshp Requestedby" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentListwkshp_requestedby">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="27" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
<ImageLink id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GEquipmentListImageLink1" hrefSource="smartworkshop.ccp">
<Components/>
<Events/>
<LinkParameters>
<LinkParameter id="29" sourceType="Expression" format="yyyy-mm-dd" name="new" source="1"/>
</LinkParameters>
<Attributes/>
<Features/>
</ImageLink>
</Components>
<Events>
<Event name="BeforeShowRow" type="Server">
<Actions>
<Action actionName="Set Row Style" actionCategory="General" id="18" styles="Row;AltRow" name="rowStyle"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="wkshp_serial" parameterSource="s_wkshp_serial" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="wkshp_equipment" parameterSource="s_wkshp_equipment" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="wkshp_date" parameterSource="s_wkshp_date" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="3"/>
<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="wkshp_benchmarkdate" parameterSource="s_wkshp_benchmarkdate" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="4"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SEquipment" wizardCaption="Search Smart Workshop " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="smartworkshop.ccp" PathID="SEquipment" pasteActions="pasteActions">
<Components>
<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SEquipmentButton_DoSearch">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_wkshp_serial" wizardCaption="Wkshp Serial" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="SEquipments_wkshp_serial">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_wkshp_date" wizardCaption="Wkshp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" PathID="SEquipments_wkshp_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="11" name="DatePicker_s_wkshp_date" control="s_wkshp_date" wizardSatellite="True" wizardControl="s_wkshp_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="SEquipmentDatePicker_s_wkshp_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<ListBox id="9" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_wkshp_equipment" wizardCaption="Wkshp Equipment" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SEquipments_wkshp_equipment" connection="SMART" dataSource="smart_equipment" boundColumn="eqpmt_code" textColumn="eqpmt_name">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_wkshp_benchmarkdate" wizardCaption="Wkshp Benchmarkdate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" PathID="SEquipments_wkshp_benchmarkdate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="13" name="DatePicker_s_wkshp_benchmarkdate" control="s_wkshp_benchmarkdate" wizardSatellite="True" wizardControl="s_wkshp_benchmarkdate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="SEquipmentDatePicker_s_wkshp_benchmarkdate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
</Components>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<ISPParameters/>
<ISQLParameters/>
<IFormElements/>
<USPParameters/>
<USQLParameters/>
<UConditions/>
<UFormElements/>
<DSPParameters/>
<DSQLParameters/>
<DConditions/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Record>
<Record id="30" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="REquipmentForm" dataSource="smart_workshop" errorSummator="Error" wizardCaption="Add/Edit Smart Workshop " wizardFormMethod="post" PathID="REquipmentForm" pasteActions="pasteActions">
<Components>
<Button id="31" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="REquipmentFormButton_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="32" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="REquipmentFormButton_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="33" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonDeleteOn" PathID="REquipmentFormButton_Delete">
<Components/>
<Events>
<Event name="OnClick" type="Client">
<Actions>
<Action actionName="Confirmation Message" actionCategory="General" id="34" message="Delete record?"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Button>
<Button id="35" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="REquipmentFormButton_Cancel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wkshp_serial" fieldSource="wkshp_serial" required="False" caption="Wkshp Serial" wizardCaption="Wkshp Serial" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_serial">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="wkshp_date" fieldSource="wkshp_date" required="True" caption="Wkshp Date" wizardCaption="Wkshp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_date" format="GeneralDate" defaultValue="CurrentDateTime">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="40" name="DatePicker_wkshp_date" control="wkshp_date" wizardSatellite="True" wizardControl="wkshp_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="REquipmentFormDatePicker_wkshp_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="wkshp_benchmarkdate" fieldSource="wkshp_benchmarkdate" required="True" caption="Wkshp Benchmarkdate" wizardCaption="Wkshp Benchmarkdate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_benchmarkdate" format="GeneralDate" defaultValue="CurrentDate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="42" name="DatePicker_wkshp_benchmarkdate" control="wkshp_benchmarkdate" wizardSatellite="True" wizardControl="wkshp_benchmarkdate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="REquipmentFormDatePicker_wkshp_benchmarkdate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<ListBox id="44" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="wkshp_equipment" fieldSource="wkshp_equipment" required="True" caption="Wkshp Equipment" wizardCaption="Wkshp Equipment" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="REquipmentFormwkshp_equipment" connection="SMART" dataSource="smart_equipment" boundColumn="eqpmt_code" textColumn="eqpmt_name">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<ListBox id="45" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="wkshp_eq_origin" fieldSource="wkshp_eq_origin" required="True" caption="Wkshp Eq Origin" wizardCaption="Wkshp Eq Origin" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="REquipmentFormwkshp_eq_origin" connection="SMART" dataSource="smart_site" boundColumn="site_code" textColumn="site_code" orderBy="site_code">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="68" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<TextBox id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wkshp_mtn_serialnumber" fieldSource="wkshp_mtn_serialnumber" required="False" caption="Wkshp Mtn Serialnumber" wizardCaption="Wkshp Mtn Serialnumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_mtn_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="47" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wkshp_loan_serialnumber" fieldSource="wkshp_loan_serialnumber" required="False" caption="Wkshp Loan Serialnumber" wizardCaption="Wkshp Loan Serialnumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_loan_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<ListBox id="48" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="wkshp_eq_location" fieldSource="wkshp_eq_location" required="False" caption="Wkshp Eq Location" wizardCaption="Wkshp Eq Location" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="REquipmentFormwkshp_eq_location" connection="SMART" dataSource="smart_site" boundColumn="site_code" textColumn="site_name" orderBy="site_code">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="69" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<RadioButton id="49" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" returnValueType="Number" name="wkshp_eq_deliverymethod" fieldSource="wkshp_eq_deliverymethod" required="False" caption="Wkshp Eq Deliverymethod" wizardCaption="Wkshp Eq Deliverymethod" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_eq_deliverymethod" connection="SMART" _valueOfList="2" _nameOfList="BY COURIER" dataSource="1;BY HAND;2;BY COURIER">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</RadioButton>
<TextArea id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="wkshp_remark" fieldSource="wkshp_remark" required="False" caption="Wkshp Remark" wizardCaption="Wkshp Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="REquipmentFormwkshp_remark">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
<RadioButton id="38" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" returnValueType="Number" name="wkshp_request" fieldSource="wkshp_request" required="True" caption="Wkshp Request" wizardCaption="Wkshp Request" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_request" connection="SMART" _valueOfList="2" _nameOfList="OUT" dataSource="1;IN;2;OUT">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</RadioButton>
<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wkshp_donumber" fieldSource="wkshp_donumber" required="False" caption="Wkshp Donumber" wizardCaption="Wkshp Donumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_donumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="66" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="TextBox1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="REquipmentFormTextBox1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<ListBox id="67" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wkshp_deliveredcourier" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="REquipmentFormwkshp_deliveredcourier" sourceType="Table" fieldSource="wkshp_deliveredcourier">
<Components/>
<Events/>
<Attributes/>
<Features/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
</ListBox>
<ListBox id="53" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="wkshp_requestedby" fieldSource="wkshp_requestedby" required="False" caption="Wkshp Requestedby" wizardCaption="Wkshp Requestedby" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="REquipmentFormwkshp_requestedby" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_username">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<TextBox id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="wkshp_requesteddate" fieldSource="wkshp_requesteddate" required="False" caption="Wkshp Requesteddate" wizardCaption="Wkshp Requesteddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_requesteddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="55" name="DatePicker_wkshp_requesteddate" control="wkshp_requesteddate" wizardSatellite="True" wizardControl="wkshp_requesteddate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="REquipmentFormDatePicker_wkshp_requesteddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<ListBox id="56" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="wkshp_receivedby" fieldSource="wkshp_receivedby" required="False" caption="Wkshp Receivedby" wizardCaption="Wkshp Receivedby" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="REquipmentFormwkshp_receivedby" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_username">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<TextBox id="57" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="wkshp_receiveddate" fieldSource="wkshp_receiveddate" required="False" caption="Wkshp Receiveddate" wizardCaption="Wkshp Receiveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_receiveddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="58" name="DatePicker_wkshp_receiveddate" control="wkshp_receiveddate" wizardSatellite="True" wizardControl="wkshp_receiveddate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="REquipmentFormDatePicker_wkshp_receiveddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<ListBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="wkshp_authorizedby" fieldSource="wkshp_authorizedby" required="False" caption="Wkshp Authorizedby" wizardCaption="Wkshp Authorizedby" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_authorizedby" sourceType="Table" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_username">
<Components/>
<Events/>
<Attributes/>
<Features/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
</ListBox>
<TextBox id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="wkshp_authorizeddate" fieldSource="wkshp_authorizeddate" required="False" caption="Wkshp Authorizeddate" wizardCaption="Wkshp Authorizeddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_authorizeddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="61" name="DatePicker_wkshp_authorizeddate" control="wkshp_authorizeddate" wizardSatellite="True" wizardControl="wkshp_authorizeddate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="REquipmentFormDatePicker_wkshp_authorizeddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<ListBox id="50" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="wkshp_deliveredby" fieldSource="wkshp_deliveredby" required="False" caption="Wkshp Deliveredby" wizardCaption="Wkshp Deliveredby" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="REquipmentFormwkshp_deliveredby" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_username">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<TextBox id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="wkshp_delivereddate" fieldSource="wkshp_delivereddate" required="False" caption="Wkshp Delivereddate" wizardCaption="Wkshp Delivereddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="REquipmentFormwkshp_delivereddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="52" name="DatePicker_wkshp_delivereddate" control="wkshp_delivereddate" wizardSatellite="True" wizardControl="wkshp_delivereddate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="REquipmentFormDatePicker_wkshp_delivereddate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
</Components>
<Events>
<Event name="AfterInsert" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="85"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<ISPParameters/>
<ISQLParameters/>
<IFormElements/>
<USPParameters/>
<USQLParameters/>
<UConditions/>
<UFormElements/>
<DSPParameters/>
<DSQLParameters/>
<DConditions/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Record>
<Grid id="70" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_workshop" name="GEquipmentRelated" pageSizeLimit="100" wizardCaption="List of Smart Workshop " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
<Components>
<Label id="71" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_request" fieldSource="wkshp_request" wizardCaption="Wkshp Request" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_request">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="72" fieldSourceType="DBColumn" dataType="Date" html="False" name="wkshp_date" fieldSource="wkshp_date" wizardCaption="Wkshp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="73" fieldSourceType="DBColumn" dataType="Date" html="False" name="wkshp_benchmarkdate" fieldSource="wkshp_benchmarkdate" wizardCaption="Wkshp Benchmarkdate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_benchmarkdate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="74" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_donumber" fieldSource="wkshp_donumber" wizardCaption="Wkshp Donumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_donumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="75" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_eq_origin" fieldSource="wkshp_eq_origin" wizardCaption="Wkshp Eq Origin" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_eq_origin">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="76" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_mtn_serialnumber" fieldSource="wkshp_mtn_serialnumber" wizardCaption="Wkshp Mtn Serialnumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_mtn_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="77" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_loan_serialnumber" fieldSource="wkshp_loan_serialnumber" wizardCaption="Wkshp Loan Serialnumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_loan_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="78" fieldSourceType="DBColumn" dataType="Text" html="False" name="wkshp_eq_location" fieldSource="wkshp_eq_location" wizardCaption="Wkshp Eq Location" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_eq_location">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="79" fieldSourceType="DBColumn" dataType="Memo" html="False" name="wkshp_remark" fieldSource="wkshp_remark" wizardCaption="Wkshp Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentRelatedwkshp_remark">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="80" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events/>
<TableParameters>
<TableParameter id="83" conditionType="Parameter" useIsNull="False" field="wkshp_mtn_serialnumber" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="Or" parameterSource="mtn"/>
<TableParameter id="84" conditionType="Parameter" useIsNull="False" field="wkshp_loan_serialnumber" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="loan"/>
</TableParameters>
<JoinTables>
<JoinTable id="82" tableName="smart_workshop" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartworkshop.php" forShow="True" url="smartworkshop.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartworkshop_events.php" forShow="False" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
<Event name="AfterInitialize" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="86"/>
</Actions>
</Event>
</Events>
</Page>
