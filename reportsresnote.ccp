<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<ImageLink id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteImageLink1" hrefSource="printrptresnote.ccp">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="45" sourceType="URL" format="yyyy-mm-dd" name="year" source="year"/>
				<LinkParameter id="46" sourceType="URL" format="yyyy-mm-dd" name="set" source="set"/>
				<LinkParameter id="47" sourceType="Expression" format="yyyy-mm-dd" name="print" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</ImageLink>
		<Grid id="55" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" name="GTicketMethodByYear" pageSizeLimit="100" wizardCaption="List of Smart Referencecode,smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" orderBy="ref_rank">
			<Components>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="ref_description" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsresnoteGTicketMethodByYearref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="57" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="reportsresnoteGTicketMethodByYearlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TicMonth" wizardCaption="Rsltn Actionmethod" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsresnoteGTicketMethodByYearTicMonth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="59" fieldSourceType="DBColumn" dataType="Integer" html="False" name="JanTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearJanTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" name="FebTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearFebTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="DBColumn" dataType="Integer" html="False" name="MacTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearMacTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="62" fieldSourceType="DBColumn" dataType="Integer" html="False" name="AprTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearAprTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="63" fieldSourceType="DBColumn" dataType="Integer" html="False" name="MeiTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearMeiTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="64" fieldSourceType="DBColumn" dataType="Integer" html="False" name="JuneTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearJuneTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="65" fieldSourceType="DBColumn" dataType="Integer" html="False" name="JulyTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearJulyTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="66" fieldSourceType="DBColumn" dataType="Integer" html="False" name="AugTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearAugTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="67" fieldSourceType="DBColumn" dataType="Integer" html="False" name="SeptTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearSeptTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="68" fieldSourceType="DBColumn" dataType="Integer" html="False" name="OctTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearOctTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="69" fieldSourceType="DBColumn" dataType="Integer" html="False" name="NovTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearNovTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="70" fieldSourceType="DBColumn" dataType="Integer" html="False" name="DecTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearDecTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="71" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_value" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsresnoteGTicketMethodByYearref_value">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="72" fieldSourceType="DBColumn" dataType="Integer" html="False" name="GrandTotal" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearGrandTotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="80" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearlblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="81" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalJan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="82" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalFeb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalFeb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="83" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMac" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalMac">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="84" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalApr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalApr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="85" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMei" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalMei">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="86" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJune" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalJune">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="87" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJuly" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalJuly">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="88" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalAug" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalAug">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="89" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalSept" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalSept">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="90" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalOct" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalOct">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalNov" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalNov">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="92" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalDec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsresnoteGTicketMethodByYearTotalDec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="73"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="74"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="75"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="76" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" leftBrackets="0" rightBrackets="0" parameterSource="rsltnmethod"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="77" tableName="smart_referencecode" posLeft="385" posTop="21" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="78" tableName="smart_referencecode" fieldName="ref_description"/>
				<Field id="79" tableName="smart_referencecode" fieldName="ref_value"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="reportsresnote.php" forShow="True" url="reportsresnote.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="reportsresnote_events.php" forShow="False" comment="//" codePage="windows-1252"/>
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
