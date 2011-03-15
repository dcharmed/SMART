<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="smart_equipment" connection="SMART" dataSource="smart_equipment" pageSizeLimit="100" wizardCaption="List of Smart Equipment ">
<Components>
<Label id="374" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_code" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="375" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_name" fieldSource="eqpmt_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="373" conditionType="Parameter" useIsNull="True" field="eqpmt_branch" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
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
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="ticketdetails_smart_ticket_tckt_equipment_PTDependentListBox1.php" forShow="True" url="ticketdetails_smart_ticket_tckt_equipment_PTDependentListBox1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
