<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="smartheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Report id="5" secured="False" enablePrint="True" showMode="Web" sourceType="Table" returnValueType="Number" linesPerWebPage="20" linesPerPhysicalPage="50" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters">
<Components/>
<Events/>
<TableParameters>
<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="actmethod"/>
</TableParameters>
<JoinTables>
<JoinTable id="6" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<ReportGroups/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Report>
<Link id="8" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Report_Print" hrefSource="testreports.ccp" wizardTheme="{ccs_style}" wizardThemeType="File" wizardDefaultValue="Printable version" wizardUseTemplateBlock="True" wizardBeforeHTML="&lt;p align=&quot;right&quot;&gt;" wizardAfterHTML="&lt;/p&gt;" wizardLinkTarget="_blank">
<Components/>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Hide-Show Component" actionCategory="General" id="10" action="Hide" conditionType="Parameter" dataType="Text" condition="Equal" parameter1="Print" name1="ViewMode" sourceType1="URL" name2="&quot;Print&quot;" sourceType2="Expression"/>
</Actions>
</Event>
</Events>
<LinkParameters>
<LinkParameter id="9" sourceType="Expression" format="yyyy-mm-dd" name="ViewMode" source="&quot;Print&quot;"/>
</LinkParameters>
<Attributes/>
<Features/>
</Link>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="testreports.php" forShow="True" url="testreports.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
