<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" pasteActions="pasteActions" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_referencecode" name="TcktSummary" pageSizeLimit="100" wizardCaption="List of Smart Referencecode " wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Link id="3" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="ref_description" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummaryref_description" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketlist.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="19" sourceType="DataField" name="s_status" source="ref_value"/>
					</LinkParameters>
				</Link>
				<Link id="4" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tcktcritical" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummarytcktcritical" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketlist.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="21" sourceType="DataField" name="s_status" source="ref_value"/>
						<LinkParameter id="42" sourceType="Expression" name="s_svr" source="1"/>
					</LinkParameters>
				</Link>
				<Hidden id="20" fieldSourceType="DBColumn" dataType="Text" name="status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbarTcktSummarystatus" fieldSource="ref_value">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="29" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tcktmajor" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummarytcktmajor" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketlist.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="30" sourceType="DataField" name="s_status" source="ref_value"/>
						<LinkParameter id="43" sourceType="Expression" name="s_svr" source="2"/>
					</LinkParameters>
				</Link>
				<Link id="31" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tcktminor" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummarytcktminor" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketlist.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="32" sourceType="DataField" name="s_status" source="ref_value"/>
						<LinkParameter id="44" sourceType="Expression" name="s_svr" source="3"/>
					</LinkParameters>
				</Link>
				<Link id="33" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tcktinfo" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummarytcktinfo" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketlist.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="34" sourceType="DataField" name="s_status" source="ref_value"/>
						<LinkParameter id="45" sourceType="Expression" name="s_svr" source="4"/>
					</LinkParameters>
				</Link>
				<Link id="35" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckttotal" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummarytckttotal" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketlist.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="36" sourceType="DataField" name="s_status" source="ref_value"/>
					</LinkParameters>
				</Link>
				<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" name="totcritical" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbarTcktSummarytotcritical">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Integer" html="False" name="totmajor" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbarTcktSummarytotmajor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Integer" html="False" name="totminor" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbarTcktSummarytotminor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Integer" html="False" name="totinfo" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbarTcktSummarytotinfo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Integer" html="False" name="Gtotal" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbarTcktSummaryGtotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="5"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="tcktstatus"/>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="ref_value" dataType="Text" searchConditionType="NotEqual" parameterType="Expression" logicOperator="And" parameterSource="3"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="6" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="9" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_task, smart_ticket" activeCollection="TableParameters" name="GTask" pageSizeLimit="100" wizardCaption="List of Smart Task " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
			<Components>
				<Link id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ticket_id" fieldSource="ticket_id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="rightbarGTaskticket_id" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="taskactivity.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="27" sourceType="DataField" name="tcktid" source="ticket_id"/>
						<LinkParameter id="28" sourceType="Expression" name="det" source="1"/>
					</LinkParameters>
				</Link>
				<Label id="16" fieldSourceType="DBColumn" dataType="Date" html="False" name="task_date" fieldSource="task_date" wizardCaption="Task Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarGTasktask_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="task_site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbarGTasktask_site" fieldSource="tckt_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="17"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="18"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="smart_task.task_status" dataType="Text" searchConditionType="LessThan" parameterType="Expression" logicOperator="And" parameterSource="1" leftBrackets="0" rightBrackets="0"/>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="smart_task.task_currenteng" dataType="Integer" searchConditionType="Equal" parameterType="Session" logicOperator="Or" rightBrackets="0" leftBrackets="1" parameterSource="UserID"/>
				<TableParameter id="13" conditionType="Parameter" useIsNull="True" field="smart_task.task_updatedeng" dataType="Integer" searchConditionType="Equal" parameterType="Session" logicOperator="And" leftBrackets="0" rightBrackets="1" parameterSource="UserID"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="10" tableName="smart_task" posLeft="10" posTop="10" posWidth="131" posHeight="180"/>
				<JoinTable id="23" tableName="smart_ticket" posLeft="162" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="24" tableLeft="smart_task" tableRight="smart_ticket" fieldLeft="smart_task.ticket_id" fieldRight="smart_ticket.id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="25" tableName="smart_task" fieldName="smart_task.*"/>
				<Field id="26" tableName="smart_ticket" fieldName="tckt_site"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="rightbar.php" forShow="True" url="rightbar.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="rightbar_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
