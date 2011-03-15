<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_partsorders" name="smart_partsorders" pageSizeLimit="100" wizardCaption="List of Smart Partsorders " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
<Components>
<Label id="3" fieldSourceType="DBColumn" dataType="Text" html="False" name="engineer" fieldSource="engineer" wizardCaption="Podr Status" wizardSize="5" wizardMaxLength="5" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsordersengineer">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" name="formno" fieldSource="formno" wizardCaption="Podr Preqid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="reportrtnsmart_partsordersformno">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_itemcode" fieldSource="podr_itemcode" wizardCaption="Podr Itemcode" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderspodr_itemcode">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_itemname" fieldSource="podr_itemname" wizardCaption="Podr Itemname" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderspodr_itemname">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" name="podr_qty" fieldSource="podr_qty" wizardCaption="Podr Qty" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderspodr_qty">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" fieldSource="podr_site" wizardCaption="Podr Site" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderslblNumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="9" fieldSourceType="DBColumn" dataType="Memo" html="False" name="podr_remarks2" fieldSource="podr_remarks2" wizardCaption="Podr Remarks2" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderspodr_remarks2">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="10" fieldSourceType="DBColumn" dataType="Date" html="False" name="podr_rtndate" fieldSource="podr_rtndate" wizardCaption="Podr Rtndate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderspodr_rtndate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_rtnstatus" fieldSource="podr_rtnstatus" wizardCaption="Podr Rtnstatus" wizardSize="5" wizardMaxLength="5" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderspodr_rtnstatus">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_rtncounter" fieldSource="podr_rtncounter" wizardCaption="Podr Rtncounter" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportrtnsmart_partsorderspodr_rtncounter">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="13" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events>
<Event name="BeforeShowRow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="18"/>
</Actions>
</Event>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="19"/>
</Actions>
</Event>
</Events>
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
<ImageLink id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportrtnImageLink1" hrefSource="printrptcat.ccp">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="15" sourceType="URL" format="yyyy-mm-dd" name="year" source="year"/>
				<LinkParameter id="16" sourceType="URL" format="yyyy-mm-dd" name="set" source="set"/>
				<LinkParameter id="17" sourceType="Expression" format="yyyy-mm-dd" name="print" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</ImageLink>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="reportrtn_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="reportrtn.php" forShow="True" url="reportrtn.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
<CachingParameters/>
<Attributes/>
<Features/>
<Events/>
</Page>
