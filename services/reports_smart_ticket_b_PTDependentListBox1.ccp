<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="smart_referencecode" connection="SMART" dataSource="smart_referencecode" pageSizeLimit="100" wizardCaption="List of Smart Referencecode ">
<Components>
<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_value" fieldSource="ref_value">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="ref_description">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="39" conditionType="Parameter" useIsNull="True" field="ref_type" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="reports_smart_ticket_b_PTDependentListBox1.php" forShow="True" url="reports_smart_ticket_b_PTDependentListBox1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
