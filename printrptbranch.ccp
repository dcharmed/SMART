<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="100" connection="SMART" dataSource="smart_referencecode, smart_eqtoppan" activeCollection="TableParameters" name="GReportBranchByYear" pageSizeLimit="100" wizardCaption="List of Smart Referencecode,smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" groupBy="eqtop_branch">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="eqtop_branch" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GReportBranchByYearref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="4" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GReportBranchByYearlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="True" name="TicMonth" wizardCaption="Rsltn Actionmethod" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GReportBranchByYearTicMonth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="True" name="JanTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearJanTic" fieldSource="TicketJan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="True" name="FebTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearFebTic" fieldSource="TicketFeb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="True" name="MacTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearMacTic" fieldSource="TicketMac">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="True" name="AprTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearAprTic" fieldSource="TicketApr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="True" name="MeiTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearMeiTic" fieldSource="TicketMei">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="True" name="JuneTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearJuneTic" fieldSource="TicketJune">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="True" name="JulyTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearJulyTic" fieldSource="TicketJuly">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="True" name="AugTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearAugTic" fieldSource="TicketAug">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="True" name="SeptTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearSeptTic" fieldSource="TicketSept">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="True" name="OctTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearOctTic" fieldSource="TicketOct">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="True" name="NovTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearNovTic" fieldSource="TicketNov">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="True" name="DecTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearDecTic" fieldSource="TicketDec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_value" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GReportBranchByYearref_value" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearlblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="True" name="GrandTotal" PathID="GReportBranchByYearGrandTotal">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalJan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalFeb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalFeb">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMac" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalMac">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="39" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalApr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalApr">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="41" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMei" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalMei">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="43" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJune" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalJune">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="45" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJuly" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalJuly">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="47" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalAug" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalAug">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="49" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalSept" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalSept">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="51" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalOct" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalOct">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalNov" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalNov">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="55" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalDec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GReportBranchByYearTotalDec">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="20"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="21"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="23" tableName="smart_referencecode" posLeft="202" posTop="15" posWidth="117" posHeight="152"/>
				<JoinTable id="24" tableName="smart_eqtoppan" posLeft="21" posTop="10" posWidth="130" posHeight="136"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="25" tableLeft="smart_eqtoppan" tableRight="smart_referencecode" fieldLeft="smart_eqtoppan.eqtop_branch" fieldRight="smart_referencecode.ref_value" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="26" tableName="smart_referencecode" fieldName="ref_description"/>
				<Field id="27" tableName="smart_referencecode" fieldName="ref_value"/>
				<Field id="28" tableName="smart_eqtoppan" fieldName="eqtop_branch"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="printrptbranch.php" forShow="True" url="printrptbranch.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="printrptbranch_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="29"/>
			</Actions>
		</Event>
	</Events>
</Page>
