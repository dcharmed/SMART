<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Report id="2" secured="False" enablePrint="False" showMode="Web" sourceType="Table" returnValueType="Number" linesPerWebPage="100" linesPerPhysicalPage="50" connection="SMART" dataSource="smart_eqtoppan, smart_referencecode" name="smart_eqtoppan_smart_prev1" pageSizeLimit="100" wizardCaption=" Smart Eqtoppan, Smart Preventive " wizardLayoutType="GroupLeft" orderBy="eqtop_branch, eqtop_toppan">
			<Components>
				<Section id="3" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="4" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="5" visible="True" lines="0" name="state_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="6" visible="True" lines="1" name="Detail" pasteActions="pasteActions">
					<Components>
						<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="True" resetAt="Report" name="state" fieldSource="ref_type" wizardCaption="eqtop_branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="smart_eqtoppan_smart_prev1Detailstate">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="8"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Label>
						<ReportLabel id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="Report_Row_Number" function="Count" wizardAlign="right" wizardCaption="#" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="smart_eqtoppan_smart_prev1DetailReport_Row_Number">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="10" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="eqtop_toppan" fieldSource="eqtop_toppan" wizardCaption="eqtop_toppan" wizardSize="4" wizardMaxLength="4" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="smart_eqtoppan_smart_prev1Detaileqtop_toppan">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="11" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="prvt_date" fieldSource="prvt_date" wizardCaption="prvt_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="smart_eqtoppan_smart_prev1Detailprvt_date">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="12"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="13" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="prvt_byuser" fieldSource="prvt_byuser" wizardCaption="prvt_byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="smart_eqtoppan_smart_prev1Detailprvt_byuser">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="14"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="15" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="prvt_byuser2" fieldSource="prvt_byuser2" wizardCaption="prvt_byuser2" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="smart_eqtoppan_smart_prev1Detailprvt_byuser2">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="16"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="17" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="prvt_report" wizardCaption="prvt_site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="smart_eqtoppan_smart_prev1Detailprvt_report">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="18"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="19" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="branch" wizardCaption="prvt_state" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="smart_eqtoppan_smart_prev1Detailbranch" fieldSource="eqtop_branch">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="20"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Hidden id="21" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="branchcode" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_eqtoppan_smart_prev1Detailbranchcode" fieldSource="eqtop_branch">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="22" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="23" visible="True" lines="0" name="state_Footer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="24" visible="True" lines="0" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="25" visible="True" name="NoRecords" wizardNoRecords="No records">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="26" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<ReportLabel id="27" fieldSourceType="SpecialValue" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="Report_CurrentDateTime" fieldSource="CurrentDateTime" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardInsertToDateTD="True" PathID="smart_eqtoppan_smart_prev1Page_FooterReport_CurrentDateTime">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="28"/>
						<Action actionName="Set Row Style" actionCategory="General" id="29" styles="Row;AltRow" name="Row" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="30" tableName="smart_eqtoppan" posLeft="10" posTop="10" posWidth="130" posHeight="136"/>
				<JoinTable id="31" tableName="smart_referencecode" posLeft="161" posTop="10" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="32" tableLeft="smart_eqtoppan" tableRight="smart_referencecode" fieldLeft="smart_eqtoppan.eqtop_branch" fieldRight="smart_referencecode.ref_value" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="33" tableName="smart_eqtoppan" fieldName="smart_eqtoppan.*"/>
				<Field id="34" tableName="smart_referencecode" fieldName="ref_type"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<ReportGroups>
				<ReportGroup id="35" name="state" field="ref_type" sqlField="smart_referencecode.ref_type" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
<Panel id="39" visible="True" name="PanHeadPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanHeadPage" pasteActions="pasteActions">
<Components>
<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblMonth" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanHeadPagelblMonth">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanHeadPagelblYear">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<Attributes/>
<Features/>
</Panel>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="printrptpm.php" forShow="True" url="printrptpm.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="printrptpm_events.php" forShow="False" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
<Event name="AfterInitialize" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="38"/>
</Actions>
</Event>
</Events>
</Page>
