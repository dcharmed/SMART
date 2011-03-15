<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_ticketgenerator" activeCollection="TableParameters" name="smart_ticketgenerator" pageSizeLimit="100" wizardCaption="List of Smart Ticketgenerator ">
<Components>
<Label id="236" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="237" fieldSourceType="DBColumn" dataType="Text" html="False" name="type" fieldSource="type">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="238" fieldSourceType="DBColumn" dataType="Integer" html="False" name="year" fieldSource="year">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="239" fieldSourceType="DBColumn" dataType="Text" html="False" name="currentticket" fieldSource="currentticket">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="240" fieldSourceType="DBColumn" dataType="Date" html="False" name="datemodified" fieldSource="datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="231" conditionType="Parameter" useIsNull="False" field="year" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="date(&quot;Y&quot;)"/>
<TableParameter id="232" conditionType="Parameter" useIsNull="False" field="type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="pm"/>
<TableParameter id="235" conditionType="Parameter" useIsNull="True" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
</TableParameters>
<JoinTables>
<JoinTable id="230" tableName="smart_ticketgenerator" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="pmactivity_RPreventive_prvt_toppanid_PTAutoFill1.php" forShow="True" url="pmactivity_RPreventive_prvt_toppanid_PTAutoFill1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
