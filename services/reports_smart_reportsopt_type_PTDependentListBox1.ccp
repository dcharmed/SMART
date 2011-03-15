<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="smart_reportsopt1" connection="SMART" dataSource="smart_reportsopt" pageSizeLimit="100" wizardCaption="List of Smart Reportsopt1 ">
<Components>
<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="opt_value" fieldSource="opt_value">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="opt_description" fieldSource="opt_description">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="14" conditionType="Parameter" useIsNull="True" field="opt_type" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="reports_smart_reportsopt_type_PTDependentListBox1.php" forShow="True" url="reports_smart_reportsopt_type_PTDependentListBox1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
