<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_equipment" activeCollection="TableParameters" name="smart_equipment1" pageSizeLimit="100" wizardCaption="List of Smart Equipment1 ">
<Components>
<Label id="113" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_serialnumber" fieldSource="eqpmt_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="107" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="Form" logicOperator="And" parameterSource="equipment_id"/>
<TableParameter id="112" conditionType="Parameter" useIsNull="True" field="eqpmt_serialnumber" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
</TableParameters>
<JoinTables>
<JoinTable id="106" tableName="smart_equipment" posLeft="10" posTop="10" posWidth="154" posHeight="168"/>
</JoinTables>
<JoinLinks/>
<Fields>
<Field id="109" tableName="smart_equipment" fieldName="eqpmt_serialnumber"/>
</Fields>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="resolutionnotes_smart_faultyequipment_eqpmt_serialnumber_PTAutoFill1.php" forShow="True" url="resolutionnotes_smart_faultyequipment_eqpmt_serialnumber_PTAutoFill1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
