<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="31" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_equipment" name="smart_equipment" pageSizeLimit="100" wizardCaption="List of Smart Equipment " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" pasteActions="pasteActions">
<Components>
<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" name="eqmt_type" fieldSource="eqmt_type" wizardCaption="Eqmt Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_equipmenteqmt_type">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqmt_serialno" fieldSource="eqmt_serialno" wizardCaption="Eqmt Serialno" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_equipmenteqmt_serialno">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="32" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_equipmentid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Grid id="35" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_measurement" name="smart_measurement" pageSizeLimit="100" wizardCaption="List of Smart Measurement " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records">
<Components>
<Label id="36" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_measurementid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="msre_item" fieldSource="msre_item" wizardCaption="Msre Item" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_measurementmsre_item">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="38" fieldSourceType="DBColumn" dataType="Single" html="False" name="msre_before" fieldSource="msre_before" wizardCaption="Msre Before" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_measurementmsre_before">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="39" fieldSourceType="DBColumn" dataType="Single" html="False" name="msre_after" fieldSource="msre_after" wizardCaption="Msre After" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_measurementmsre_after">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="40" fieldSourceType="DBColumn" dataType="Memo" html="False" name="msre_remark" fieldSource="msre_remark" wizardCaption="Msre Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_measurementmsre_remark">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Grid id="41" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_replacement" name="smart_replacement" pageSizeLimit="100" wizardCaption="List of Smart Replacement " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records">
<Components>
<Label id="42" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_replacementid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="43" fieldSourceType="DBColumn" dataType="Integer" html="False" name="resolution_id" fieldSource="resolution_id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_replacementresolution_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="44" fieldSourceType="DBColumn" dataType="Integer" html="False" name="equipment_id" fieldSource="equipment_id" wizardCaption="Equipment Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_replacementequipment_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="45" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ticket_id" fieldSource="ticket_id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_replacementticket_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" name="rplmt_serialno" fieldSource="rplmt_serialno" wizardCaption="Rplmt Serialno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_replacementrplmt_serialno">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="47" fieldSourceType="DBColumn" dataType="Memo" html="False" name="rplmt_remark" fieldSource="rplmt_remark" wizardCaption="Rplmt Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_replacementrplmt_remark">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="48" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Record id="49" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_resolution" dataSource="smart_resolution" errorSummator="Error" wizardCaption="Add/Edit Smart Resolution " wizardFormMethod="post" PathID="smart_resolution" pasteActions="pasteActions">
<Components>
<Button id="50" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="smart_resolutionButton_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="51" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="smart_resolutionButton_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="52" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_resolutionButton_Cancel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Hidden id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionticket_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<TextBox id="56" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rslt_date" fieldSource="rslt_date" required="True" caption="Rslt Date" wizardCaption="Rslt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="57" name="DatePicker_rslt_date" control="rslt_date" wizardSatellite="True" wizardControl="rslt_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_resolutionDatePicker_rslt_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<ListBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="rslt_engineer" fieldSource="rslt_engineer" required="False" caption="Rslt Engineer" wizardCaption="Rslt Engineer" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_engineer" sourceType="Table" connection="SMART" activeCollection="TableParameters" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname">
<Components/>
<Events/>
<Attributes/>
<Features/>
<TableParameters>
<TableParameter id="79" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="78" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
</ListBox>
<TextBox id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rslt_servicedate" fieldSource="rslt_servicedate" required="False" caption="Rslt Servicedate" wizardCaption="Rslt Servicedate" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_servicedate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="61" name="DatePicker_rslt_servicedate" control="rslt_servicedate" wizardSatellite="True" wizardControl="rslt_servicedate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_resolutionDatePicker_rslt_servicedate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="62" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rslt_serviceno" fieldSource="rslt_serviceno" required="False" caption="Rslt Serviceno" wizardCaption="Rslt Serviceno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_serviceno">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="74" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutiondatemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="75" name="DatePicker_datemodified" control="datemodified" wizardSatellite="True" wizardControl="datemodified" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_resolutionDatePicker_datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rslt_eta" fieldSource="rslt_eta" required="False" caption="Rslt Eta" wizardCaption="Rslt Eta" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_eta">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="64" name="DatePicker_rslt_eta" control="rslt_eta" wizardSatellite="True" wizardControl="rslt_eta" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_resolutionDatePicker_rslt_eta">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="65" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rslt_etd" fieldSource="rslt_etd" required="False" caption="Rslt Etd" wizardCaption="Rslt Etd" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_etd">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="66" name="DatePicker_rslt_etd" control="rslt_etd" wizardSatellite="True" wizardControl="rslt_etd" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_resolutionDatePicker_rslt_etd">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<Label id="76" fieldSourceType="DBColumn" dataType="Text" html="False" name="ticketNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionticketNumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="77" fieldSourceType="DBColumn" dataType="Text" html="False" name="site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionsite">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<TextBox id="58" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rslt_toppanid" fieldSource="rslt_toppanid" required="False" caption="Rslt Toppanid" wizardCaption="Rslt Toppanid" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_toppanid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="72" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rslt_related" fieldSource="rslt_related" required="False" caption="Rslt Related" wizardCaption="Rslt Related" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_related">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextArea id="67" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rslt_inspection" fieldSource="rslt_inspection" required="True" caption="Rslt Inspection" wizardCaption="Rslt Inspection" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrslt_inspection">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
<TextArea id="68" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rslt_action" fieldSource="rslt_action" required="True" caption="Rslt Action" wizardCaption="Rslt Action" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrslt_action">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
<RadioButton id="69" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rslt_method" fieldSource="rslt_method" required="False" caption="Rslt Method" wizardCaption="Rslt Method" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrslt_method" sourceType="ListOfValues" html="True" connection="SMART" _valueOfList="3" _nameOfList="Remote" dataSource="1;Phone Call;2;Visit Site;3;Remote">
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
</RadioButton>
<TextArea id="71" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rslt_planning" fieldSource="rslt_planning" required="False" caption="Rslt Planning" wizardCaption="Rslt Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrslt_planning">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
<TextArea id="73" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rslt_remark" fieldSource="rslt_remark" required="False" caption="Rslt Remark" wizardCaption="Rslt Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrslt_remark">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
</Components>
<Events/>
<TableParameters>
<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartnote.php" forShow="True" url="smartnote.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
