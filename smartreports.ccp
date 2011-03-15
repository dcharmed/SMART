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
		<Report id="5" secured="False" enablePrint="False" showMode="Web" sourceType="Table" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" name="RepTickets" connection="SMART" dataSource="smart_ticket, smart_resolutionnote" pageSizeLimit="100">
			<Components>
				<Section id="23" visible="True" lines="0" name="Report_Header">
					<Components>
						<ReportLabel id="32" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="Report_TotalRecords" function="Count" PathID="RepTicketsReport_HeaderReport_TotalRecords">
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
				<Section id="24" visible="True" lines="0" name="Page_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="26" visible="True" lines="2" name="tckt_refnumber_Header" pasteActions="pasteActions">
					<Components>
						<ReportLabel id="33" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_refnumber" fieldSource="tckt_refnumber" PathID="RepTicketstckt_refnumber_Headertckt_refnumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="44" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_site" fieldSource="tckt_site" PathID="RepTicketstckt_refnumber_Headertckt_site">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
<ReportLabel id="43" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_r_date" fieldSource="tckt_r_date" format="GeneralDate" PathID="RepTicketstckt_refnumber_Headertckt_r_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
<Hidden id="49" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_c_date" fieldSource="tckt_c_date" format="GeneralDate" PathID="RepTicketstckt_refnumber_Headertckt_c_date">
<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
<ReportLabel id="45" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="tckt_severity" fieldSource="tckt_severity" PathID="RepTicketstckt_refnumber_Headertckt_severity">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
<ReportLabel id="46" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_adukomn" fieldSource="tckt_adukomn" PathID="RepTicketstckt_refnumber_Headertckt_adukomn">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
<ReportLabel id="41" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="tckt_status" fieldSource="tckt_status" PathID="RepTicketstckt_refnumber_Headertckt_status">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
<ReportLabel id="55" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="Age" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RepTicketstckt_refnumber_HeaderAge">
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
				<Section id="27" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="Report_Row_Number" function="Count" PathID="RepTicketsDetailReport_Row_Number">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="38" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_byuser" fieldSource="rsltn_byuser" PathID="RepTicketsDetailrsltn_byuser">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="39" fieldSourceType="DBColumn" dataType="Memo" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" PathID="RepTicketsDetailrsltn_actiontaken">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="40" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_date" fieldSource="rsltn_date" format="GeneralDate" PathID="RepTicketsDetailrsltn_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="42" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_escalate" fieldSource="tckt_escalate" PathID="RepTicketsDetailtckt_escalate">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="47" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_category" fieldSource="tckt_category" PathID="RepTicketsDetailtckt_category">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="48" fieldSourceType="DBColumn" dataType="Memo" html="False" hideDuplicates="False" resetAt="Report" name="tckt_description" fieldSource="tckt_description" PathID="RepTicketsDetailtckt_description">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="52" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_eta" fieldSource="rsltn_eta" PathID="RepTicketsDetailrsltn_eta">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="53" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_etd" fieldSource="rsltn_etd" PathID="RepTicketsDetailrsltn_etd">
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
				<Section id="28" visible="True" lines="0" name="tckt_refnumber_Footer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="29" visible="True" lines="0" name="Report_Footer">
					<Components>
						<Panel id="30" visible="True" name="NoRecords">
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
				<Section id="31" visible="True" lines="1" name="Page_Footer">
					<Components>
						<ReportLabel id="34" fieldSourceType="SpecialValue" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="Report_CurrentDateTime" fieldSource="CurrentDateTime" PathID="RepTicketsPage_FooterReport_CurrentDateTime">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Navigator id="35" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="54" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Navigator>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="6" tableName="smart_ticket" posWidth="160" posHeight="180" posLeft="10" posTop="10"/>
				<JoinTable id="7" tableName="smart_resolutionnote" posWidth="160" posHeight="180" posLeft="191" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="8" tableLeft="smart_ticket" fieldLeft="smart_ticket.id" tableRight="smart_resolutionnote" fieldRight="smart_resolutionnote.ticket_id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="9" tableName="smart_ticket" fieldName="tckt_refnumber"/>
				<Field id="11" tableName="smart_ticket" fieldName="tckt_status"/>
				<Field id="12" tableName="smart_ticket" fieldName="tckt_escalate"/>
				<Field id="13" tableName="smart_ticket" fieldName="tckt_r_date"/>
				<Field id="14" tableName="smart_ticket" fieldName="tckt_site"/>
				<Field id="15" tableName="smart_ticket" fieldName="tckt_severity"/>
				<Field id="16" tableName="smart_ticket" fieldName="tckt_adukomn"/>
				<Field id="17" tableName="smart_ticket" fieldName="tckt_category"/>
				<Field id="18" tableName="smart_ticket" fieldName="tckt_description"/>
				<Field id="19" tableName="smart_ticket" fieldName="tckt_c_date"/>
				<Field id="20" tableName="smart_resolutionnote" fieldName="rsltn_date"/>
				<Field id="21" tableName="smart_resolutionnote" fieldName="rsltn_byuser"/>
				<Field id="22" tableName="smart_resolutionnote" fieldName="rsltn_actiontaken"/>
				<Field id="50" tableName="smart_resolutionnote" fieldName="rsltn_eta"/>
				<Field id="51" tableName="smart_resolutionnote" fieldName="rsltn_etd"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<ReportGroups>
				<ReportGroup id="25" name="tckt_refnumber" field="tckt_refnumber" sqlField="smart_ticket.tckt_refnumber" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartreports.php" forShow="True" url="smartreports.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartreports_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
