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
		<Panel id="5" visible="True" name="Panel1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1" features="(assigned)" pasteActions="pasteActions">
			<Components>
				<EditableGrid id="287" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="50" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_faultyequipment" name="GEquipment" pageSizeLimit="100" wizardCaption="List of Smart Faultyequipment " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="Panel1GEquipment" pasteActions="pasteActions" activeCollection="TableParameters">
					<Components>
						<ListBox id="291" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="equipment_id" fieldSource="equipment_id" required="True" caption="Equipment" wizardCaption="Equipment Id" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="Panel1GEquipmentequipment_id" connection="SMART" dataSource="smart_equipment" boundColumn="eqpmt_code" textColumn="eqpmt_name">
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
						<TextBox id="292" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="flty_serialnumber" fieldSource="flty_serialnumber" required="True" caption="Serial Number" wizardCaption="Flty Serialnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1GEquipmentflty_serialnumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Button id="294" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel1GEquipmentButton_Submit">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="295" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel1GEquipmentCancel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Hidden id="290" fieldSourceType="DBColumn" dataType="Text" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1GEquipmentresolution_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="289" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Panel1GEquipmentid">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="293" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1GEquipmentdatemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1GEquipmentlblNumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
					</Components>
					<Events>
						<Event name="BeforeBuildInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="322" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="327" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="331" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="332"/>
							</Actions>
						</Event>
						<Event name="BeforeShowRow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="340"/>
							</Actions>
						</Event>
						<Event name="AfterSubmit" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="342"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="297" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rf"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="296" tableName="smart_faultyequipment" posLeft="10" posTop="10" posWidth="134" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<PKFields>
						<PKField id="288" tableName="smart_faultyequipment" fieldName="id" dataType="Integer"/>
					</PKFields>
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
				</EditableGrid>
			</Components>
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="6" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
			</Features>
		</Panel>
		<Record id="12" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RPreventive" errorSummator="Error" wizardCaption="Add/Edit Smart Resolution " wizardFormMethod="post" PathID="RPreventive" pasteActions="pasteActions" dataSource="smart_preventive" activeCollection="TableParameters">
			<Components>
				<Button id="39" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RPreventiveButton_Insert">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="40" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="41" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RPreventiveButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="42" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RPreventiveButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="177" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="prvt_date" fieldSource="prvt_date" required="True" caption="Date" wizardCaption="Rslt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_date" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="45" name="DatePicker_prvt_date" control="prvt_date" wizardSatellite="True" wizardControl="rslt_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RPreventiveDatePicker_prvt_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="prvt_byuser" fieldSource="prvt_byuser" required="False" caption="Engineer" wizardCaption="Rslt Engineer" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_byuser" sourceType="Table" connection="SMART" activeCollection="TableParameters" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="47" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="GreaterThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="3"/>
						<TableParameter id="199" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="5"/>
						<TableParameter id="353" conditionType="Parameter" useIsNull="False" field="usr_status" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="1"/>
						<TableParameter id="355" conditionType="Parameter" useIsNull="False" field="usr_flag" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="0"/>
</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="48" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="prvt_servicedate" fieldSource="prvt_servicedate" required="True" caption="Service Date" wizardCaption="Rslt Servicedate" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_servicedate" format="dd/mm/yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="50" name="DatePicker_prvt_servicedate" control="prvt_servicedate" wizardSatellite="True" wizardControl="rslt_servicedate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RPreventiveDatePicker_prvt_servicedate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="prvt_servicennumber" fieldSource="prvt_servicennumber" required="True" caption="Service No." wizardCaption="Rslt Serviceno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_servicennumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="52" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="prvt_eta" fieldSource="prvt_eta" required="False" caption="ETA" wizardCaption="Rslt Eta" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_eta" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="prvt_etd" fieldSource="prvt_etd" required="False" caption="ETD" wizardCaption="Rslt Etd" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_etd" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="58" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="prvt_toppanid" required="True" caption="Toppan" wizardCaption="Rslt Toppanid" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_toppanid" fieldSource="prvt_toppanid" sourceType="Table" connection="SMART" dataSource="smart_eqtoppan" boundColumn="eqtop_toppan" textColumn="eqtop_toppan" features="(assigned)">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="230" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features>
						<PTDependentListBox id="213" enabled="True" name="PTDependentListBox2" servicePage="services/pmactivity_RPreventive_prvt_toppanid_PTDependentListBox1.ccp" masterListbox="prvt_equipment" category="Prototype" featureNameChanged="No">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="prvt_tagrelated" required="False" caption="Tag Related" wizardCaption="Rslt Related" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_tagrelated" fieldSource="prvt_tagrelated">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="prvt_inspection" fieldSource="prvt_inspection" required="True" caption="Inspection" wizardCaption="Rslt Inspection" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RPreventiveprvt_inspection">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="61" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="prvt_actiontaken" fieldSource="prvt_actiontaken" required="True" caption="Action" wizardCaption="Rslt Action" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RPreventiveprvt_actiontaken">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="62" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="prvt_actionmethod" fieldSource="prvt_actionmethod" required="False" caption="Method" wizardCaption="Rslt Method" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_actionmethod" sourceType="ListOfValues" html="True" connection="SMART" _valueOfList="3" _nameOfList="Remote" dataSource="1;Phone Call;2;Visit Site;3;Remote" defaultValue="3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</Hidden>
				<TextArea id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="prvt_planning" fieldSource="prvt_planning" required="False" caption="Planning" wizardCaption="Rslt Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RPreventiveprvt_planning">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="64" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="prvt_remark" fieldSource="prvt_remark" required="False" caption="Remark" wizardCaption="Rslt Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RPreventiveprvt_remark">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="66" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventivedatemodified">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="172" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="customer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreventivecustomer" fieldSource="prvt_customer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="178" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="customercontact" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreventivecustomercontact" fieldSource="prvt_customercontact">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="221" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="prvt_equipment" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="RPreventiveprvt_equipment" fieldSource="prvt_equipment" connection="SMART" dataSource="smart_equipment" boundColumn="eqpmt_code" textColumn="eqpmt_name" defaultValue="E2000">
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
				</Hidden>
				<TextBox id="222" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="customercontact1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreventivecustomercontact1" fieldSource="prvt_customercontact2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="223" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="prvt_byuser2" fieldSource="prvt_byuser2" required="False" caption="Engineer" wizardCaption="Rslt Engineer" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreventiveprvt_byuser2" sourceType="Table" connection="SMART" activeCollection="TableParameters" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="224" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="GreaterThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="3"/>
						<TableParameter id="225" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="5"/>
						<TableParameter id="354" conditionType="Parameter" useIsNull="False" field="usr_status" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="1"/>
						<TableParameter id="356" conditionType="Parameter" useIsNull="False" field="usr_flag" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="0"/>
</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="226" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="228" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="prvt_refnumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreventiveprvt_refnumber" fieldSource="prvt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="323" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="prvt_counter" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreventiveprvt_counter" fieldSource="prvt_counter" caption="Counter">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="345" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="RPreventivesite" connection="SMART" fieldSource="prvt_site" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" caption="Site" features="(assigned)">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="351"/>
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
					<Features>
						<PTDependentListBox id="350" enabled="True" name="PTDependentListBox1" servicePage="services/pmactivity_RPreventive_site_PTDependentListBox1.ccp" masterListbox="state" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<ListBox id="346" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="RPreventivestate" caption="State" fieldSource="prvt_state" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_description" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="348" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="state"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="347" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="67" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="68" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="227" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="231" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="232" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="352"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="69" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="pmid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="171" tableName="smart_preventive" posLeft="10" posTop="10" posWidth="158" posHeight="180"/>
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
		<Label id="77" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id1" fieldSource="id" wizardCaption="{res:id}" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="id1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Panel id="84" visible="True" name="Panel2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2" features="(assigned)" pasteActions="pasteActions">
			<Components>
				<EditableGrid id="298" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="50" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_measurement" name="GMeasurement" pageSizeLimit="100" wizardCaption="List of Smart Measurement " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="Panel2GMeasurement" pasteActions="pasteActions" activeCollection="TableParameters">
					<Components>
						<Hidden id="300" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Panel2GMeasurementid">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ListBox id="302" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="msre_item" fieldSource="msre_item" required="True" caption="Item" wizardCaption="Msre Item" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="Panel2GMeasurementmsre_item" connection="SMART" dataSource="smart_sparepart" activeCollection="TableParameters" boundColumn="spart_code" textColumn="spart_name">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="320" conditionType="Parameter" useIsNull="False" field="spart_category" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="S"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="319" tableName="smart_sparepart" posLeft="10" posTop="10" posWidth="145" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextBox id="303" visible="Yes" fieldSourceType="DBColumn" dataType="Single" name="msre_before" fieldSource="msre_before" required="True" caption="Msre Before" wizardCaption="Msre Before" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementmsre_before">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="304" visible="Yes" fieldSourceType="DBColumn" dataType="Single" name="msre_after" fieldSource="msre_after" required="True" caption="Msre After" wizardCaption="Msre After" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementmsre_after">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="305" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="msre_remark" fieldSource="msre_remark" required="True" caption="Msre Remark" wizardCaption="Msre Remark" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementmsre_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Button id="307" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel2GMeasurementButton_Submit">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="308" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel2GMeasurementCancel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Hidden id="301" fieldSourceType="DBColumn" dataType="Text" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementresolution_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="306" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementdatemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Label id="339" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2GMeasurementlblNumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
					</Components>
					<Events>
						<Event name="BeforeBuildInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="321" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="326" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="328" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="333"/>
							</Actions>
						</Event>
						<Event name="BeforeShowRow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="341"/>
							</Actions>
						</Event>
						<Event name="AfterSubmit" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="343"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="310" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rf"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="309" tableName="smart_measurement" posLeft="10" posTop="10" posWidth="115" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<PKFields>
						<PKField id="299" tableName="smart_measurement" fieldName="id" dataType="Integer"/>
					</PKFields>
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
				</EditableGrid>
			</Components>
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="85" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
			</Features>
		</Panel>
		<Panel id="86" visible="True" name="Panel3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3" features="(assigned)" pasteActions="pasteActions">
			<Components>
				<Grid id="99" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_replacement" name="GSmartReplacement" pageSizeLimit="100" wizardCaption="List of Smart Replacement " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" pasteActions="pasteActions">
					<Components>
						<Label id="100" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Panel3GSmartReplacementlblNumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Link id="101" fieldSourceType="DBColumn" dataType="Text" html="False" name="equipment_id" fieldSource="faultyequipment_id" wizardCaption="Equipment Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Panel3GSmartReplacementequipment_id" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="pmactivity.ccp">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
							<LinkParameters>
								<LinkParameter id="158" sourceType="Expression" name="rplc" source="1"/>
								<LinkParameter id="159" sourceType="DataField" name="rplcid" source="id"/>
							</LinkParameters>
						</Link>
						<Label id="102" fieldSourceType="DBColumn" dataType="Text" html="False" name="equipment_serialno" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Panel3GSmartReplacementequipment_serialno" fieldSource="rplc_currserial">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Label id="103" fieldSourceType="DBColumn" dataType="Text" html="False" name="rplc_serialnumber" fieldSource="rplc_rplcserial" wizardCaption="Rplmt Serialno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Panel3GSmartReplacementrplc_serialnumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<Navigator id="105" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Navigator>
						<ImageLink id="106" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="btnNewRec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3GSmartReplacementbtnNewRec" hrefSource="pmactivity.ccp" removeParameters="rplcid">
							<Components/>
							<Events/>
							<LinkParameters>
								<LinkParameter id="155" sourceType="URL" name="pmid" source="pmid"/>
								<LinkParameter id="157" sourceType="Expression" format="yyyy-mm-dd" name="rplc" source="1"/>
							</LinkParameters>
							<Attributes/>
							<Features/>
						</ImageLink>
						<Hidden id="217" fieldSourceType="DBColumn" dataType="Text" name="rplc_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3GSmartReplacementrplc_type" fieldSource="rplc_type">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="True" name="rplc_remark" fieldSource="rplc_remark" wizardCaption="Rplmt Serialno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Panel3GSmartReplacementrplc_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
					</Components>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="201"/>
							</Actions>
						</Event>
						<Event name="BeforeShowRow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="209"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="108" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rf"/>
					</TableParameters>
					<JoinTables>
						<JoinTable id="109" tableName="smart_replacement" posLeft="10" posTop="10" posWidth="144" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<SPParameters/>
					<SQLParameters/>
					<SecurityGroups/>
					<Attributes/>
					<Features/>
				</Grid>
				<Record id="130" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="RSmartReplacement" connection="SMART" dataSource="smart_replacement" PathID="Panel3RSmartReplacement" activeCollection="TableParameters">
					<Components>
						<Button id="131" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" PathID="Panel3RSmartReplacementButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="132" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" PathID="Panel3RSmartReplacementButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="133" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" PathID="Panel3RSmartReplacementButton_Cancel">
							<Components/>
							<Events>
								<Event name="OnClick" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="315"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Button>
						<RadioButton id="136" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" returnValueType="Number" name="itemtype" caption="Faultyequipment Id" fieldSource="rplc_type" dataSource="eq;Equipment;sp;Spare Part" required="True" PathID="Panel3RSmartReplacementitemtype" connection="SMART">
							<Components/>
							<Events>
								<Event name="OnClick" type="Client">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="316"/>
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
						</RadioButton>
						<TextBox id="141" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rplc_serialnumber" caption="Rplc Serialnumber" fieldSource="rplc_currserial" required="True" PathID="Panel3RSmartReplacementrplc_serialnumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextArea id="142" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rplc_remark" caption="Rplc Remark" fieldSource="rplc_remark" required="True" PathID="Panel3RSmartReplacementrplc_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<ListBox id="204" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="rplc_equipment" fieldSource="faultyequipment_id" connection="SMART" dataSource="smart_equipment" boundColumn="id" textColumn="eqpmt_name" PathID="Panel3RSmartReplacementrplc_equipment">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="207" tableName="smart_equipment" posWidth="154" posHeight="168" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<ListBox id="205" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="rplc_sparepart" fieldSource="faultyequipment_id" connection="SMART" dataSource="smart_sparepart" boundColumn="id" textColumn="spart_name" PathID="Panel3RSmartReplacementrplc_sparepart">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="208" tableName="smart_sparepart" posWidth="145" posHeight="168" posLeft="10" posTop="10"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextBox id="215" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rplc_rplcserial" fieldSource="rplc_rplcserial" required="True" PathID="Panel3RSmartReplacementrplc_rplcserial">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Hidden id="286" fieldSourceType="DBColumn" dataType="Text" name="resolution_id" fieldSource="resolution_id" PathID="Panel3RSmartReplacementresolution_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="317" fieldSourceType="DBColumn" dataType="Text" name="datemodified" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3RSmartReplacementdatemodified" fieldSource="datemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="311"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="312"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="313"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="314"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="324"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="325"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="134" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" orderNumber="1" parameterSource="rplcid"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="174" tableName="smart_replacement" posWidth="144" posHeight="180" posLeft="10" posTop="10"/>
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
				<UpdatePanel id="87" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
			</Features>
		</Panel>
		<EditableGrid id="179" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_attachment" name="smart_attachment" pageSizeLimit="100" wizardCaption="List of Smart Attachment " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="smart_attachment" deleteControl="CheckBox_Delete" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Hidden id="181" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_attachmentid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="183" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_byuser" required="False" caption="Attch Byuser" wizardCaption="Attch Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="184" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_name" fieldSource="attch_name" required="True" caption="Title" wizardCaption="Attch Name" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="186" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_date" fieldSource="attch_date" required="False" caption="Attch Date" wizardCaption="Attch Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Panel id="188" visible="True" name="CheckBox_Delete_Panel">
					<Components>
						<CheckBox id="189" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="smart_attachmentCheckBox_Delete_PanelCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Navigator id="190" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="191" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="smart_attachmentButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="192" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_attachmentCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<FileUpload id="193" fieldSourceType="DBColumn" allowedFileMasks="*.pdf;*.png;*.jpg;*.gif" fileSizeLimit="2097152" dataType="Text" tempFileFolder="temp" name="FileUpload" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentFileUpload" processedFileFolder="attachments" fieldSource="attch_sourcefile" caption="Attachment" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Hidden id="194" fieldSourceType="DBColumn" dataType="Text" name="storeuser" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentstoreuser" fieldSource="attch_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="182" fieldSourceType="DBColumn" dataType="Text" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentresolution_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="203" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="218" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="att_link" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentatt_link" fieldSource="attch_sourcefile" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="344" fieldSourceType="DBColumn" dataType="Text" name="datemodified" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentdatemodified" fieldSource="datemodified" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="195" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="196" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="202"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="329"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="330"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="198" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rf"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="197" tableName="smart_attachment" posLeft="10" posTop="10" posWidth="123" posHeight="168"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="180" tableName="smart_attachment" fieldName="id" dataType="Integer"/>
			</PKFields>
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
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="pmactivity_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="pmactivity.php" forShow="True" url="pmactivity.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="334" groupID="1"/>
		<Group id="335" groupID="2"/>
		<Group id="336" groupID="3"/>
		<Group id="337" groupID="5"/>
		<Group id="338" groupID="4"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="71"/>
			</Actions>
		</Event>
	</Events>
</Page>
