<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" name="smart_sparepart" connection="SMART" dataSource="smart_sparepart" pageSizeLimit="100" wizardCaption="List of Smart Sparepart ">
<Components>
<Label id="154" fieldSourceType="DBColumn" dataType="Text" html="False" name="spart_code" fieldSource="spart_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="153" conditionType="Parameter" useIsNull="False" field="spart_code" dataType="Text" logicOperator="And" searchConditionType="BeginsWith" parameterType="Form" parameterSource="podr_itemcode"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields>
<Field id="152" tableName="smart_sparepart" fieldName="spart_code"/>
</Fields>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartpreq_GPreqOrders_podr_itemcode_PTAutocomplete1.php" forShow="True" url="smartpreq_GPreqOrders_podr_itemcode_PTAutocomplete1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
