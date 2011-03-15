<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" name="smart_equipment" dataSource="smart_equipment" pageSizeLimit="100" wizardCaption="List of Smart Equipment ">
<Components>
<Label id="358" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="359" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_code" fieldSource="eqpmt_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="360" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_status" fieldSource="eqpmt_status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="361" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_name" fieldSource="eqpmt_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="362" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_serialnumber" fieldSource="eqpmt_serialnumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="363" fieldSourceType="DBColumn" dataType="Date" html="False" name="eqpmt_datelifetime" fieldSource="eqpmt_datelifetime">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="364" fieldSourceType="DBColumn" dataType="Date" html="False" name="eqpmt_datereceived" fieldSource="eqpmt_datereceived">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="365" fieldSourceType="DBColumn" dataType="Date" html="False" name="datemodified" fieldSource="datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="357" conditionType="Parameter" useIsNull="True" field="eqpmt_code" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="ticketdetails_smart_ticket_tckt_equipment_PTAutoFill1.php" forShow="True" url="ticketdetails_smart_ticket_tckt_equipment_PTAutoFill1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
