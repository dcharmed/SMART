<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_equipment" name="smart_equipment" pageSizeLimit="100" wizardCaption="List of Smart Equipment "><Components><Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqpmt_serialnumber" fieldSource="eqpmt_serialnumber"><Components/><Events/><Attributes/><Features/></Label></Components><Events/><TableParameters><TableParameter id="29" conditionType="Parameter" useIsNull="False" field="eqpmt_serialnumber" dataType="Text" logicOperator="And" searchConditionType="BeginsWith" parameterType="Form" parameterSource="eqpmt_serialnumber"/></TableParameters><JoinTables/><JoinLinks/><Fields><Field id="28" tableName="smart_equipment" fieldName="eqpmt_serialnumber"/></Fields><SPParameters/><SQLParameters/><SecurityGroups/><Attributes/><Features/></Grid></Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="popRNfaultyequipment_smart_faultyequipment_eqpmt_serialnumber_PTAutocomplete1.php" forShow="True" url="popRNfaultyequipment_smart_faultyequipment_eqpmt_serialnumber_PTAutocomplete1.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
