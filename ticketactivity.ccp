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
		<IncludePage id="5" name="resolutionnotes" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotes" page="resolutionnotes.ccp">
<Components/>
<Events/>
<Features/>
</IncludePage>
<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_resolutionnote" name="smart_resolutionnote" pageSizeLimit="100" wizardCaption="List of Smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters">
<Components>
<Label id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" name="rsltn_status" fieldSource="rsltn_status" wizardCaption="Rsltn Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_resolutionnotersltn_status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="8" fieldSourceType="DBColumn" dataType="Date" html="False" name="rsltn_date" fieldSource="rsltn_date" wizardCaption="Rsltn Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_resolutionnotersltn_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" name="rsltn_byuser" fieldSource="rsltn_byuser" wizardCaption="Rsltn Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_resolutionnotersltn_byuser">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="10" fieldSourceType="DBColumn" dataType="Memo" html="False" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" wizardCaption="Rsltn Actiontaken" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_resolutionnotersltn_actiontaken">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_actionmethod" fieldSource="rsltn_actionmethod" wizardCaption="Rsltn Actionmethod" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_resolutionnotersltn_actionmethod">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="12" fieldSourceType="DBColumn" dataType="Memo" html="False" name="rsltn_planning" fieldSource="rsltn_planning" wizardCaption="Rsltn Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_resolutionnotersltn_planning">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="13" fieldSourceType="DBColumn" dataType="Memo" html="False" name="rsltn_remark" fieldSource="rsltn_remark" wizardCaption="Rsltn Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_resolutionnotersltn_remark">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="14" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events>
<Event name="BeforeShowRow" type="Server">
<Actions>
<Action actionName="Set Row Style" actionCategory="General" id="15" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="ticket_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="tcktid"/>
</TableParameters>
<JoinTables>
<JoinTable id="29" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Record id="16" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_ticket" dataSource="smart_ticket" errorSummator="Error" wizardCaption="View Smart Ticket " wizardFormMethod="post" PathID="smart_ticket" activeCollection="TableParameters">
<Components>
<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_refnumber" fieldSource="tckt_refnumber" required="False" caption="Tckt Refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_refnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="tckt_status" fieldSource="tckt_status" required="True" caption="Tckt Status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="21" fieldSourceType="DBColumn" dataType="Date" html="False" name="tckt_date" fieldSource="tckt_date" required="True" caption="Tckt Date" wizardCaption="Tckt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="24" fieldSourceType="DBColumn" dataType="Integer" html="False" name="tckt_severity" fieldSource="tckt_severity" required="True" caption="Tckt Severity" wizardCaption="Tckt Severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_severity">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_tagrelated" fieldSource="tckt_tagrelated" required="False" caption="Tckt Tagrelated" wizardCaption="Tckt Tagrelated" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_tagrelated">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_state" fieldSource="tckt_state" required="False" caption="Tckt State" wizardCaption="Tckt State" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_state">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_site" fieldSource="tckt_site" required="True" caption="Tckt Site" wizardCaption="Tckt Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_site">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_category" fieldSource="tckt_category" required="True" caption="Tckt Category" wizardCaption="Tckt Category" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_category">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_subcategory" fieldSource="tckt_subcategory" required="False" caption="Tckt Subcategory" wizardCaption="Tckt Subcategory" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tickettckt_subcategory">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="tcktid"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="28" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
</JoinTables>
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
		<CodeFile id="Code" language="PHPTemplates" name="ticketactivity.php" forShow="True" url="ticketactivity.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="ticketactivity_events.php" forShow="False" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
