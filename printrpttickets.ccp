<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Report id="2" secured="False" enablePrint="True" showMode="Web" sourceType="Table" returnValueType="Number" linesPerWebPage="20000" linesPerPhysicalPage="20000" connection="SMART" dataSource="smart_ticket, smart_resolutionnote" name="RTicket" pageSizeLimit="20000" wizardCaption=" Smart Ticket, Smart Resolutionnote " wizardLayoutType="GroupAbove" orderBy="tckt_r_date" activeCollection="TableParameters">
			<Components>
				<Section id="26" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader" pasteActions="pasteActions">
					<Components>
						<ReportLabel id="70" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="hdrmonth" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTicketReport_Headerhdrmonth">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="71"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="37" fieldSourceType="SpecialValue" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="Report_CurrentDateTime" fieldSource="CurrentDateTime" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardInsertToDateTD="True" PathID="RTicketReport_HeaderReport_CurrentDateTime">
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
				<Section id="27" visible="True" lines="0" name="Page_Header" wizardSectionType="PageHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="29" visible="True" lines="2" name="tckt_refnumber_Header" pasteActions="pasteActions">
					<Components>
						<ReportLabel id="50" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_site" fieldSource="tckt_site" wizardCaption="tckt_site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTickettckt_refnumber_Headertckt_site">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="58" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="48" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_r_date" fieldSource="tckt_r_date" wizardCaption="tckt_r_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTickettckt_refnumber_Headertckt_r_date" format="GeneralDate">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="57" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="Age" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTickettckt_refnumber_HeaderAge">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="72"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Hidden id="54" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="tckt_c_date" fieldSource="tckt_c_date" wizardCaption="tckt_c_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTickettckt_refnumber_Headertckt_c_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ReportLabel id="47" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_engineer" fieldSource="tckt_engineer" wizardCaption="tckt_engineer" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTickettckt_refnumber_Headertckt_engineer">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Hidden id="73" fieldSourceType="DBColumn" dataType="Text" name="state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTickettckt_refnumber_Headerstate" fieldSource="tckt_state">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ReportLabel id="74" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_refnumber" fieldSource="tckt_refnumber" PathID="RTickettckt_refnumber_Headertckt_refnumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="75" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_cat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTickettckt_refnumber_Headertckt_cat" fieldSource="tckt_category">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="76"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="79" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="tckt_subcat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTickettckt_refnumber_Headertckt_subcat" fieldSource="tckt_subcategory">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="80"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="51" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_severity" fieldSource="tckt_severity" wizardCaption="tckt_severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="RTickettckt_refnumber_Headertckt_severity">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="60" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Hidden id="81" fieldSourceType="DBColumn" dataType="Text" name="hidecat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTickettckt_refnumber_Headerhidecat" fieldSource="tckt_category">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ReportLabel id="49" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_r_adukomid" fieldSource="tckt_r_adukomid" wizardCaption="tckt_r_adukomid" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTickettckt_refnumber_Headertckt_r_adukomid">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="52" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="tckt_adukomn" fieldSource="tckt_adukomn" wizardCaption="tckt_adukomn" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTickettckt_refnumber_Headertckt_adukomn">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="46" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tckt_status" fieldSource="tckt_status" wizardCaption="tckt_status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="RTickettckt_refnumber_Headertckt_status">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="59" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
<ReportLabel id="77" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="tckt_method" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTickettckt_refnumber_Headertckt_method" fieldSource="tckt_c_method">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="78" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
<ReportLabel id="101" fieldSourceType="DBColumn" dataType="Text" html="True" hideDuplicates="False" resetAt="Report" name="tckt_description" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTickettckt_refnumber_Headertckt_description" fieldSource="tckt_description">
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
				<Section id="30" visible="True" lines="1" name="Detail" pasteActions="pasteActions">
					<Components>
						<ReportLabel id="41" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_byuser" fieldSource="rsltn_byuser" wizardCaption="rsltn_byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="RTicketDetailrsltn_byuser">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="56" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="44" fieldSourceType="DBColumn" dataType="Memo" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" wizardCaption="rsltn_actiontaken" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTicketDetailrsltn_actiontaken">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="45" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_date" fieldSource="rsltn_date" wizardCaption="rsltn_date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTicketDetailrsltn_date" format="GeneralDate">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="82"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="42" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="rsltn_eta" fieldSource="rsltn_eta" wizardCaption="rsltn_eta" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="RTicketDetailrsltn_eta" format="GeneralDate">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="83"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="65" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="ActionPlan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTicketDetailActionPlan" fieldSource="rsltn_planning">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="68" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="Remark" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTicketDetailRemark" fieldSource="rsltn_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Hidden id="84" fieldSourceType="DBColumn" dataType="Text" name="rsltn_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTicketDetailrsltn_type" fieldSource="rsltn_type">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ReportLabel id="63" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="SpartOk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTicketDetailSpartOk">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="64" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="EqOk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTicketDetailEqOk">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<Hidden id="85" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="Attachment" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RTicketDetailAttachment">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="31" visible="True" lines="0" name="tckt_refnumber_Footer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="32" visible="True" lines="0" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="33" visible="True" name="NoRecords" wizardNoRecords="No records">
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
				<Section id="34" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<Panel id="36" visible="True" name="PageBreak">
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
			</Components>
			<Events>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="86"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="87"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="88"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="89" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_state" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s"/>
				<TableParameter id="90" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_severity" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="sv"/>
				<TableParameter id="91" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_escalate" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="esc"/>
				<TableParameter id="92" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_category" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="cat"/>
				<TableParameter id="93" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_subcategory" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="scat"/>
				<TableParameter id="94" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_adukomn" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="ad"/>
				<TableParameter id="95" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_refnumber" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="rn"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
				<JoinTable id="14" tableName="smart_resolutionnote" posLeft="191" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="55" tableLeft="smart_ticket" tableRight="smart_resolutionnote" fieldLeft="smart_ticket.id" fieldRight="smart_resolutionnote.ticket_id" joinType="left" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="4" tableName="smart_ticket" fieldName="tckt_refnumber"/>
				<Field id="5" tableName="smart_ticket" fieldName="tckt_status"/>
				<Field id="6" tableName="smart_ticket" fieldName="tckt_engineer"/>
				<Field id="7" tableName="smart_ticket" fieldName="tckt_r_date"/>
				<Field id="8" tableName="smart_ticket" fieldName="tckt_site"/>
				<Field id="9" tableName="smart_ticket" fieldName="tckt_severity"/>
				<Field id="10" tableName="smart_ticket" fieldName="tckt_adukomn"/>
				<Field id="11" tableName="smart_ticket" fieldName="tckt_equipment"/>
				<Field id="12" tableName="smart_ticket" fieldName="tckt_c_date"/>
				<Field id="13" tableName="smart_ticket" fieldName="tckt_r_adukomid"/>
				<Field id="18" tableName="smart_resolutionnote" fieldName="rsltn_date"/>
				<Field id="19" tableName="smart_resolutionnote" fieldName="rsltn_byuser"/>
				<Field id="20" tableName="smart_resolutionnote" fieldName="rsltn_eta"/>
				<Field id="21" tableName="smart_resolutionnote" fieldName="rsltn_etd"/>
				<Field id="22" tableName="smart_resolutionnote" fieldName="rsltn_actiontaken"/>
				<Field id="62" tableName="smart_ticket" fieldName="tckt_description"/>
				<Field id="66" tableName="smart_resolutionnote" fieldName="rsltn_planning"/>
				<Field id="67" tableName="smart_resolutionnote" fieldName="rsltn_remark"/>
				<Field id="96" tableName="smart_ticket" fieldName="tckt_state"/>
				<Field id="97" tableName="smart_resolutionnote" fieldName="rsltn_type"/>
				<Field id="98" tableName="smart_ticket" fieldName="tckt_category"/>
				<Field id="99" tableName="smart_ticket" fieldName="tckt_subcategory"/>
				<Field id="100" tableName="smart_ticket" fieldName="tckt_c_method"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<ReportGroups>
				<ReportGroup id="28" name="tckt_refnumber" field="tckt_refnumber" sqlField="smart_ticket.tckt_refnumber" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="printrpttickets.php" forShow="True" url="printrpttickets.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="printrpttickets_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="69"/>
			</Actions>
		</Event>
	</Events>
</Page>
