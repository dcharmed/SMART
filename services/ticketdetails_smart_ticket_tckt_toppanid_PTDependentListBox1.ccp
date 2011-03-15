<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" connection="SMART" dataSource="smart_eqtoppan" name="smart_eqtoppan" pageSizeLimit="100" wizardCaption="List of Smart Eqtoppan " activeCollection="TableParameters">
<Components>
<Label id="379" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqtop_toppan" fieldSource="eqtop_toppan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="380" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqtop_toppan1" fieldSource="eqtop_toppan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="378" conditionType="Parameter" useIsNull="True" field="eqtop_eqcode" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
<TableParameter id="381" conditionType="Parameter" useIsNull="False" field="eqtop_branch" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="branch"/>
</TableParameters>
<JoinTables>
<JoinTable id="376" tableName="smart_eqtoppan" posLeft="10" posTop="10" posWidth="130" posHeight="136"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="ticketdetails_smart_ticket_tckt_toppanid_PTDependentListBox1.php" forShow="True" url="ticketdetails_smart_ticket_tckt_toppanid_PTDependentListBox1.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
