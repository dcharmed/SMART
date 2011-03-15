<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Grid id="20" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="100" connection="SMART" dataSource="smart_referencecode, smart_eqtoppan" activeCollection="TableParameters" name="GReportBranchByYear" pageSizeLimit="100" wizardCaption="List of Smart Referencecode,smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" groupBy="eqtop_branch">
			<Components>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="eqtop_branch" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsbranchGReportBranchByYearref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="reportsbranchGReportBranchByYearlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Integer" html="True" name="TicMonth" wizardCaption="Rsltn Actionmethod" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsbranchGReportBranchByYearTicMonth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JanTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearJanTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="True" name="FebTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearFebTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Integer" html="True" name="MacTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearMacTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Integer" html="True" name="AprTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearAprTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Integer" html="True" name="MeiTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearMeiTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JuneTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearJuneTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JulyTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearJulyTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="True" name="AugTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearAugTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Integer" html="True" name="SeptTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearSeptTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="True" name="OctTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearOctTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Integer" html="True" name="NovTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearNovTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Integer" html="True" name="DecTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearDecTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_value" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportsbranchGReportBranchByYearref_value" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearlblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="True" name="GrandTotal" PathID="reportsbranchGReportBranchByYearGrandTotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalJan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalFeb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalFeb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="62" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMac" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalMac">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="64" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalApr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalApr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="66" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMei" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalMei">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="68" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJune" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalJune">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="70" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJuly" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalJuly">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalAug" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalAug">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="74" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalSept" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalSept">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="76" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalOct" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalOct">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="78" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalNov" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalNov">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="80" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalDec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchGReportBranchByYearTotalDec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="38" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="39" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="40" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="42" tableName="smart_referencecode" posLeft="202" posTop="15" posWidth="117" posHeight="152"/>
				<JoinTable id="45" tableName="smart_eqtoppan" posLeft="21" posTop="10" posWidth="130" posHeight="136"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="49" tableLeft="smart_eqtoppan" fieldLeft="smart_eqtoppan.eqtop_branch" tableRight="smart_referencecode" fieldRight="smart_referencecode.ref_value" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="43" tableName="smart_referencecode" fieldName="ref_description"/>
				<Field id="44" tableName="smart_referencecode" fieldName="ref_value"/>
				<Field id="48" tableName="smart_eqtoppan" fieldName="eqtop_branch"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<ImageLink id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsbranchImageLink1" hrefSource="printrptbranch.ccp">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="52" sourceType="URL" format="yyyy-mm-dd" name="month" source="month"/>
				<LinkParameter id="53" sourceType="URL" format="yyyy-mm-dd" name="year" source="year"/>
				<LinkParameter id="54" sourceType="URL" format="yyyy-mm-dd" name="set" source="set"/>
				<LinkParameter id="55" sourceType="Expression" format="yyyy-mm-dd" name="print" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</ImageLink>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="reportsbranch_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="reportsbranch.php" forShow="True" url="reportsbranch.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="50"/>
			</Actions>
		</Event>
	</Events>
</Page>
