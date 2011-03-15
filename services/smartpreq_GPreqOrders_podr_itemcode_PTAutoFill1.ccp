<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" name="smart_sparepart" dataSource="smart_sparepart" pageSizeLimit="100" wizardCaption="List of Smart Sparepart " activeCollection="TableParameters">
<Components>
<Label id="156" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="157" fieldSourceType="DBColumn" dataType="Text" html="False" name="spart_category" fieldSource="spart_category">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="158" fieldSourceType="DBColumn" dataType="Text" html="False" name="spart_status" fieldSource="spart_status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="159" fieldSourceType="DBColumn" dataType="Text" html="False" name="spart_code" fieldSource="spart_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="160" fieldSourceType="DBColumn" dataType="Text" html="False" name="spart_name" fieldSource="spart_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="161" fieldSourceType="DBColumn" dataType="Text" html="False" name="spart_number" fieldSource="spart_number">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="162" fieldSourceType="DBColumn" dataType="Integer" html="False" name="spart_minlevel" fieldSource="spart_minlevel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="163" fieldSourceType="DBColumn" dataType="Integer" html="False" name="spart_reorderlevel" fieldSource="spart_reorderlevel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="164" fieldSourceType="DBColumn" dataType="Integer" html="False" name="spart_maxlevel" fieldSource="spart_maxlevel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="165" fieldSourceType="DBColumn" dataType="Integer" html="False" name="spart_central" fieldSource="spart_central">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="166" fieldSourceType="DBColumn" dataType="Integer" html="False" name="spart_regional" fieldSource="spart_regional">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="167" fieldSourceType="DBColumn" dataType="Date" html="False" name="spart_datelifetime" fieldSource="spart_datelifetime">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="168" fieldSourceType="DBColumn" dataType="Date" html="False" name="spart_datereceived" fieldSource="spart_datereceived">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="169" fieldSourceType="DBColumn" dataType="Date" html="False" name="datemodified" fieldSource="datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="155" conditionType="Parameter" useIsNull="True" field="spart_code" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
</TableParameters>
<JoinTables>
<JoinTable id="170" tableName="smart_sparepart" posLeft="10" posTop="10" posWidth="145" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields>
<Field id="171" tableName="smart_sparepart" fieldName="spart_name"/>
</Fields>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartpreq_GPreqOrders_podr_itemcode_PTAutoFill1.php" forShow="True" url="smartpreq_GPreqOrders_podr_itemcode_PTAutoFill1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
