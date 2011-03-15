<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Report id="2" secured="False" enablePrint="True" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="50" linesPerPhysicalPage="50" connection="SMART" dataSource="SELECT ticket_id,
tckt_refnumber, 
tckt_site, 
tckt_description, 
tckt_engineer, 
tckt_r_date, 
tckt_c_date, 
left(timediff(tckt_c_date,tckt_r_date),locate(':',timediff(tckt_c_date,tckt_r_date))-1) as TCKT_AGE,
tckt_c_method, 
rsltn_type, 
rsltn_date, 
rsltn_byuser, 
rsltn_actiontaken 

FROM 
smart_ticket LEFT JOIN smart_resolutionnote on 
smart_ticket.id = smart_resolutionnote.ticket_id

WHERE smart_resolutionnote.ticket_id &lt; ALL (SELECT smart_resolutionnote.ticket_id 
FROM smart_resolutionnote
WHERE
rsltn_actiontaken like '%ghost%' OR
rsltn_actiontaken like '%restore%')

ORDER BY ticket_id, rsltn_date" activeCollection="TableParameters" orderBy="ticket_id, rsltn_date" name="smart_ticket_smart_resolu" pageSizeLimit="100" wizardCaption=" Smart Ticket, Smart Resolutionnote " wizardLayoutType="GroupLeft">
<Components>
<Section id="14" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
<Components>
<ReportLabel id="23" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="Report_TotalRecords" function="Count" wizardUseTemplateBlock="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluReport_HeaderReport_TotalRecords">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
</Components>
<Events/>
<Attributes/>
<Features/>
</Section>
<Section id="15" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Section>
<Section id="17" visible="True" lines="0" name="tckt_refnumber_Header">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Section>
<Section id="18" visible="True" lines="1" name="Detail">
<Components>
<ReportLabel id="31" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="True" resetAt="Report" name="tckt_refnumber" fieldSource="tckt_refnumber" wizardCaption="tckt_refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailtckt_refnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="32" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="Report_Row_Number" function="Count" wizardAlign="right" wizardCaption="#" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailReport_Row_Number">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="33" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_type" fieldSource="rsltn_type" wizardCaption="rsltn_type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailrsltn_type">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="34" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_date" fieldSource="rsltn_date" wizardCaption="rsltn_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailrsltn_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_byuser" fieldSource="rsltn_byuser" wizardCaption="rsltn_byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailrsltn_byuser">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="36" fieldSourceType="DBColumn" dataType="Memo" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" wizardCaption="rsltn_actiontaken" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailrsltn_actiontaken">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="ticket_id" fieldSource="ticket_id" wizardCaption="ticket_id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailticket_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="38" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_engineer" fieldSource="tckt_engineer" wizardCaption="tckt_engineer" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailtckt_engineer">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="39" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_r_date" fieldSource="tckt_r_date" wizardCaption="tckt_r_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailtckt_r_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="40" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_site" fieldSource="tckt_site" wizardCaption="tckt_site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailtckt_site">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="41" fieldSourceType="DBColumn" dataType="Memo" html="False" hideDuplicates="False" resetAt="Report" name="tckt_description" fieldSource="tckt_description" wizardCaption="tckt_description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailtckt_description">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="42" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_c_date" fieldSource="tckt_c_date" wizardCaption="tckt_c_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailtckt_c_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<ReportLabel id="43" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_c_method" fieldSource="tckt_c_method" wizardCaption="tckt_c_method" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportsrsltnnotesmart_ticket_smart_resoluDetailtckt_c_method">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
</Components>
<Events/>
<Attributes/>
<Features/>
</Section>
<Section id="19" visible="True" lines="0" name="tckt_refnumber_Footer">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Section>
<Section id="20" visible="True" lines="0" name="Report_Footer" wizardSectionType="ReportFooter">
<Components>
<Panel id="21" visible="True" name="NoRecords" wizardNoRecords="No records">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Panel>
</Components>
<Events/>
<Attributes/>
<Features/>
</Section>
<Section id="22" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
<Components>
<Panel id="24" visible="True" name="PageBreak">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Panel>
<ReportLabel id="25" fieldSourceType="SpecialValue" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="Report_CurrentDateTime" fieldSource="CurrentDateTime" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardInsertToDateTD="True" PathID="reportsrsltnnotesmart_ticket_smart_resoluPage_FooterReport_CurrentDateTime">
<Components/>
<Events/>
<Attributes/>
<Features/>
</ReportLabel>
<Navigator id="26" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardImagesScheme="{ccs_style}">
<Components/>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Hide-Show Component" actionCategory="General" id="27" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events/>
<Attributes/>
<Features/>
</Section>
</Components>
<Events/>
<TableParameters>
<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="tckt_site" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_tckt_site" logicOperator="And" orderNumber="3"/>
<TableParameter id="29" conditionType="Parameter" useIsNull="False" field="tckt_state" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_tckt_state" logicOperator="And" orderNumber="2"/>
<TableParameter id="28" conditionType="Parameter" useIsNull="False" field="tckt_r_date" dataType="Date" searchConditionType="Equal" parameterType="URL" parameterSource="s_tckt_r_date" logicOperator="And" orderNumber="1"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<ReportGroups>
<ReportGroup id="16" name="tckt_refnumber" field="tckt_refnumber" sqlField="smart_ticket.tckt_refnumber" sortOrder="asc"/>
</ReportGroups>
<SecurityGroups/>
<Attributes/>
<Features/>
</Report>
<Record id="8" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="smart_resolutionnote_smar" wizardCaption="Search Smart Resolutionnote Smar " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="reportsrsltnnote.ccp" PathID="reportsrsltnnotesmart_resolutionnote_smar">
<Components>
<Button id="9" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="reportsrsltnnotesmart_resolutionnote_smarButton_DoSearch">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_tckt_r_date" wizardCaption="Tckt R Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" PathID="reportsrsltnnotesmart_resolutionnote_smars_tckt_r_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="11" name="DatePicker_s_tckt_r_date" control="s_tckt_r_date" wizardSatellite="True" wizardControl="s_tckt_r_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="reportsrsltnnotesmart_resolutionnote_smarDatePicker_s_tckt_r_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<ListBox id="12" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_tckt_state" wizardCaption="Tckt State" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="reportsrsltnnotesmart_resolutionnote_smars_tckt_state">
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
<ListBox id="13" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_tckt_site" wizardCaption="Tckt Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="reportsrsltnnotesmart_resolutionnote_smars_tckt_site">
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
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="reportsrsltnnote_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="reportsrsltnnote.php" forShow="True" url="reportsrsltnnote.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
<CachingParameters/>
<Attributes/>
<Features/>
<Events/>
</Page>
