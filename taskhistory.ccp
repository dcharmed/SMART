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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="30" connection="SMART" dataSource="smart_task, smart_ticket" orderBy="task_date desc" name="GTaskHistory" pageSizeLimit="100" wizardCaption="List of Smart Task,smart Ticket " wizardGridType="Tabular" wizardSortingType="Extended" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
<Components>
<Sorter id="21" visible="True" name="Sorter_id" column="smart_task.id" wizardCaption="Id" wizardSortingType="Extended" wizardControl="id" wizardAddNbsp="False" PathID="GTaskHistorySorter_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="22" visible="True" name="Sorter_tckt_refnumber" column="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSortingType="Extended" wizardControl="tckt_refnumber" wizardAddNbsp="False" PathID="GTaskHistorySorter_tckt_refnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="23" visible="True" name="Sorter_tckt_r_date" column="tckt_r_date" wizardCaption="Tckt R Date" wizardSortingType="Extended" wizardControl="tckt_r_date" wizardAddNbsp="False" PathID="GTaskHistorySorter_tckt_r_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="24" visible="True" name="Sorter_task_current" column="task_current" wizardCaption="Task Current" wizardSortingType="Extended" wizardControl="task_current" wizardAddNbsp="False" PathID="GTaskHistorySorter_task_current">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="25" visible="True" name="Sorter_task_update" column="task_update" wizardCaption="Task Update" wizardSortingType="Extended" wizardControl="task_update" wizardAddNbsp="False" PathID="GTaskHistorySorter_task_update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="26" visible="True" name="Sorter_task_currenteng" column="task_currenteng" wizardCaption="Task Currenteng" wizardSortingType="Extended" wizardControl="task_currenteng" wizardAddNbsp="False" PathID="GTaskHistorySorter_task_currenteng">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="27" visible="True" name="Sorter_task_updatedeng" column="task_updatedeng" wizardCaption="Task Updatedeng" wizardSortingType="Extended" wizardControl="task_updatedeng" wizardAddNbsp="False" PathID="GTaskHistorySorter_task_updatedeng">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="28" visible="True" name="Sorter_task_status" column="task_status" wizardCaption="Task Status" wizardSortingType="Extended" wizardControl="task_status" wizardAddNbsp="False" PathID="GTaskHistorySorter_task_status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="29" visible="True" name="Sorter_task_date" column="task_date" wizardCaption="Task Date" wizardSortingType="Extended" wizardControl="task_date" wizardAddNbsp="False" PathID="GTaskHistorySorter_task_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTaskHistorylblNumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_refnumber" fieldSource="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTaskHistorytckt_refnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="33" fieldSourceType="DBColumn" dataType="Date" html="False" name="tckt_r_date" fieldSource="tckt_r_date" wizardCaption="Tckt R Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTaskHistorytckt_r_date" format="GeneralDate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="34" fieldSourceType="DBColumn" dataType="Integer" html="False" name="task_current" fieldSource="task_current" wizardCaption="Task Current" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTaskHistorytask_current">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="task_update" fieldSource="task_update" wizardCaption="Task Update" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTaskHistorytask_update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="36" fieldSourceType="DBColumn" dataType="Integer" html="False" name="task_currenteng" fieldSource="task_currenteng" wizardCaption="Task Currenteng" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTaskHistorytask_currenteng">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" name="task_updatedeng" fieldSource="task_updatedeng" wizardCaption="Task Updatedeng" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTaskHistorytask_updatedeng">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" name="task_status" fieldSource="task_status" wizardCaption="Task Status" wizardSize="5" wizardMaxLength="5" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTaskHistorytask_status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="39" fieldSourceType="DBColumn" dataType="Memo" html="True" name="task_notes" fieldSource="task_notes" wizardCaption="Task Notes" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTaskHistorytask_notes">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="40" fieldSourceType="DBColumn" dataType="Date" html="False" name="task_date" fieldSource="task_date" wizardCaption="Task Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTaskHistorytask_date" format="GeneralDate">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="41" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events>
<Event name="BeforeShowRow" type="Server">
<Actions>
<Action actionName="Set Row Style" actionCategory="General" id="30" styles="Row;AltRow" name="rowStyle"/>
<Action actionName="Custom Code" actionCategory="General" id="44"/>
</Actions>
</Event>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="43"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_refnumber" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1" parameterSource="s_tckt"/>
<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="smart_task.task_currenteng" dataType="Integer" logicOperator="Or" searchConditionType="Equal" parameterType="URL" orderNumber="2" leftBrackets="1" parameterSource="s_eg"/>
<TableParameter id="42" conditionType="Parameter" useIsNull="False" field="smart_task.task_updatedeng" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" rightBrackets="1" parameterSource="s_eg"/>
<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="smart_task.task_status" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="3" parameterSource="s_ts"/>
</TableParameters>
<JoinTables>
<JoinTable id="6" tableName="smart_task" posLeft="10" posTop="10" posWidth="131" posHeight="254"/>
<JoinTable id="7" tableName="smart_ticket" posLeft="162" posTop="10" posWidth="160" posHeight="258"/>
</JoinTables>
<JoinLinks>
<JoinTable2 id="45" tableLeft="smart_task" tableRight="smart_ticket" fieldLeft="smart_task.ticket_id" fieldRight="smart_ticket.id" joinType="left" conditionType="Equal"/>
</JoinLinks>
<Fields>
<Field id="9" tableName="smart_task" fieldName="smart_task.*"/>
<Field id="10" tableName="smart_ticket" fieldName="tckt_refnumber"/>
<Field id="11" tableName="smart_ticket" fieldName="tckt_status"/>
<Field id="12" tableName="smart_ticket" fieldName="tckt_r_date"/>
</Fields>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Record id="13" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="STaskHistory" wizardCaption="Search Smart Task Smart Ticket " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="taskhistory.ccp" PathID="STaskHistory" pasteActions="pasteActions">
<Components>
<ListBox id="16" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="s_eg" wizardCaption="Task Currenteng" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="STaskHistorys_eg" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname" orderBy="usr_fullname">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="49" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_tckt" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="STaskHistorys_tckt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Button id="14" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="STaskHistoryButton_DoSearch">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<ListBox id="46" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_ts" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="STaskHistorys_ts" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
<Components/>
<Events/>
<TableParameters>
<TableParameter id="48" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="taskstatus"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="47" tableName="smart_referencecode" posWidth="117" posHeight="152" posLeft="10" posTop="10"/>
</JoinTables>
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
		<CodeFile id="Code" language="PHPTemplates" name="taskhistory.php" forShow="True" url="taskhistory.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="taskhistory_events.php" forShow="False" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
