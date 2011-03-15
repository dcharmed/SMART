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
		<Panel id="111" visible="Dynamic" name="Panel1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1" features="(assigned)" pasteActions="pasteActions">
			<Components>
				<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="smart_ticket" connection="SMART" dataSource="smart_ticket" PathID="Panel1smart_ticket" pasteActions="pasteActions">
					<Components>
						<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" PathID="Panel1smart_ticketButton_Insert">
							<Components/>
							<Events>
							</Events>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" PathID="Panel1smart_ticketButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="8" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" PathID="Panel1smart_ticketButton_Cancel" removeParameters="tcktid;id;new;s_status">
							<Components/>
							<Events>
								<Event name="OnClick" type="Client">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="334"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Button>
						<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_refnumber" caption="Refnumber" fieldSource="tckt_refnumber" PathID="Panel1smart_tickettckt_refnumber" required="True">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<ListBox id="11" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_status" caption="Tckt Status" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" orderBy="ref_rank" required="False" PathID="Panel1smart_tickettckt_status" activeCollection="TableParameters">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="73" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="tcktstatus"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="72" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tckt_r_date" caption="Date" fieldSource="tckt_r_date" required="True" PathID="Panel1smart_tickettckt_r_date" defaultValue="CurrentDateTime" format="GeneralDate">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<DatePicker id="13" name="DatePicker_tckt_r_date" style="Styles/{CCS_Style}/Style.css" control="tckt_r_date" PathID="Panel1smart_ticketDatePicker_tckt_r_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</DatePicker>
						<ListBox id="18" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_esc" caption="Tckt Esc" fieldSource="tckt_escalate" required="False" PathID="Panel1smart_tickettckt_esc" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="329" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="esc"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="328" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextArea id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="tckt_description" caption="Description" fieldSource="tckt_description" required="True" PathID="Panel1smart_tickettckt_description">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<ListBox id="15" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="tckt_severity" caption="Severity" fieldSource="tckt_severity" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" required="True" PathID="Panel1smart_tickettckt_severity">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="83" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" parameterSource="tcktseverity" logicOperator="And"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="82" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<Label id="25" fieldSourceType="DBColumn" dataType="Date" html="False" name="raised_date" format="GeneralDate" PathID="Panel1smart_ticketraised_date" fieldSource="tckt_r_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<ListBox id="26" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="bygroupid" fieldSource="tckt_r_byusertype" connection="SMART" dataSource="3;Engineers;5;Helpdesk;6;Adukom" PathID="Panel1smart_ticketbygroupid" _valueOfList="6" _nameOfList="Adukom">
							<Components/>
							<Events>
								<Event name="OnChange" type="Client">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="301"/>
									</Actions>
								</Event>
							</Events>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="bycontact" fieldSource="tckt_r_customercontact" PathID="Panel1smart_ticketbycontact" required="True" caption="Raised : Contact">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="38" visible="Dynamic" fieldSourceType="DBColumn" dataType="Date" name="tckt_c_date" PathID="Panel1smart_tickettckt_c_date" fieldSource="tckt_c_date" caption="Close Date" format="ShortDate" defaultValue="CurrentDate">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="42" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="closedby" fieldSource="tckt_c_byuser" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_username" PathID="Panel1smart_ticketclosedby">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="43" tableName="smart_user" posWidth="118" posHeight="180" posLeft="126" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields>
								<Field id="308" tableName="smart_user" fieldName="id"/>
								<Field id="309" tableName="smart_user" fieldName="usr_username"/>
								<Field id="310" tableName="smart_user" fieldName="usr_fullname"/>
							</Fields>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="52" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="closedadukom" fieldSource="tckt_c_adukomid" PathID="Panel1smart_ticketclosedadukom">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="54" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="closedreportedbyname" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname" PathID="Panel1smart_ticketclosedreportedbyname">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="69" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" parameterSource="4" logicOperator="And"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="68" tableName="smart_user" posWidth="95" posHeight="88" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields>
								<Field id="70" tableName="smart_user" fieldName="id"/>
								<Field id="71" tableName="smart_user" fieldName="usr_fullname"/>
							</Fields>
							<Attributes/>
							<Features/>
						</TextBox>
						<DatePicker id="55" name="DatePicker_tckt_c_date" style="Styles/{CCS_Style}/Style.css" control="tckt_c_date" PathID="Panel1smart_ticketDatePicker_tckt_c_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</DatePicker>
						<ListBox id="59" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="state" fieldSource="tckt_state" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" orderBy="ref_rank" PathID="Panel1smart_ticketstate" required="True" caption="State">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="62" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" parameterSource="state" logicOperator="And"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="61" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<ListBox id="14" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_branch" caption="Branch" fieldSource="tckt_site" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_value" required="True" features="(assigned)" PathID="Panel1smart_tickettckt_branch">
							<Components/>
							<Events>
								<Event name="OnChange" type="Client">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="261"/>
									</Actions>
								</Event>
							</Events>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="60" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features>
								<PTDependentListBox id="148" enabled="True" name="PTDependentListBox1" servicePage="services/ticketdetails_smart_ticket_tckt_branch_PTDependentListBox1.ccp" masterListbox="state" category="Prototype" featureNameChanged="No">
									<Components/>
									<Events/>
									<Features/>
								</PTDependentListBox>
							</Features>
						</ListBox>
						<Hidden id="24" fieldSourceType="DBColumn" dataType="Date" name="datemodified" caption="Datemodified" fieldSource="datemodified" required="False" PathID="Panel1smart_ticketdatemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ListBox id="78" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_related" fieldSource="tckt_tagrelated" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" features="(assigned)" PathID="Panel1smart_tickettckt_related">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="79" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features>
								<PTDependentListBox id="157" enabled="True" name="PTDependentListBox3" servicePage="services/ticketdetails_smart_ticket_tckt_related_PTDependentListBox1.ccp" masterListbox="tckt_subcat" category="Prototype">
									<Components/>
									<Events/>
									<Features/>
								</PTDependentListBox>
							</Features>
						</ListBox>
						<Label id="85" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblTicketNumber" fieldSource="tckt_refnumber" PathID="Panel1smart_ticketlblTicketNumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Panel id="88" visible="True" name="EditStatus" PathID="Panel1smart_ticketEditStatus">
							<Components>
								<Link id="89" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkStatus" hrefSource="#" PathID="Panel1smart_ticketEditStatuslinkStatus">
									<Components/>
									<Events/>
									<LinkParameters/>
									<Attributes/>
									<Features/>
								</Link>
							</Components>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<ListBox id="20" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_category" caption="Tckt Category" fieldSource="tckt_category" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" orderBy="ref_rank" required="False" PathID="Panel1smart_tickettckt_category">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" parameterSource="probcat" logicOperator="And"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="56" tableName="smart_referencecode" posWidth="97" posHeight="136" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<Hidden id="260" fieldSourceType="DBColumn" dataType="Text" name="hid_status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_tickethid_status" fieldSource="tckt_status" defaultValue="1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="262" fieldSourceType="DBColumn" dataType="Integer" name="id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_ticketid" fieldSource="id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<TextBox id="36" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="byadukom" fieldSource="tckt_adukomn" PathID="Panel1smart_ticketbyadukom" caption="Adukom #">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Hidden id="37" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="reportedby" fieldSource="tckt_r_helpdesk" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_username" PathID="Panel1smart_ticketreportedby" required="False" caption="Raised : Helpdesk">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="64" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" parameterSource="4" logicOperator="And"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="63" tableName="smart_user" posWidth="126" posHeight="293" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields>
								<Field id="66" tableName="smart_user" fieldName="usr_fullname"/>
								<Field id="67" tableName="smart_user" fieldName="id"/>
								<Field id="302" tableName="smart_user" fieldName="usr_username"/>
							</Fields>
							<Attributes/>
							<Features/>
						</Hidden>
						<ListBox id="297" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="byEngineer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_ticketbyEngineer" sourceType="Table" fieldSource="tckt_r_engineer" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_username">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
							<TableParameters>
								<TableParameter id="300" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="299" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
						</ListBox>
						<TextBox id="298" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="byadukomid" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_ticketbyadukomid" fieldSource="tckt_r_adukomid" caption="Adukom ID">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="311" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="customer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_ticketcustomer" fieldSource="tckt_r_customer" required="True" caption="Customer">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="312" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="helpdeskName" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_tickethelpdeskName">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Hidden id="315" fieldSourceType="DBColumn" dataType="Text" name="closedreportedbyid" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_ticketclosedreportedbyid" fieldSource="tckt_c_helpdesk">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ListBox id="350" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="tckt_equipment" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_tickettckt_equipment" fieldSource="tckt_equipment" required="False" sourceType="Table" connection="SMART" dataSource="smart_equipment" boundColumn="eqpmt_code" textColumn="eqpmt_name">
							<Components/>
							<Events/>
							<Attributes/>
							<Features>
							</Features>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="351" tableName="smart_equipment" posLeft="10" posTop="10" posWidth="154" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields>
								<Field id="352" tableName="smart_equipment" fieldName="eqpmt_code"/>
								<Field id="353" tableName="smart_equipment" fieldName="eqpmt_name"/>
							</Fields>
						</ListBox>
						<TextBox id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_eqpmtserial" caption="Tckt Eqpmtserial" fieldSource="tckt_eqpmtserial" required="False" PathID="Panel1smart_tickettckt_eqpmtserial">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<ListBox id="373" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_toppanid" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="Panel1smart_tickettckt_toppanid" fieldSource="tckt_toppanid" connection="SMART" dataSource="smart_eqtoppan" boundColumn="eqtop_toppan" textColumn="eqtop_toppan" activeCollection="TableParameters" features="(assigned)">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="374" tableName="smart_equipment" posWidth="154" posHeight="180" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features>
								<PTDependentListBox id="377" enabled="True" name="PTDependentListBox4" servicePage="services/ticketdetails_smart_ticket_tckt_toppanid_PTDependentListBox1.ccp" masterListbox="tckt_equipment" category="Prototype">
									<Components/>
									<Events/>
									<Features/>
								</PTDependentListBox>
								<PTAutoFill id="379" enabled="True" valueField="value" sourceType="Table" name="PTAutoFill1" servicePage="services/ticketdetails_smart_ticket_tckt_toppanid_PTAutoFill1.ccp" searchField="eqtop_toppan" connection="SMART" featureNameChanged="No" dataSource="smart_eqtoppan" category="Prototype">
									<Components/>
									<Events/>
									<TableParameters/>
									<SPParameters/>
									<SQLParameters/>
									<JoinTables/>
									<JoinLinks/>
									<Fields/>
									<Controls>
										<Control id="380" name="tckt_eqpmtserial" source="eqtop_serialnumber" propertyValue="value" sourceId="22"/>
									</Controls>
									<ControlPoints/>
									<Features/>
								</PTAutoFill>
							</Features>
						</ListBox>
						<Label id="383" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNoteRef" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_ticketlblNoteRef">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<ListBox id="149" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="tckt_subcat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="Panel1smart_tickettckt_subcat" fieldSource="tckt_subcategory" connection="SMART" dataSource="smart_referencecode" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description" features="(assigned)">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="150" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
							</JoinTables>
							<JoinLinks/>
							<Fields>
								<Field id="151" tableName="smart_referencecode" fieldName="ref_value"/>
								<Field id="152" tableName="smart_referencecode" fieldName="ref_description"/>
								<Field id="153" tableName="smart_referencecode" fieldName="ref_type"/>
							</Fields>
							<Attributes/>
							<Features>
								<PTDependentListBox id="155" enabled="True" name="PTDependentListBox5" servicePage="services/ticketdetails_smart_ticket_tckt_subcat_PTDependentListBox1.ccp" masterListbox="tckt_category" category="Prototype">
									<Components/>
									<Events/>
									<Features/>
								</PTDependentListBox>
							</Features>
						</ListBox>
						<TextBox id="316" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_engineer" required="False" caption="Engineer" wizardCaption="Task Personincharge" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1smart_tickettckt_engineer" sourceType="Table" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_fullname">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
							<TableParameters>
								<TableParameter id="317" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="318" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
						</TextBox>
						<TextBox id="384" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="bycontact2" fieldSource="tckt_r_customercontact2" PathID="Panel1smart_ticketbycontact2" required="True" caption="Raised : Contact 2">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="392" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_method" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_tickettckt_method" fieldSource="tckt_c_method">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<CheckBox id="404" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="tckt_followup" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1smart_tickettckt_followup" fieldSource="tckt_followup" checkedValue="1" uncheckedValue="0" defaultValue="0">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="113" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="129" eventType="Client"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="256" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="AfterInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="333"/>
							</Actions>
						</Event>
						<Event name="AfterUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="340"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="381"/>
							</Actions>
						</Event>
						<Event name="BeforeInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="382"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="URL" parameterSource="id" logicOperator="And" orderNumber="1"/>
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
				<Grid id="158" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="100" connection="SMART" dataSource="smart_resolutionnote" name="GResNote" pageSizeLimit="100" wizardCaption="List of Smart Resolutionnote " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" pasteActions="pasteActions">
					<Components>
						<Link id="160" fieldSourceType="DBColumn" dataType="Date" html="False" name="rsltn_date" fieldSource="rsltn_date" wizardCaption="Rsltn Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Panel1GResNotersltn_date" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketdetails.ccp" format="GeneralDate" removeParameters="id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
							<LinkParameters>
								<LinkParameter id="174" sourceType="DataField" name="rid" source="id"/>
								<LinkParameter id="326" sourceType="URL" name="id" source="id"/>
							</LinkParameters>
						</Link>
						<Label id="286" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_type" fieldSource="rsltn_type">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<ImageLink id="288" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNoteImageLink2" hrefSource="cmactivity.ccp" removeParameters="id;FormFilter;Panel1;new;rid">
							<Components/>
							<Events/>
							<LinkParameters>
								<LinkParameter id="289" sourceType="URL" format="yyyy-mm-dd" name="tcktid" source="id"/>
							</LinkParameters>
							<Attributes/>
							<Features/>
						</ImageLink>
						<Hidden id="291" fieldSourceType="DBColumn" dataType="Text" name="rsltn_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_id" fieldSource="id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Label id="325" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblTicketNumberResNote" PathID="Panel1GResNotelblTicketNumberResNote">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="396" fieldSourceType="DBColumn" dataType="Text" html="True" name="rsltn_action" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_action" fieldSource="rsltn_actiontaken">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="397" fieldSourceType="DBColumn" dataType="Text" html="True" name="rsltn_planning" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_planning" fieldSource="rsltn_planning">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="398" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_eng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_eng" fieldSource="rsltn_byuser">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="399" fieldSourceType="DBColumn" dataType="Text" html="True" name="rlstn_remark" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNoterlstn_remark" fieldSource="rsltn_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="400" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotelblNumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="401" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_spart" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_spart">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="402" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_eq" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_eq">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="403" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltn_att" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GResNotersltn_att">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
					</Components>
					<Events>
						<Event name="BeforeShowRow" type="Server">
							<Actions>
								<Action actionName="Set Row Style" actionCategory="General" id="167" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
								<Action actionName="Custom Code" actionCategory="General" id="290" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="263" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="303" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
					</TableParameters>
					<JoinTables>
						<JoinTable id="251" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<SPParameters/>
					<SQLParameters/>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
				</Grid>
				<Record id="95" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RResNote" dataSource="smart_resolutionnote" errorSummator="Error" wizardCaption="Add/Edit Smart Resolutionnote " wizardFormMethod="post" PathID="Panel1RResNote" pasteActions="pasteActions" activeCollection="TableParameters">
					<Components>
						<Button id="266" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="Panel1RResNoteButton_Insert">
							<Components/>
							<Events>
								<Event name="OnClick" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="287"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="267" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel1RResNoteButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="268" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel1RResNoteButton_Cancel" removeParameters="rid">
							<Components/>
							<Events>
								<Event name="OnClick" type="Client">
									<Actions>
										<Action actionName="Confirmation Message" actionCategory="General" id="295" message="Do you want to discard changes?"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Button>
						<TextBox id="269" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_date" fieldSource="rsltn_date" required="True" caption="Date" wizardCaption="Rsltn Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1RResNotersltn_date" format="GeneralDate" defaultValue="CurrentDateTime">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<DatePicker id="270" name="DatePicker_rsltn_date" control="rsltn_date" wizardSatellite="True" wizardControl="rsltn_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="Panel1RResNoteDatePicker_rsltn_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</DatePicker>
						<TextBox id="110" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="engName" required="False" caption="Engineer Name" wizardCaption="Rsltn Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1RResNoteengName">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextArea id="275" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_actiontaken" fieldSource="rsltn_actiontaken" required="True" caption="Action taken" wizardCaption="Rsltn Actiontaken" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Panel1RResNotersltn_actiontaken">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<TextArea id="277" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_planning" fieldSource="rsltn_planning" required="False" caption="Rsltn Planning" wizardCaption="Rsltn Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Panel1RResNotersltn_planning">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<TextArea id="278" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_remark" fieldSource="rsltn_remark" required="False" caption="Rsltn Remark" wizardCaption="Rsltn Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Panel1RResNotersltn_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<Hidden id="279" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1RResNoteticket_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="292" fieldSourceType="DBColumn" dataType="Integer" name="rsltn_byuser" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1RResNotersltn_byuser" fieldSource="rsltn_byuser" visible="Yes" caption="By Engineer">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="293" fieldSourceType="DBColumn" dataType="Text" name="rsltn_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1RResNotersltn_type" fieldSource="rsltn_type" defaultValue="SN">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="284"/>
							</Actions>
						</Event>
						<Event name="AfterInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="341"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="342"/>
							</Actions>
						</Event>
						<Event name="AfterUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="343"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="344"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="280" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="rid"/>
						<TableParameter id="281" conditionType="Parameter" useIsNull="False" field="rsltn_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="SN"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="282" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="112" enabled="True" childrenAsTriggers="True" name="UpdatePanel1" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" refresh="Panel2smart_task.onsubmit;">
					<Components/>
					<Events/>
					<ControlPoints>
						<ControlPoint id="225" name="Panel2smart_task.onsubmit" relProperty="refresh">
							<Items>
								<ControlPointItem id="226" name="ticketdetails" ccpId="1" type="Page" isFeature="False"/>
								<ControlPointItem id="227" name="Panel2" ccpId="114" type="Panel" isFeature="False" PathID="Panel2"/>
								<ControlPointItem id="228" name="smart_task" ccpId="90" type="Record" isFeature="False" PathID="Panel2smart_task"/>
							</Items>
						</ControlPoint>
					</ControlPoints>
					<Features/>
				</UpdatePanel>
				<ClientCustomCode id="135" enabled="True" name="ClientCustomCode2" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" start="Panel1smart_ticketEditStatus.onclick;">
					<Components/>
					<Events/>
					<ControlPoints>
						<ControlPoint id="361" name="Panel1smart_ticketEditStatus.onclick" relProperty="start">
							<Items>
								<ControlPointItem id="362" name="ticketdetails" ccpId="1" type="Page" isFeature="False"/>
								<ControlPointItem id="363" name="Panel1" ccpId="111" type="Panel" isFeature="False" PathID="Panel1"/>
								<ControlPointItem id="364" name="smart_ticket" ccpId="5" type="Record" isFeature="False" PathID="Panel1smart_ticket"/>
								<ControlPointItem id="365" name="EditStatus" ccpId="88" type="Panel" isFeature="False" PathID="Panel1smart_ticketEditStatus"/>
							</Items>
						</ControlPoint>
					</ControlPoints>
					<Features/>
				</ClientCustomCode>
			</Features>
		</Panel>
		<Panel id="114" visible="Dynamic" name="Panel2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2" features="(assigned)" pasteActions="pasteActions">
			<Components>
				<Record id="90" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_task" dataSource="smart_ticket" errorSummator="Error" wizardCaption="Add/Edit Smart Task " wizardFormMethod="post" PathID="Panel2smart_task" pasteActions="pasteActions" activeCollection="UFormElements" parameterTypeListName="ParameterTypeList" customUpdate="smart_ticket" customUpdateType="Table" activeTableType="smart_ticket">
					<Components>
						<Button id="91" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Update" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="Panel2smart_taskButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="92" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel2smart_taskButton_Cancel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Hidden id="93" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_taskticket_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ListBox id="94" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_newstatus" fieldSource="task_status" required="True" caption="Task Newstatus" wizardCaption="Task Newstatus" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_tasktask_newstatus" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
							<Components/>
							<Events>
								<Event name="OnChange" type="Client">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="30" eventType="Client"/>
									</Actions>
								</Event>
								<Event name="BeforeBuildSelect" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="231"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
							<TableParameters>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="96" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="97" posHeight="136"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
						</ListBox>
						<ListBox id="97" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="task_personincharge" fieldSource="task_currenteng" required="False" caption="Task Personincharge" wizardCaption="Task Personincharge" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_tasktask_personincharge" sourceType="Table" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_fullname">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
							<TableParameters>
								<TableParameter id="98" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="3"/>
								<TableParameter id="327" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="5"/>
								<TableParameter id="405" conditionType="Parameter" useIsNull="False" field="usr_flag" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="0"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="99" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
						</ListBox>
						<ListBox id="100" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="task_secpersonincharge" fieldSource="task_updatedeng" required="False" caption="Task Secpersonincharge" wizardCaption="Task Secpersonincharge" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_tasktask_secpersonincharge" sourceType="Table" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_fullname">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
							<TableParameters>
								<TableParameter id="101" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
								<TableParameter id="406" conditionType="Parameter" useIsNull="False" field="usr_flag" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="0"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="102" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
						</ListBox>
						<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_adukomid" fieldSource="task_adukomid" required="False" caption="Task Adukomid" wizardCaption="Task Adukomid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_tasktask_adukomid">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="103" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="currentstatus" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2smart_taskcurrentstatus">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Hidden id="104" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_currentstatus" fieldSource="tckt_status" required="False" caption="Task Currentstatus" wizardCaption="Task Currentstatus" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_tasktask_currentstatus">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<TextArea id="105" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Reason" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2smart_taskReason" fieldSource="task_notes">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<Hidden id="108" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_taskdatemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="323" fieldSourceType="DBColumn" dataType="Text" name="tckt_closeddate" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2smart_tasktckt_closeddate" visible="Yes">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="367" fieldSourceType="DBColumn" dataType="Text" name="closedby" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2smart_taskclosedby" fieldSource="tckt_c_helpdesk">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<TextBox id="385" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="task_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2smart_tasktask_date" fieldSource="task_date">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<RadioButton id="388" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_actionmethod" fieldSource="tckt_c_method" required="False" caption="Action method" wizardCaption="Rsltn Actionmethod" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2smart_taskrsltn_actionmethod" sourceType="Table" html="True" connection="SMART" dataSource="smart_referencecode" _valueOfList="4" _nameOfList="Others" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
							<TableParameters>
								<TableParameter id="389" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="rsltnmethod"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="390" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
							</JoinTables>
							<JoinLinks/>
							<Fields>
								<Field id="394" tableName="smart_referencecode" fieldName="ref_value"/>
								<Field id="395" tableName="smart_referencecode" fieldName="ref_description"/>
							</Fields>
						</RadioButton>
					</Components>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="109" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="AfterInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="31" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="128"/>
							</Actions>
						</Event>
						<Event name="AfterUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="241"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildSelect" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="330"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="366"/>
							</Actions>
						</Event>
						<Event name="BeforeUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="368"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="331" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="id"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="242" tableName="smart_ticket" posLeft="162" posTop="10" posWidth="160" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="243" tableName="smart_ticket" fieldName="tckt_status"/>
						<Field id="244" tableName="smart_ticket" fieldName="id"/>
						<Field id="245" tableName="smart_ticket" fieldName="tckt_c_helpdesk"/>
						<Field id="246" tableName="smart_ticket" fieldName="tckt_c_date"/>
						<Field id="247" tableName="smart_ticket" fieldName="tckt_c_adukomid"/>
						<Field id="248" tableName="smart_ticket" fieldName="tckt_c_byuser"/>
						<Field id="249" tableName="smart_ticket" fieldName="datemodified"/>
						<Field id="391" tableName="smart_ticket" fieldName="tckt_c_method"/>
					</Fields>
					<ISPParameters/>
					<ISQLParameters>
						<SQLParameter id="232" variable="ticket_id" dataType="Integer" parameterType="Control" parameterSource="ticket_id"/>
						<SQLParameter id="233" variable="task_newstatus" dataType="Text" parameterType="Control" parameterSource="task_newstatus"/>
						<SQLParameter id="234" variable="task_personincharge" dataType="Integer" parameterType="Control" parameterSource="task_personincharge"/>
						<SQLParameter id="235" variable="task_secpersonincharge" dataType="Integer" parameterType="Control" parameterSource="task_secpersonincharge"/>
						<SQLParameter id="236" variable="task_adukomid" dataType="Integer" parameterType="Control" parameterSource="task_adukomid"/>
						<SQLParameter id="237" variable="task_currentstatus" dataType="Integer" parameterType="Control" parameterSource="task_currentstatus"/>
						<SQLParameter id="238" variable="Reason" dataType="Text" parameterType="Control" parameterSource="Reason"/>
						<SQLParameter id="239" variable="closedby" dataType="Integer" parameterType="Control" parameterSource="closedby"/>
						<SQLParameter id="240" variable="datemodified" dataType="Date" parameterType="Control" parameterSource="datemodified"/>
					</ISQLParameters>
					<IFormElements>
						<CustomParameter id="175" field="ticket_id" dataType="Integer" parameterType="Control" parameterSource="ticket_id" omitIfEmpty="True"/>
						<CustomParameter id="176" field="task_update" dataType="Text" parameterType="Control" parameterSource="task_newstatus" omitIfEmpty="True"/>
						<CustomParameter id="177" field="task_currenteng" dataType="Integer" parameterType="Control" parameterSource="task_personincharge" omitIfEmpty="True"/>
						<CustomParameter id="178" field="task_updatedeng" dataType="Integer" parameterType="Control" parameterSource="task_secpersonincharge" omitIfEmpty="True"/>
						<CustomParameter id="179" field="task_adukomid" dataType="Integer" parameterType="Control" parameterSource="task_adukomid" omitIfEmpty="True"/>
						<CustomParameter id="180" field="task_current" dataType="Integer" parameterType="Control" parameterSource="task_currentstatus" omitIfEmpty="True"/>
						<CustomParameter id="181" field="task_notes" dataType="Text" parameterType="Control" parameterSource="Reason" omitIfEmpty="True"/>
						<CustomParameter id="182" field="task_closedby" dataType="Integer" parameterType="Control" parameterSource="closedby" omitIfEmpty="True"/>
						<CustomParameter id="183" field="datemodified" dataType="Date" parameterType="Control" parameterSource="datemodified" omitIfEmpty="True"/>
					</IFormElements>
					<USPParameters/>
					<USQLParameters>
						<SQLParameter id="184" variable="tid" parameterType="Control" dataType="Text" parameterSource="ticket_id"/>
						<SQLParameter id="185" variable="newstatus" parameterType="Control" dataType="Text" parameterSource="task_newstatus"/>
						<SQLParameter id="186" variable="closedby" parameterType="Control" dataType="Text" parameterSource="closedby"/>
						<SQLParameter id="187" variable="pic" parameterType="Control" dataType="Text" parameterSource="task_personincharge"/>
						<SQLParameter id="188" variable="adukomid" parameterType="Control" dataType="Text" parameterSource="task_adukomid"/>
						<SQLParameter id="189" variable="date" parameterType="Control" dataType="Date" parameterSource="datemodified" defaultValue="NULL"/>
					</USQLParameters>
					<UConditions>
						<TableParameter id="332" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="ticket_id"/>
					</UConditions>
					<UFormElements>
						<CustomParameter id="119" field="tckt_status" dataType="Integer" parameterType="Control" parameterSource="task_newstatus" omitIfEmpty="True"/>
						<CustomParameter id="122" field="tckt_c_adukomid" dataType="Text" parameterType="Control" parameterSource="task_adukomid" omitIfEmpty="True"/>
						<CustomParameter id="126" field="datemodified" dataType="Date" parameterType="Control" parameterSource="datemodified" omitIfEmpty="True"/>
						<CustomParameter id="369" field="tckt_c_date" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="tckt_closeddate"/>
						<CustomParameter id="370" field="tckt_c_helpdesk" dataType="Integer" parameterType="Control" omitIfEmpty="True" parameterSource="closedby"/>
						<CustomParameter id="393" field="tckt_c_method" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="rsltn_actionmethod"/>
					</UFormElements>
					<DSPParameters/>
					<DSQLParameters/>
					<DConditions/>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
				</Record>
			</Components>
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="115" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax" featureNameChanged="No">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
				<ShowModal id="141" enabled="True" name="ShowModal1" category="Ajax" featureNameChanged="No">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<ControlPoints/>
					<Features/>
				</ShowModal>
				<ClientCustomCode id="345" enabled="True" name="ClientCustomCode1" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" start="Panel2UpdatePanel.onrefresh;">
					<Components/>
					<Events/>
					<ControlPoints>
						<ControlPoint id="346" name="Panel2UpdatePanel.onrefresh" relProperty="start">
							<Items>
								<ControlPointItem id="347" name="ticketdetails" ccpId="1" type="Page" isFeature="False"/>
								<ControlPointItem id="348" name="Panel2" ccpId="114" type="Panel" isFeature="False" PathID="Panel2"/>
								<ControlPointItem id="349" name="UpdatePanel" ccpId="115" type="UpdatePanel" isFeature="True" PathID="Panel2UpdatePanel"/>
							</Items>
						</ControlPoint>
					</ControlPoints>
					<Features/>
				</ClientCustomCode>
			</Features>
		</Panel>
		<ImageLink id="320" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="ImageLink1" hrefSource="ticketlist.ccp" removeParameters="new;id;tcktid;">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="ticketdetails.php" forShow="True" url="ticketdetails.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="ticketdetails_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="modal" language="PHPTemplates" name="ticketdetails_style.css" forShow="False" comment="/*" commentEnd="*/" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="321" groupID="1"/>
		<Group id="322" groupID="5"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="339"/>
			</Actions>
		</Event>
	</Events>
</Page>
