<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" name="smart_referencecode" pageSizeLimit="100" wizardCaption="List of Smart Referencecode "><Components><Label id="75" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_value" fieldSource="ref_value"><Components/><Events/><Attributes/><Features/></Label><Label id="76" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="ref_description"><Components/><Events/><Attributes/><Features/></Label></Components><Events/><TableParameters><TableParameter id="74" conditionType="Parameter" useIsNull="True" field="ref_type" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/></TableParameters><JoinTables><JoinTable id="72" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/></JoinTables><JoinLinks/><Fields/><SPParameters/><SQLParameters/><SecurityGroups/><Attributes/><Features/></Grid></Components>
	<CodeFiles>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
