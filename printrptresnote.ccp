<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" name="GTicketMethodByYear" pageSizeLimit="100" wizardCaption="List of Smart Referencecode,smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="ref_description" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketMethodByYearref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="4" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTicketMethodByYearlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="False" name="TicMonth" wizardCaption="Rsltn Actionmethod" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketMethodByYearTicMonth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" name="JanTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearJanTic" fieldSource="TicketJan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" name="FebTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearFebTic" fieldSource="TicketFeb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" name="MacTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearMacTic" fieldSource="TicketMac">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" name="AprTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearAprTic" fieldSource="TicketApr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="False" name="MeiTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearMeiTic" fieldSource="TicketMei">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="JuneTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearJuneTic" fieldSource="TicketJune">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="JulyTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearJulyTic" fieldSource="TicketJuly">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" name="AugTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearAugTic" fieldSource="TicketAug">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="SeptTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearSeptTic" fieldSource="TicketSept">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="OctTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearOctTic" fieldSource="TicketOct">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="NovTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearNovTic" fieldSource="TicketNov">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="DecTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearDecTic" fieldSource="TicketDec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_value" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketMethodByYearref_value">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearlblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" name="GrandTotal" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearGrandTotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalJan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalFeb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalFeb">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMac" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalMac">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalApr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalApr">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="39" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMei" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalMei">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="41" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJune" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalJune">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="43" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJuly" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalJuly">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="45" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalAug" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalAug">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="47" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalSept" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalSept">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="49" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalOct" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalOct">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="51" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalNov" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalNov">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalDec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketMethodByYearTotalDec">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="21"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="23"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="actmethod" leftBrackets="0" rightBrackets="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="25" tableName="smart_referencecode" posLeft="385" posTop="21" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="26" tableName="smart_referencecode" fieldName="ref_description"/>
				<Field id="27" tableName="smart_referencecode" fieldName="ref_value"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="printrptresnote.php" forShow="True" url="printrptresnote.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="printrptresnote_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="28"/>
			</Actions>
		</Event>
	</Events>
</Page>
