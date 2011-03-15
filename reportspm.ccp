<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Report id="2" secured="False" enablePrint="False" showMode="Web" sourceType="Table" returnValueType="Number" linesPerWebPage="100" linesPerPhysicalPage="50" connection="SMART" dataSource="smart_eqtoppan, smart_referencecode" name="smart_eqtoppan_smart_prev1" pageSizeLimit="100" wizardCaption=" Smart Eqtoppan, Smart Preventive " wizardLayoutType="GroupLeft" orderBy="eqtop_branch, eqtop_toppan">
			<Components>
				<Section id="10" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="11" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="13" visible="True" lines="0" name="state_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="14" visible="True" lines="1" name="Detail" pasteActions="pasteActions">
					<Components>
						<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="True" resetAt="Report" name="state" fieldSource="ref_type" wizardCaption="eqtop_branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportspmsmart_eqtoppan_smart_prev1Detailstate">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="45" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Label>
						<ReportLabel id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="Report_Row_Number" function="Count" wizardAlign="right" wizardCaption="#" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportspmsmart_eqtoppan_smart_prev1DetailReport_Row_Number">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="24" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="eqtop_toppan" fieldSource="eqtop_toppan" wizardCaption="eqtop_toppan" wizardSize="4" wizardMaxLength="4" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportspmsmart_eqtoppan_smart_prev1Detaileqtop_toppan">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="25" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="prvt_date" fieldSource="prvt_date" wizardCaption="prvt_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportspmsmart_eqtoppan_smart_prev1Detailprvt_date">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="34" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="26" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="prvt_byuser" fieldSource="prvt_byuser" wizardCaption="prvt_byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="reportspmsmart_eqtoppan_smart_prev1Detailprvt_byuser">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="32" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="27" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="prvt_byuser2" fieldSource="prvt_byuser2" wizardCaption="prvt_byuser2" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportspmsmart_eqtoppan_smart_prev1Detailprvt_byuser2">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="33" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="28" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="prvt_report" wizardCaption="prvt_site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportspmsmart_eqtoppan_smart_prev1Detailprvt_report">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="35" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="23" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="branch" wizardCaption="prvt_state" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="reportspmsmart_eqtoppan_smart_prev1Detailbranch" fieldSource="eqtop_branch">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="30" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Hidden id="37" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="branchcode" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportspmsmart_eqtoppan_smart_prev1Detailbranchcode" fieldSource="eqtop_branch">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="38" eventType="Server"/>
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
				<Section id="15" visible="True" lines="0" name="state_Footer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="16" visible="True" lines="0" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="17" visible="True" name="NoRecords" wizardNoRecords="No records">
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
				<Section id="18" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<ReportLabel id="19" fieldSourceType="SpecialValue" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="Report_CurrentDateTime" fieldSource="CurrentDateTime" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardInsertToDateTD="True" PathID="reportspmsmart_eqtoppan_smart_prev1Page_FooterReport_CurrentDateTime">
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
						<Action actionName="Custom Code" actionCategory="General" id="29" eventType="Server"/>
						<Action actionName="Set Row Style" actionCategory="General" id="31" styles="Row;AltRow" name="Row" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="3" tableName="smart_eqtoppan" posLeft="10" posTop="10" posWidth="130" posHeight="136"/>
				<JoinTable id="39" tableName="smart_referencecode" posLeft="161" posTop="10" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="40" tableLeft="smart_eqtoppan" tableRight="smart_referencecode" fieldLeft="smart_eqtoppan.eqtop_branch" fieldRight="smart_referencecode.ref_value" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="41" tableName="smart_eqtoppan" fieldName="smart_eqtoppan.*"/>
				<Field id="44" tableName="smart_referencecode" fieldName="ref_type"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<ReportGroups>
				<ReportGroup id="43" name="state" field="ref_type" sqlField="smart_referencecode.ref_type" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
		<ImageLink id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportspmImageLink1" hrefSource="printrptpm.ccp">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="47" sourceType="URL" format="yyyy-mm-dd" name="year" source="year"/>
				<LinkParameter id="48" sourceType="URL" format="yyyy-mm-dd" name="set" source="set"/>
				<LinkParameter id="49" sourceType="Expression" format="yyyy-mm-dd" name="print" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</ImageLink>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="reportspm.php" forShow="True" url="reportspm.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="reportspm_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
