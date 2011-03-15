<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" name="smart_partsstock" dataSource="smart_partsstock" pageSizeLimit="100" wizardCaption="List of Smart Partsstock ">
<Components>
<Label id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" name="pstock_itemname" fieldSource="pstock_itemname">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="False" name="pstock_itemcode" fieldSource="pstock_itemcode">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="pstock_number" fieldSource="pstock_number">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="57" fieldSourceType="DBColumn" dataType="Date" html="False" name="pstock_date" fieldSource="pstock_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="58" fieldSourceType="DBColumn" dataType="Text" html="False" name="pstock_preqformno" fieldSource="pstock_preqformno">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="59" fieldSourceType="DBColumn" dataType="Integer" html="False" name="pstock_checking" fieldSource="pstock_checking">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" name="pstock_qty" fieldSource="pstock_qty">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="61" fieldSourceType="DBColumn" dataType="Integer" html="False" name="pstock_balance" fieldSource="pstock_balance">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="62" fieldSourceType="DBColumn" dataType="Memo" html="False" name="pstock_remarks" fieldSource="pstock_remarks">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="63" fieldSourceType="DBColumn" dataType="Date" html="False" name="datemodified" fieldSource="datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters>
<TableParameter id="52" conditionType="Parameter" useIsNull="True" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="smartpstock_RStock_pstock_itemcode_PTAutoFill1.php" forShow="True" url="smartpstock_RStock_pstock_itemcode_PTAutoFill1.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
