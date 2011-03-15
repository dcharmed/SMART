<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
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
		<Grid id="77" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_ticket, smart_task" name="GSmartTicket" pageSizeLimit="100" wizardCaption="List of Smart Ticket " wizardGridType="Tabular" wizardSortingType="Extended" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" orderBy="smart_ticket.tckt_r_date" groupBy="ticket_id" pasteActions="pasteActions">
			<Components>
				<Sorter id="80" visible="True" name="Sorter_tckt_refnumber" column="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSortingType="Extended" wizardControl="tckt_refnumber" wizardAddNbsp="False" PathID="GSmartTicketSorter_tckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="81" visible="True" name="Sorter_tckt_status" column="tckt_status" wizardCaption="Tckt Status" wizardSortingType="Extended" wizardControl="tckt_status" wizardAddNbsp="False" PathID="GSmartTicketSorter_tckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="82" visible="True" name="Sorter_tckt_date" column="tckt_date" wizardCaption="Tckt Date" wizardSortingType="Extended" wizardControl="tckt_date" wizardAddNbsp="False" PathID="GSmartTicketSorter_tckt_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="83" visible="True" name="Sorter_tckt_branch" column="tckt_branch" wizardCaption="Tckt Branch" wizardSortingType="Extended" wizardControl="tckt_branch" wizardAddNbsp="False" PathID="GSmartTicketSorter_tckt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="86" visible="True" name="Sorter_tckt_helpdesk" column="tckt_r_helpdesk" wizardCaption="Tckt Esc" wizardSortingType="Extended" wizardControl="tckt_esc" wizardAddNbsp="False" PathID="GSmartTicketSorter_tckt_helpdesk">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Hidden id="87" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSmartTicketid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="88" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_refnumber" fieldSource="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartTickettckt_refnumber" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="taskactivity.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="89" sourceType="DataField" name="tcktid" source="ticket_id"/>
						<LinkParameter id="129" sourceType="Expression" name="det" source="1"/>
					</LinkParameters>
				</Link>
				<Label id="90" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_status" fieldSource="tckt_status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSmartTickettckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Date" html="False" name="tckt_date" fieldSource="tckt_r_date" wizardCaption="Tckt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartTickettckt_date" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="92" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_branch" fieldSource="tckt_site" wizardCaption="Tckt Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartTickettckt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="95" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_helpdesk" fieldSource="tckt_r_helpdesk" wizardCaption="Tckt Esc" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartTickettckt_helpdesk">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="96" fieldSourceType="DBColumn" dataType="Memo" html="False" name="tckt_description" fieldSource="tckt_description" wizardCaption="Tckt Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartTickettckt_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="97" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="98" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" PathID="GSmartTicketlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="99" fieldSourceType="DBColumn" dataType="Text" name="tckt_state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTickettckt_state" fieldSource="tckt_state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="100" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_age" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTickettckt_age">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="101" fieldSourceType="DBColumn" dataType="Text" html="False" name="tcktEng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTickettcktEng" fieldSource="task_currenteng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="152" visible="True" name="Sorter_tckt_eng" column="tckt_status" wizardCaption="Tckt Status" wizardSortingType="Extended" wizardControl="tckt_status" wizardAddNbsp="False" PathID="GSmartTicketSorter_tckt_eng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Hidden id="153" fieldSourceType="DBColumn" dataType="Date" name="tckt_closeddate" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTickettckt_closeddate" fieldSource="tckt_c_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="102" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="50" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="103"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="128" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_status" dataType="Integer" searchConditionType="LessThan" parameterType="Expression" logicOperator="And" parameterSource="7"/>
				<TableParameter id="121" conditionType="Parameter" useIsNull="False" field="smart_task.task_status" dataType="Integer" searchConditionType="LessThan" parameterType="Expression" logicOperator="Or" leftBrackets="1" rightBrackets="0" parameterSource="1"/>
				<TableParameter id="150" conditionType="Parameter" useIsNull="False" field="smart_task.task_status" dataType="Integer" searchConditionType="GreaterThan" parameterType="Expression" logicOperator="And" leftBrackets="0" rightBrackets="1" parameterSource="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="108" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
				<JoinTable id="117" tableName="smart_task" posLeft="191" posTop="10" posWidth="131" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="151" tableLeft="smart_ticket" tableRight="smart_task" fieldLeft="smart_ticket.id" fieldRight="smart_task.ticket_id" joinType="right" conditionType="Equal"/>
			</JoinLinks>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_task, smart_ticket" name="GSmartTask" pageSizeLimit="100" wizardCaption="List of Smart Task " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters" pasteActions="pasteActions">
			<Components>
				<Sorter id="8" visible="True" name="Sorter_ticket_id" column="ticket_id" wizardCaption="Ticket Id" wizardSortingType="SimpleDir" wizardControl="ticket_id" wizardAddNbsp="False" PathID="GSmartTaskSorter_ticket_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="9" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id" wizardAddNbsp="False" PathID="GSmartTaskSorter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_task_status" column="task_status" wizardCaption="Task Update" wizardSortingType="SimpleDir" wizardControl="task_update" wizardAddNbsp="False" PathID="GSmartTaskSorter_task_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_task_currenteng" column="task_currenteng" wizardCaption="Task Currenteng" wizardSortingType="SimpleDir" wizardControl="task_currenteng" wizardAddNbsp="False" PathID="GSmartTaskSorter_task_currenteng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_task_updatedeng" column="task_updatedeng" wizardCaption="Task Updatedeng" wizardSortingType="SimpleDir" wizardControl="task_updatedeng" wizardAddNbsp="False" PathID="GSmartTaskSorter_task_updatedeng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ticket_id" fieldSource="tckt_refnumber" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="taskactivity.ccp" wizardThemeItem="GridA" PathID="GSmartTaskticket_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="19" sourceType="URL" format="yyyy-mm-dd" name="tcktid" source="tcktid"/>
						<LinkParameter id="109" sourceType="DataField" name="tid" source="smart_task_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSmartTasklblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="task_status" fieldSource="task_status" wizardCaption="Task Update" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartTasktask_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Integer" html="False" name="task_currenteng" fieldSource="task_currenteng" wizardCaption="Task Currenteng" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSmartTasktask_currenteng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" name="task_updatedeng" fieldSource="task_updatedeng" wizardCaption="Task Updatedeng" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSmartTasktask_updatedeng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="35" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="71" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_severity" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTasktckt_severity" fieldSource="tckt_severity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTasktckt_site" fieldSource="tckt_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="111" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="lblView" fieldSource="tckt_refnumber" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="taskactivity.ccp" wizardThemeItem="GridA" PathID="GSmartTasklblView">
					<Components/>
					<Events/>
					<LinkParameters>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Hidden id="74" fieldSourceType="DBColumn" dataType="Text" name="tckt_state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTasktckt_state" fieldSource="tckt_state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="114" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblTicket" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTasklblTicket" fieldSource="tckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="177" fieldSourceType="DBColumn" dataType="Text" name="task_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTasktask_id" fieldSource="smart_task_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="187" fieldSourceType="DBColumn" dataType="Text" html="True" name="task_remark" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartTasktask_remark" fieldSource="task_notes">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="16" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="73" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="115"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="76" conditionType="Parameter" useIsNull="True" field="smart_task.ticket_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="tcktid"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="62" tableName="smart_task" posLeft="10" posTop="10" posWidth="131" posHeight="180"/>
				<JoinTable id="63" tableName="smart_ticket" posLeft="162" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="126" tableLeft="smart_task" tableRight="smart_ticket" fieldLeft="smart_task.ticket_id" fieldRight="smart_ticket.id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="6" tableName="smart_task" fieldName="smart_task.id" alias="smart_task_id"/>
				<Field id="17" tableName="smart_task" fieldName="ticket_id"/>
				<Field id="21" tableName="smart_task" fieldName="task_current"/>
				<Field id="23" tableName="smart_task" fieldName="task_update"/>
				<Field id="25" tableName="smart_task" fieldName="task_currenteng"/>
				<Field id="27" tableName="smart_task" fieldName="task_updatedeng"/>
				<Field id="29" tableName="smart_task" fieldName="task_notes"/>
				<Field id="31" tableName="smart_task" fieldName="task_date"/>
				<Field id="33" tableName="smart_task" fieldName="smart_task.datemodified" alias="smart_task_datemodified"/>
				<Field id="67" tableName="smart_ticket" fieldName="tckt_refnumber"/>
				<Field id="69" tableName="smart_ticket" fieldName="tckt_site"/>
				<Field id="70" tableName="smart_ticket" fieldName="tckt_severity"/>
				<Field id="75" tableName="smart_ticket" fieldName="tckt_state"/>
				<Field id="178" tableName="smart_task" fieldName="task_status"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="36" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RSmartTask" dataSource="smart_task" errorSummator="Error" wizardCaption="Add/Edit Smart Task " wizardFormMethod="post" PathID="RSmartTask" pasteActions="pasteActions" activeCollection="TableParameters" pasteAsReplace="pasteAsReplace">
			<Components>
				<Button id="37" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RSmartTaskButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="38" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RSmartTaskButton_Update" removeParameters="det;tid">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="149" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="39" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RSmartTaskButton_Cancel" removeParameters="tid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_current" fieldSource="task_update" required="False" caption="Task Current" wizardCaption="Task Current" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTasktask_current">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="task_notes" fieldSource="task_notes" required="False" caption="Task Notes" wizardCaption="Task Notes" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RSmartTasktask_notes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="47" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="task_date" fieldSource="task_date" required="False" caption="Task Date" wizardCaption="Task Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTasktask_date" defaultValue="CurrentDateTime" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="48" name="DatePicker_task_date" control="task_date" wizardSatellite="True" wizardControl="task_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RSmartTaskDatePicker_task_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTaskticket_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<RadioButton id="51" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="True" returnValueType="Number" name="taskStatus" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTasktaskStatus" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description" required="True" fieldSource="task_status">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="taskstatus"/>
						<TableParameter id="186" conditionType="Parameter" useIsNull="False" field="ref_value" dataType="Text" searchConditionType="NotEqual" parameterType="Expression" logicOperator="And" parameterSource="0"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="52" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="54" tableName="smart_referencecode" fieldName="ref_value"/>
						<Field id="55" tableName="smart_referencecode" fieldName="ref_description"/>
					</Fields>
					<Attributes/>
					<Features/>
				</RadioButton>
				<Hidden id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTaskdatemodified" defaultValue="CurrentDateTime" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ticketRef" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTaskticketRef">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="60" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="task_neweng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTasktask_neweng" fieldSource="task_updatedeng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="116" fieldSourceType="DBColumn" dataType="Text" html="False" name="task_currenteng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTasktask_currenteng" visible="Yes" fieldSource="task_currenteng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="58" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="61" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="40" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="tid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="56" tableName="smart_task" posLeft="10" posTop="10" posWidth="131" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="130" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="SummaryTicket" dataSource="smart_ticket" errorSummator="Error" wizardCaption="View Smart Ticket " wizardFormMethod="post" PathID="SummaryTicket" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Button id="131" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="SummaryTicketButton_Cancel" returnPage="taskactivity.ccp" removeParameters="det;tid;tcktid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="133" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_refnumber" fieldSource="tckt_refnumber" required="False" caption="Tckt Refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="134" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_status" fieldSource="tckt_status" required="True" caption="Tckt Status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="135" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_escalate" fieldSource="tckt_escalate" required="False" caption="Tckt Escalate" wizardCaption="Tckt Escalate" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_escalate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="136" fieldSourceType="DBColumn" dataType="Date" html="False" name="tckt_r_date" fieldSource="tckt_r_date" required="True" caption="Tckt R Date" wizardCaption="Tckt R Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_r_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="141" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_severity" fieldSource="tckt_severity" required="True" caption="Tckt Severity" wizardCaption="Tckt Severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_severity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="143" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_category" fieldSource="tckt_category" required="False" caption="Tckt Category" wizardCaption="Tckt Category" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_category">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="144" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_subcategory" fieldSource="tckt_subcategory" required="False" caption="Tckt Subcategory" wizardCaption="Tckt Subcategory" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_subcategory">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="145" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_tagrelated" fieldSource="tckt_tagrelated" required="False" caption="Tckt Tagrelated" wizardCaption="Tckt Tagrelated" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_tagrelated">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="146" fieldSourceType="DBColumn" dataType="Memo" html="True" name="tckt_description" fieldSource="tckt_description" required="True" caption="Tckt Description" wizardCaption="Tckt Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="137" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_r_customer" fieldSource="tckt_r_customer" required="True" caption="Tckt R Customer" wizardCaption="Tckt R Customer" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_r_customer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="138" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_r_customercontact" fieldSource="tckt_r_customercontact" required="False" caption="Tckt R Customercontact" wizardCaption="Tckt R Customercontact" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_r_customercontact">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="140" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_site" fieldSource="tckt_site" required="True" caption="Tckt Site" wizardCaption="Tckt Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="142" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_toppanid" fieldSource="tckt_toppanid" required="False" caption="Tckt Toppanid" wizardCaption="Tckt Toppanid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="179" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_r_customercontact1" fieldSource="tckt_r_customercontact2" required="False" caption="Tckt R Customercontact" wizardCaption="Tckt R Customercontact" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SummaryTickettckt_r_customercontact1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="180" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_serialnumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="SummaryTickettckt_serialnumber" fieldSource="tckt_eqpmtserial">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="148"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="132" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="tcktid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="147" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="154" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RSmartTaskView" dataSource="smart_task" errorSummator="Error" wizardCaption="Add/Edit Smart Task " wizardFormMethod="post" PathID="RSmartTaskView" pasteActions="pasteActions" activeCollection="TableParameters" pasteAsReplace="pasteAsReplace">
			<Components>
				<Button id="158" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RSmartTaskViewButton_Cancel" removeParameters="tid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="159" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_current" fieldSource="task_update" required="False" caption="Task Current" wizardCaption="Task Current" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTaskViewtask_current">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="160" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="task_notes" fieldSource="task_notes" required="False" caption="Task Notes" wizardCaption="Task Notes" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RSmartTaskViewtask_notes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Label id="161" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="task_date" fieldSource="task_date" required="False" caption="Task Date" wizardCaption="Task Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTaskViewtask_date" defaultValue="CurrentDateTime" format="GeneralDate" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="163" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTaskViewticket_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="164" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="False" returnValueType="Number" name="taskStatus" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTaskViewtaskStatus" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description" required="True" fieldSource="task_status">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="165" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="taskstatus"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="166" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="167" tableName="smart_referencecode" fieldName="ref_value"/>
						<Field id="168" tableName="smart_referencecode" fieldName="ref_description"/>
					</Fields>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="169" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTaskViewdatemodified" defaultValue="CurrentDateTime" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="170" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ticketRef" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTaskViewticketRef">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="171" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="task_neweng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTaskViewtask_neweng" fieldSource="task_updatedeng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="172" fieldSourceType="DBColumn" dataType="Text" html="False" name="task_currenteng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTaskViewtask_currenteng" visible="Yes" fieldSource="task_currenteng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="173"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="174"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="175" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="tid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="176" tableName="smart_task" posLeft="10" posTop="10" posWidth="131" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="taskactivity.php" forShow="True" url="taskactivity.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="taskactivity_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="181" groupID="1"/>
		<Group id="182" groupID="2"/>
		<Group id="183" groupID="3"/>
		<Group id="184" groupID="5"/>
		<Group id="185" groupID="4"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="110"/>
			</Actions>
		</Event>
	</Events>
</Page>
