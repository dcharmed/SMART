<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes">
	<Components>
		<Report id="2" secured="False" enablePrint="False" showMode="Web" sourceType="Table" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" name="RepTickets" connection="SMART" dataSource="smart_ticket, smart_resolutionnote" pageSizeLimit="100" activeCollection="TableParameters">
			<Components>
				<Section id="3" visible="True" lines="0" name="Report_Header">
					<Components>
						<ReportLabel id="4" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="Report_TotalRecords" function="Count" PathID="rptticketrnRepTicketsReport_HeaderReport_TotalRecords">
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
				<Section id="5" visible="True" lines="0" name="Page_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="6" visible="True" lines="2" name="tckt_refnumber_Header">
					<Components>
						<ReportLabel id="7" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_refnumber" fieldSource="tckt_refnumber" PathID="rptticketrnRepTicketstckt_refnumber_Headertckt_refnumber">
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
				<Section id="8" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="Report_Row_Number" function="Count" PathID="rptticketrnRepTicketsDetailReport_Row_Number">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_byuser" fieldSource="rsltn_byuser" PathID="rptticketrnRepTicketsDetailrsltn_byuser">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="11" fieldSourceType="DBColumn" dataType="Memo" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" PathID="rptticketrnRepTicketsDetailrsltn_actiontaken">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="12" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_date" fieldSource="rsltn_date" format="GeneralDate" PathID="rptticketrnRepTicketsDetailrsltn_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="13" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="tckt_status" fieldSource="tckt_status" PathID="rptticketrnRepTicketsDetailtckt_status">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="14" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_escalate" fieldSource="tckt_escalate" PathID="rptticketrnRepTicketsDetailtckt_escalate">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="15" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_r_date" fieldSource="tckt_r_date" format="GeneralDate" PathID="rptticketrnRepTicketsDetailtckt_r_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="16" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_site" fieldSource="tckt_site" PathID="rptticketrnRepTicketsDetailtckt_site">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="tckt_severity" fieldSource="tckt_severity" PathID="rptticketrnRepTicketsDetailtckt_severity">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="18" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_adukomn" fieldSource="tckt_adukomn" PathID="rptticketrnRepTicketsDetailtckt_adukomn">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="19" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_category" fieldSource="tckt_category" PathID="rptticketrnRepTicketsDetailtckt_category">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="20" fieldSourceType="DBColumn" dataType="Memo" html="False" hideDuplicates="False" resetAt="Report" name="tckt_description" fieldSource="tckt_description" PathID="rptticketrnRepTicketsDetailtckt_description">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="21" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_c_date" fieldSource="tckt_c_date" format="GeneralDate" PathID="rptticketrnRepTicketsDetailtckt_c_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="22" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_eta" fieldSource="rsltn_eta" PathID="rptticketrnRepTicketsDetailrsltn_eta">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="23" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_etd" fieldSource="rsltn_etd" PathID="rptticketrnRepTicketsDetailrsltn_etd">
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
				<Section id="24" visible="True" lines="0" name="tckt_refnumber_Footer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="25" visible="True" lines="0" name="Report_Footer">
					<Components>
						<Panel id="26" visible="True" name="NoRecords">
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
				<Section id="27" visible="True" lines="1" name="Page_Footer">
					<Components>
						<ReportLabel id="28" fieldSourceType="SpecialValue" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="Report_CurrentDateTime" fieldSource="CurrentDateTime" PathID="rptticketrnRepTicketsPage_FooterReport_CurrentDateTime">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Navigator id="29" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="30" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression" eventType="Server"/>
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
			<TableParameters>
<TableParameter id="50" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_state" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s"/>
<TableParameter id="51" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_site" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="b"/>
<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_severity" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="sv"/>
<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_escalate" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="esc"/>
<TableParameter id="54" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_category" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="cat"/>
<TableParameter id="55" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_subcategory" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="scat"/>
<TableParameter id="56" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_r_date" dataType="Date" searchConditionType="GreaterThanOrEqual" parameterType="URL" logicOperator="And" parameterSource="dtfr"/>
<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_r_date" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" parameterSource="dtto"/>
<TableParameter id="58" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_adukomn" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="ad"/>
<TableParameter id="59" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_refnumber" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="rn"/>
</TableParameters>
			<JoinTables>
				<JoinTable id="31" tableName="smart_ticket" posWidth="160" posHeight="180" posLeft="10" posTop="10"/>
				<JoinTable id="32" tableName="smart_resolutionnote" posWidth="160" posHeight="180" posLeft="191" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="33" tableLeft="smart_ticket" fieldLeft="smart_ticket.id" tableRight="smart_resolutionnote" fieldRight="smart_resolutionnote.ticket_id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="34" tableName="smart_ticket" fieldName="tckt_refnumber"/>
				<Field id="35" tableName="smart_ticket" fieldName="tckt_status"/>
				<Field id="36" tableName="smart_ticket" fieldName="tckt_escalate"/>
				<Field id="37" tableName="smart_ticket" fieldName="tckt_r_date"/>
				<Field id="38" tableName="smart_ticket" fieldName="tckt_site"/>
				<Field id="39" tableName="smart_ticket" fieldName="tckt_severity"/>
				<Field id="40" tableName="smart_ticket" fieldName="tckt_adukomn"/>
				<Field id="41" tableName="smart_ticket" fieldName="tckt_category"/>
				<Field id="42" tableName="smart_ticket" fieldName="tckt_description"/>
				<Field id="43" tableName="smart_ticket" fieldName="tckt_c_date"/>
				<Field id="44" tableName="smart_resolutionnote" fieldName="rsltn_date"/>
				<Field id="45" tableName="smart_resolutionnote" fieldName="rsltn_byuser"/>
				<Field id="46" tableName="smart_resolutionnote" fieldName="rsltn_actiontaken"/>
				<Field id="47" tableName="smart_resolutionnote" fieldName="rsltn_eta"/>
				<Field id="48" tableName="smart_resolutionnote" fieldName="rsltn_etd"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<ReportGroups>
				<ReportGroup id="49" name="tckt_refnumber" field="tckt_refnumber" sqlField="smart_ticket.tckt_refnumber" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="rptticketrn_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="rptticketrn.php" forShow="True" url="rptticketrn.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
<CachingParameters/>
<Attributes/>
<Features/>
<Events/>
</Page>
