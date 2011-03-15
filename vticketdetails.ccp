<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0" accessDeniedPage="index.ccp">
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
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="RSmartTicket" connection="SMART" dataSource="smart_ticket" PathID="RSmartTicket" pasteActions="pasteActions">
			<Components>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_refnumber" caption="Tckt Refnumber" fieldSource="tckt_refnumber" PathID="RSmartTickettckt_refnumber" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tckt_r_date" caption="Tckt Date" fieldSource="tckt_r_date" required="True" PathID="RSmartTickettckt_r_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_toppanid" caption="Tckt Toppanid" fieldSource="tckt_toppanid" required="False" PathID="RSmartTickettckt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="17" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_esc" caption="Tckt Esc" fieldSource="tckt_escalate" required="False" PathID="RSmartTickettckt_esc">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_eqpmtserial" caption="Tckt Eqpmtserial" fieldSource="tckt_eqpmtserial" required="False" PathID="RSmartTickettckt_eqpmtserial">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="tckt_description" caption="Tckt Description" fieldSource="tckt_description" required="True" PathID="RSmartTickettckt_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<ListBox id="20" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="tckt_severity" caption="Tckt Severity" fieldSource="tckt_severity" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" required="True" PathID="RSmartTickettckt_severity">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" parameterSource="tcktseverity" logicOperator="And"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="22" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Label id="23" fieldSourceType="DBColumn" dataType="Date" html="False" name="raised_date" format="GeneralDate" PathID="RSmartTicketraised_date" fieldSource="tckt_r_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="helpdesk" fieldSource="tckt_r_helpdesk" connection="SMART" dataSource="smart_user" boundColumn="smart_user_id" textColumn="usr_fullname" PathID="RSmartTickethelpdesk" html="False">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="26" tableName="smart_user" posWidth="118" posHeight="180" posLeft="126" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="27" tableName="smart_user" fieldName="smart_user.id" alias="smart_user_id"/>
						<Field id="28" tableName="smart_user" fieldName="usr_fullname"/>
					</Fields>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="bycontact" fieldSource="tckt_r_customercontact" PathID="RSmartTicketbycontact" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tckt_c_date" PathID="RSmartTickettckt_c_date" fieldSource="tckt_c_date" caption="Close Date" html="False" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="closedby" fieldSource="tckt_c_byuser" connection="SMART" dataSource="smart_user" boundColumn="smart_user_id" textColumn="usr_fullname" PathID="RSmartTicketclosedby" html="False">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="38" tableName="smart_user" posWidth="118" posHeight="180" posLeft="126" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="39" tableName="smart_user" fieldName="smart_user.id" alias="smart_user_id"/>
						<Field id="40" tableName="smart_user" fieldName="usr_fullname"/>
					</Fields>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="closedadukom" fieldSource="tckt_c_adukomid" PathID="RSmartTicketclosedadukom" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="closedreportedby" fieldSource="tckt_c_helpdesk" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname" PathID="RSmartTicketclosedreportedby" html="False">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="43" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" parameterSource="4" logicOperator="And"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="44" tableName="smart_user" posWidth="95" posHeight="88" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="45" tableName="smart_user" fieldName="id"/>
						<Field id="46" tableName="smart_user" fieldName="usr_fullname"/>
					</Fields>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="48" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="state" fieldSource="tckt_state" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" orderBy="ref_rank" PathID="RSmartTicketstate">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="49" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" parameterSource="state" logicOperator="And"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="50" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="51" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_branch" caption="Tckt Branch" fieldSource="tckt_site" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" required="True" features="(assigned)" PathID="RSmartTickettckt_branch">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="52" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTDependentListBox id="53" enabled="True" name="PTDependentListBox4" servicePage="services/ticketdetails_smart_ticket_tckt_branch_PTDependentListBox1.ccp" masterListbox="state" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<ListBox id="55" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_related" fieldSource="tckt_tagrelated" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" features="(assigned)" PathID="RSmartTickettckt_related">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="56" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTDependentListBox id="57" enabled="True" name="PTDependentListBox1" servicePage="services/ticketdetails_smart_ticket_tckt_related_PTDependentListBox1.ccp" masterListbox="tckt_subcat" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<Label id="58" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblTicketNumber" fieldSource="tckt_refnumber" PathID="RSmartTicketlblTicketNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="61" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_category" caption="Tckt Category" fieldSource="tckt_category" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" orderBy="ref_rank" required="True" PathID="RSmartTickettckt_category">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="62" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" parameterSource="probcat" logicOperator="And"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="63" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="64" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_subcat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="RSmartTickettckt_subcat" fieldSource="tckt_subcategory" connection="SMART" dataSource="smart_referencecode" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description" features="(assigned)">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="65" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="66" tableName="smart_referencecode" fieldName="ref_value"/>
						<Field id="67" tableName="smart_referencecode" fieldName="ref_description"/>
						<Field id="68" tableName="smart_referencecode" fieldName="ref_type"/>
					</Fields>
					<Attributes/>
					<Features>
						<PTDependentListBox id="69" enabled="True" name="PTDependentListBox3" servicePage="services/ticketdetails_smart_ticket_tckt_subcat_PTDependentListBox1.ccp" masterListbox="tckt_category" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<Label id="75" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTickettckt_status" fieldSource="tckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="139" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="byEngineer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTicketbyEngineer" sourceType="Table" fieldSource="tckt_r_engineer" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_username" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="140" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="141" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</Label>
				<Label id="142" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="byadukom" fieldSource="tckt_adukomn" PathID="RSmartTicketbyadukom" caption="Adukom #" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="143" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="byadukomid" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTicketbyadukomid" fieldSource="tckt_r_adukomid" caption="Adukom ID" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="144" fieldSourceType="DBColumn" dataType="Text" html="False" name="customer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTicketcustomer" fieldSource="tckt_r_customer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="145" fieldSourceType="DBColumn" dataType="Text" html="False" name="byusergroup" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTicketbyusergroup" fieldSource="tckt_r_byusertype">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="166" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="bycontact1" fieldSource="tckt_r_customercontact2" PathID="RSmartTicketbycontact1" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="169" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_engineer" required="False" caption="Engineer" wizardCaption="Task Personincharge" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSmartTickettckt_engineer" sourceType="Table" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="170" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="171" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</TextBox>
				<TextBox id="176" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_method" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSmartTickettckt_method" fieldSource="tckt_c_method">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="70"/>
					</Actions>
				</Event>
				<Event name="OnLoad" type="Client">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="71"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="74" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="URL" parameterSource="id" logicOperator="And" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
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
		<Record id="95" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_resolutionnote" dataSource="smart_resolutionnote" errorSummator="Error" wizardCaption="Add/Edit Smart Resolutionnote " wizardFormMethod="post" PathID="smart_resolutionnote" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="smart_resolutionnoteButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="smart_resolutionnoteButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="98" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_resolutionnoteButton_Cancel" removeParameters="rid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="100" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_date" fieldSource="rsltn_date" required="True" caption="Date" wizardCaption="Rsltn Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionnotersltn_date" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="101" name="DatePicker_rsltn_date" control="rsltn_date" wizardSatellite="True" wizardControl="rsltn_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_resolutionnoteDatePicker_rsltn_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="110" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="rsltn_byuser" fieldSource="rsltn_byuser" required="False" caption="Rsltn Byuser" wizardCaption="Rsltn Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionnotersltn_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextArea id="106" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" required="True" caption="Action Taken" wizardCaption="Rsltn Actiontaken" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionnotersltn_actiontaken">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="108" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_planning" fieldSource="rsltn_planning" required="False" caption="Rsltn Planning" wizardCaption="Rsltn Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionnotersltn_planning">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="109" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_remark" fieldSource="rsltn_remark" required="False" caption="Rsltn Remark" wizardCaption="Rsltn Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionnotersltn_remark">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="111" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="False" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionnoteticket_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="engName" required="False" caption="Engineer Name" wizardCaption="Rsltn Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionnoteengName">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="123" fieldSourceType="DBColumn" dataType="Text" name="rsltn_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionnotersltn_type" fieldSource="rsltn_type" defaultValue="SN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="138" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="165"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="167"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="168"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="99" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="rid"/>
				<TableParameter id="113" conditionType="Parameter" useIsNull="False" field="rsltn_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="SN"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="112" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
		<ImageLink id="121" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="ImageLink1" hrefSource="ticketlist.ccp" removeParameters="new;id;tcktid;">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<Record id="146" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="resnoteview" dataSource="smart_resolutionnote" errorSummator="Error" wizardCaption="Add/Edit Smart Resolutionnote " wizardFormMethod="post" PathID="resnoteview" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Button id="149" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="resnoteviewButton_Cancel" removeParameters="rid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="150" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_date" fieldSource="rsltn_date" required="True" caption="Date" wizardCaption="Rsltn Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resnoteviewrsltn_date" format="GeneralDate" defaultValue="CurrentDateTime" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="152" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="rsltn_byuser" fieldSource="rsltn_byuser" required="False" caption="Rsltn Byuser" wizardCaption="Rsltn Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resnoteviewrsltn_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="153" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" required="True" caption="Action Taken" wizardCaption="Rsltn Actiontaken" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="resnoteviewrsltn_actiontaken" html="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="155" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_planning" fieldSource="rsltn_planning" required="False" caption="Rsltn Planning" wizardCaption="Rsltn Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="resnoteviewrsltn_planning" html="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_remark" fieldSource="rsltn_remark" required="False" caption="Rsltn Remark" wizardCaption="Rsltn Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="resnoteviewrsltn_remark" html="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="157" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="False" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resnoteviewticket_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="158" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="engName" required="False" caption="Engineer Name" wizardCaption="Rsltn Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resnoteviewengName">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="159" fieldSourceType="DBColumn" dataType="Text" name="rsltn_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resnoteviewrsltn_type" fieldSource="rsltn_type">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="160"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="161" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="rid"/>
				<TableParameter id="162" conditionType="Parameter" useIsNull="False" field="rsltn_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="SN"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="163" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
		<Grid id="177" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_resolutionnote" name="GResNote" pageSizeLimit="100" wizardCaption="List of Smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" pasteActions="pasteActions">
			<Components>
				<Link id="178" fieldSourceType="DBColumn" dataType="Date" html="False" name="rsltn_date" fieldSource="rsltn_date" wizardCaption="Rsltn Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GResNotersltn_date" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketdetails.ccp" format="GeneralDate" removeParameters="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="179" sourceType="DataField" name="rid" source="id"/>
						<LinkParameter id="180" sourceType="URL" name="id" source="id"/>
					</LinkParameters>
				</Link>
				<Label id="181" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNotersltn_type" fieldSource="rsltn_type">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="182" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNoteImageLink2" hrefSource="cmactivity.ccp" removeParameters="id;FormFilter;Panel1;new;rid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="183" sourceType="URL" format="yyyy-mm-dd" name="tcktid" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Hidden id="184" fieldSourceType="DBColumn" dataType="Text" name="rsltn_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNotersltn_id" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="185" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblTicketNumberResNote" PathID="GResNotelblTicketNumberResNote">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="186" fieldSourceType="DBColumn" dataType="Text" html="True" name="rsltn_action" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNotersltn_action" fieldSource="rsltn_actiontaken">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="187" fieldSourceType="DBColumn" dataType="Text" html="True" name="rsltn_planning" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNotersltn_planning" fieldSource="rsltn_planning">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="188" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_eng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNotersltn_eng" fieldSource="rsltn_byuser">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="189" fieldSourceType="DBColumn" dataType="Text" html="True" name="rlstn_remark" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNoterlstn_remark" fieldSource="rsltn_remark">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="190" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GResNotelblNumber">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="191" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="192"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="193"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="194"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="195" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="vticketdetails.php" forShow="True" url="vticketdetails.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="vticketdetails_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="172" groupID="1"/>
		<Group id="173" groupID="2"/>
		<Group id="174" groupID="3"/>
		<Group id="175" groupID="4"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="164"/>
			</Actions>
		</Event>
	</Events>
</Page>
