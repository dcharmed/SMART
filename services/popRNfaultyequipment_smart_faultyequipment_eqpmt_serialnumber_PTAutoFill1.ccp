<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" name="smart_equipment" connection="SMART" dataSource="smart_equipment" pageSizeLimit="100" wizardCaption="List of Smart Equipment ">
<Components>
<Label id="30" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_status" fieldSource="eqpmt_status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_name" fieldSource="eqpmt_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_serialnumber" fieldSource="eqpmt_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="34" fieldSourceType="DBColumn" dataType="Date" html="False" name="eqpmt_datelifetime" fieldSource="eqpmt_datelifetime">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="35" fieldSourceType="DBColumn" dataType="Date" html="False" name="eqpmt_datereceived" fieldSource="eqpmt_datereceived">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="36" fieldSourceType="DBColumn" dataType="Date" html="False" name="datemodified" fieldSource="datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="29" conditionType="Parameter" useIsNull="True" field="eqpmt_serialnumber" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="popRNfaultyequipment_smart_faultyequipment_eqpmt_serialnumber_PTAutoFill1.php" forShow="True" url="popRNfaultyequipment_smart_faultyequipment_eqpmt_serialnumber_PTAutoFill1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
