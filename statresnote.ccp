<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Link id="25" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Report_Print1" hrefSource="statresnote.ccp" wizardTheme="{ccs_style}" wizardThemeType="File" wizardDefaultValue="Printable version" wizardUseTemplateBlock="True" wizardBeforeHTML="&lt;p align=&quot;right&quot;&gt;" wizardAfterHTML="&lt;/p&gt;" wizardLinkTarget="_blank" PathID="reportsresnoteReport_Print1">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Hide-Show Component" actionCategory="General" id="27" action="Hide" conditionType="Parameter" dataType="Text" condition="Equal" parameter1="Print" name1="ViewMode" sourceType1="URL" name2="&quot;Print&quot;" sourceType2="Expression"/>
					</Actions>
				</Event>
			</Events>
			<LinkParameters>
				<LinkParameter id="26" sourceType="Expression" format="yyyy-mm-dd" name="ViewMode" source="&quot;Print&quot;"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Grid id="71" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" name="GTicketMethodByYear" pageSizeLimit="100" wizardCaption="List of Smart Referencecode,smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions">
			<Components>
				<Label id="83" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="ref_description" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsresnoteGTicketMethodByYearref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="84" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="statresnoteGTicketMethodByYearlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="85" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TicMonth" wizardCaption="Rsltn Actionmethod" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsresnoteGTicketMethodByYearTicMonth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="86" fieldSourceType="DBColumn" dataType="Integer" html="False" name="JanTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearJanTic" fieldSource="TicketJan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="87" fieldSourceType="DBColumn" dataType="Integer" html="False" name="FebTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearFebTic" fieldSource="TicketFeb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="88" fieldSourceType="DBColumn" dataType="Integer" html="False" name="MacTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearMacTic" fieldSource="TicketMac">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="89" fieldSourceType="DBColumn" dataType="Integer" html="False" name="AprTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearAprTic" fieldSource="TicketApr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="90" fieldSourceType="DBColumn" dataType="Integer" html="False" name="MeiTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearMeiTic" fieldSource="TicketMei">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Integer" html="False" name="JuneTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearJuneTic" fieldSource="TicketJune">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="92" fieldSourceType="DBColumn" dataType="Integer" html="False" name="JulyTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearJulyTic" fieldSource="TicketJuly">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="93" fieldSourceType="DBColumn" dataType="Integer" html="False" name="AugTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearAugTic" fieldSource="TicketAug">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="94" fieldSourceType="DBColumn" dataType="Integer" html="False" name="SeptTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearSeptTic" fieldSource="TicketSept">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="95" fieldSourceType="DBColumn" dataType="Integer" html="False" name="OctTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearOctTic" fieldSource="TicketOct">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="96" fieldSourceType="DBColumn" dataType="Integer" html="False" name="NovTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearNovTic" fieldSource="TicketNov">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="97" fieldSourceType="DBColumn" dataType="Integer" html="False" name="DecTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearDecTic" fieldSource="TicketDec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="82" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_value" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsresnoteGTicketMethodByYearref_value">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="113" fieldSourceType="DBColumn" dataType="Integer" html="False" name="GrandTotal" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearGrandTotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="98" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="110" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="112" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="73" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="actmethod" leftBrackets="0" rightBrackets="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="72" tableName="smart_referencecode" posLeft="385" posTop="21" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="77" tableName="smart_referencecode" fieldName="ref_description"/>
				<Field id="78" tableName="smart_referencecode" fieldName="ref_value"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="statresnote_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="statresnote.php" forShow="True" url="statresnote.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="54"/>
			</Actions>
		</Event>
	</Events>
</Page>
