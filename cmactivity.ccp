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
				<EditableGrid id="221" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="50" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_faultyequipment" name="GEquipment" pageSizeLimit="100" wizardCaption="List of Smart Faultyequipment " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="Panel1GEquipment" pasteActions="pasteActions" activeCollection="TableParameters">
					<Components>
						<ListBox id="222" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="equipment_id" fieldSource="equipment_id" required="True" caption="Equipment" wizardCaption="Equipment Id" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="Panel1GEquipmentequipment_id" connection="SMART" dataSource="smart_equipment" boundColumn="eqpmt_code" textColumn="eqpmt_name">
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
						<TextBox id="223" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="flty_serialnumber" fieldSource="flty_serialnumber" required="True" caption="Serial Number" wizardCaption="Flty Serialnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1GEquipmentflty_serialnumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Button id="224" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel1GEquipmentButton_Submit">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="225" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel1GEquipmentCancel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Hidden id="226" fieldSourceType="DBColumn" dataType="Text" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1GEquipmentresolution_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="227" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Panel1GEquipmentid">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="228" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1GEquipmentdatemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events>
						<Event name="BeforeBuildInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="229"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="230"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="231"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="257"/>
							</Actions>
						</Event>
						<Event name="AfterSubmit" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="265"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="232" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rid"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="233" tableName="smart_faultyequipment" posLeft="10" posTop="10" posWidth="134" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<PKFields>
						<PKField id="234" tableName="smart_faultyequipment" fieldName="id" dataType="Integer"/>
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
		<Record id="12" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_resolution" errorSummator="Error" wizardCaption="Add/Edit Smart Resolution " wizardFormMethod="post" PathID="smart_resolution" pasteActions="pasteActions" dataSource="smart_resolutionnote" activeCollection="TableParameters">
			<Components>
				<Button id="39" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="smart_resolutionButton_Insert">
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
				<Button id="41" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="smart_resolutionButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="42" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_resolutionButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionticket_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_date" required="False" caption="Date" wizardCaption="Rslt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrsltn_date" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="rsltn_engineer" fieldSource="rsltn_byuser" required="True" caption="Engineer" wizardCaption="Rslt Engineer" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrsltn_engineer" sourceType="Table" connection="SMART" activeCollection="TableParameters" dataSource="smart_user" boundColumn="id" textColumn="usr_username">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="47" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
						<TableParameter id="267" conditionType="Parameter" useIsNull="False" field="usr_status" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="1"/>
</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="48" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_servicedate" fieldSource="rsltn_servicedate" required="True" caption="Service Date" wizardCaption="Rslt Servicedate" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrsltn_servicedate" format="dd/mm/yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="50" name="DatePicker_rslt_servicedate" control="rsltn_servicedate" wizardSatellite="True" wizardControl="rslt_servicedate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_resolutionDatePicker_rslt_servicedate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_serviceno" fieldSource="rsltn_servicennumber" required="True" caption="Service No." wizardCaption="Rslt Serviceno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrsltn_serviceno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="52" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_eta" fieldSource="rsltn_eta" required="False" caption="ETA" wizardCaption="Rslt Eta" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrsltn_eta" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_etd" fieldSource="rsltn_etd" required="False" caption="ETD" wizardCaption="Rslt Etd" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrsltn_etd" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="ticketNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionticketNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="57" fieldSourceType="DBColumn" dataType="Text" html="False" name="site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionsite">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="58" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ticketToppanid" required="False" caption="Toppan ID" wizardCaption="Rslt Toppanid" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionticketToppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ticketRelated" required="False" caption="Tag Related" wizardCaption="Rslt Related" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionticketRelated">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_inspection" fieldSource="rsltn_inspection" required="True" caption="Inspection" wizardCaption="Rslt Inspection" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrsltn_inspection">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="61" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_action" fieldSource="rsltn_actiontaken" required="True" caption="Action" wizardCaption="Rslt Action" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrsltn_action">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_planning" fieldSource="rsltn_planning" required="False" caption="Rslt Planning" wizardCaption="Rslt Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrsltn_planning">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="64" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_remark" fieldSource="rsltn_remark" required="False" caption="Rslt Remark" wizardCaption="Rslt Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_resolutionrsltn_remark">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Label id="65" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltnId" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionrsltnId" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="66" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutiondatemodified">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="167" fieldSourceType="DBColumn" dataType="Date" name="rsltn_datetosave" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionrsltn_datetosave" format="GeneralDate" defaultValue="CurrentDateTime" fieldSource="rsltn_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="168" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_customer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionrsltn_customer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="62" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_actionmethod" fieldSource="rsltn_actionmethod" required="False" caption="Method" wizardCaption="Rslt Method" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_resolutionrsltn_actionmethod" sourceType="ListOfValues" html="True" connection="SMART" _valueOfList="3" _nameOfList="Remote" dataSource="1;Phone Call;2;Visit Site;3;Remote" defaultValue="3">
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
				<Hidden id="164" fieldSourceType="DBColumn" dataType="Text" name="rsltn_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionrsltn_type" fieldSource="rsltn_type" defaultValue="CM">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="169" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_contact" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionrsltn_contact">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="216" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_contact2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionrsltn_contact2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="220" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_counter" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_resolutionrsltn_counter" fieldSource="rsltn_counter">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="67"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="68"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="213"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="218"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="219"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="69" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="rid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="70" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
				<EditableGrid id="235" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="50" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_measurement" name="GMeasurement" pageSizeLimit="100" wizardCaption="List of Smart Measurement " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="Panel2GMeasurement" pasteActions="pasteActions" activeCollection="TableParameters">
					<Components>
						<Label id="236" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Panel2GMeasurementid">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
						<ListBox id="237" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="msre_item" fieldSource="msre_item" required="True" caption="Item" wizardCaption="Msre Item" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="Panel2GMeasurementmsre_item" connection="SMART" dataSource="smart_sparepart" activeCollection="TableParameters" boundColumn="spart_code" textColumn="spart_name">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="238" conditionType="Parameter" useIsNull="False" field="spart_category" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="S"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="239" tableName="smart_sparepart" posLeft="10" posTop="10" posWidth="145" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextBox id="240" visible="Yes" fieldSourceType="DBColumn" dataType="Single" name="msre_before" fieldSource="msre_before" required="True" caption="Msre Before" wizardCaption="Msre Before" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementmsre_before">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="241" visible="Yes" fieldSourceType="DBColumn" dataType="Single" name="msre_after" fieldSource="msre_after" required="True" caption="Msre After" wizardCaption="Msre After" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementmsre_after">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="242" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="msre_remark" fieldSource="msre_remark" required="True" caption="Msre Remark" wizardCaption="Msre Remark" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementmsre_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<Button id="243" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel2GMeasurementButton_Submit">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="244" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel2GMeasurementCancel">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Hidden id="245" fieldSourceType="DBColumn" dataType="Text" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementresolution_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="246" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2GMeasurementdatemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events>
						<Event name="BeforeBuildInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="247"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="248"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="249"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="258"/>
							</Actions>
						</Event>
						<Event name="AfterSubmit" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="266"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="250" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rid"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="251" tableName="smart_measurement" posLeft="10" posTop="10" posWidth="115" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<PKFields>
						<PKField id="252" tableName="smart_measurement" fieldName="id" dataType="Integer"/>
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
						<Link id="101" fieldSourceType="DBColumn" dataType="Text" html="False" name="equipment_id" fieldSource="faultyequipment_id" wizardCaption="Equipment Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Panel3GSmartReplacementequipment_id" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="cmactivity.ccp">
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
						<ImageLink id="106" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="btnNewRec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3GSmartReplacementbtnNewRec" hrefSource="cmactivity.ccp" removeParameters="rplcid">
							<Components/>
							<Events/>
							<LinkParameters>
								<LinkParameter id="155" sourceType="URL" name="tcktid" source="tcktid"/>
								<LinkParameter id="156" sourceType="URL" name="rid" source="rid"/>
								<LinkParameter id="157" sourceType="Expression" name="rplc" source="1"/>
							</LinkParameters>
							<Attributes/>
							<Features/>
						</ImageLink>
						<Hidden id="208" fieldSourceType="DBColumn" dataType="Text" name="rplc_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3GSmartReplacementrplc_type" fieldSource="rplc_type">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Label id="215" fieldSourceType="DBColumn" dataType="Text" html="False" name="rplc_remark" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3GSmartReplacementrplc_remark" fieldSource="rplc_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Label>
					</Components>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="198"/>
							</Actions>
						</Event>
						<Event name="BeforeShowRow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="202"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="108" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rid"/>
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
				<Record id="130" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RSmartReplacement" dataSource="smart_replacement" errorSummator="Error" wizardCaption="Add/Edit Smart Replacement " wizardFormMethod="post" PathID="Panel3RSmartReplacement" pasteActions="pasteActions" activeCollection="TableParameters">
					<Components>
						<Button id="131" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="Panel3RSmartReplacementButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="132" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel3RSmartReplacementButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="133" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel3RSmartReplacementButton_Cancel">
							<Components/>
							<Events>
								<Event name="OnClick" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="161"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Button>
						<TextBox id="141" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rplc_serialnumber" fieldSource="rplc_currserial" required="True" caption="Current Serial" wizardCaption="Rplc Serialnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel3RSmartReplacementrplc_serialnumber">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextArea id="142" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rplc_remark" fieldSource="rplc_remark" required="True" caption="Rplc Remark" wizardCaption="Rplc Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Panel3RSmartReplacementrplc_remark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<Hidden id="135" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="resolution_id" fieldSource="resolution_id" required="True" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel3RSmartReplacementresolution_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="143" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel3RSmartReplacementdatemodified">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<ListBox id="190" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="rplc_equipment" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="Panel3RSmartReplacementrplc_equipment" fieldSource="faultyequipment_id" connection="SMART" dataSource="smart_equipment" boundColumn="id" textColumn="eqpmt_name" required="False">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="191" tableName="smart_equipment" posLeft="10" posTop="10" posWidth="154" posHeight="168"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<ListBox id="194" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="rplc_sparepart" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="Panel3RSmartReplacementrplc_sparepart" fieldSource="faultyequipment_id" connection="SMART" dataSource="smart_sparepart" boundColumn="id" textColumn="spart_name">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="195" tableName="smart_sparepart" posLeft="10" posTop="10" posWidth="145" posHeight="168"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<RadioButton id="136" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="itemtype" fieldSource="rplc_type" required="True" caption="Faultyequipment Id" wizardCaption="Faultyequipment Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel3RSmartReplacementitemtype" sourceType="ListOfValues" dataSource="eq;Equipment;sp;Spare Part" html="True">
							<Components/>
							<Events>
								<Event name="OnClick" type="Client">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="196"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
						</RadioButton>
						<TextBox id="206" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rplc_rplcserial" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel3RSmartReplacementrplc_rplcserial" caption="Replacement Serial No." fieldSource="rplc_rplcserial" required="True">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
					</Components>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="145"/>
							</Actions>
						</Event>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="207"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="211"/>
							</Actions>
						</Event>
						<Event name="BeforeBuildUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="212"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="253"/>
							</Actions>
						</Event>
						<Event name="AfterExecuteUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="254"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="134" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="rplcid"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="205" tableName="smart_replacement" posLeft="10" posTop="10" posWidth="144" posHeight="180"/>
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
		<Panel id="110" visible="True" name="Panel5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel5" pasteActions="pasteActions">
			<Components>
				<ImageLink id="111" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel5ImageLink1" hrefSource="ticketdetails.ccp" removeParameters="tcktid;rid;nl;new;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="112" sourceType="URL" format="yyyy-mm-dd" name="id" source="tcktid"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="113" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel5ImageLink2" hrefSource="cmactivityprint.php">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="114" sourceType="URL" format="yyyy-mm-dd" name="tcktid" source="tcktid"/>
						<LinkParameter id="115" sourceType="URL" format="yyyy-mm-dd" name="rid" source="rid"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="170"/>
					</Actions>
				</Event>
			</Events>
			<Attributes/>
			<Features/>
		</Panel>
		<EditableGrid id="171" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_attachment" name="smart_attachment" pageSizeLimit="100" wizardCaption="List of Smart Attachment " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="smart_attachment" deleteControl="CheckBox_Delete" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Hidden id="172" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_attachmentid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="173" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_byuser" required="False" caption="Attch Byuser" wizardCaption="Attch Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="174" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_name" fieldSource="attch_name" required="True" caption="Title" wizardCaption="Attch Name" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="175" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_date" fieldSource="attch_date" required="False" caption="Date" wizardCaption="Attch Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Panel id="177" visible="True" name="CheckBox_Delete_Panel">
					<Components>
						<CheckBox id="178" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="smart_attachmentCheckBox_Delete_PanelCheckBox_Delete">
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
				<Navigator id="179" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="180" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="smart_attachmentButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="181" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_attachmentCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<FileUpload id="182" fieldSourceType="DBColumn" allowedFileMasks="*.pdf;*.png;*.jpg;*.gif" fileSizeLimit="2097152" dataType="Text" tempFileFolder="temp" name="FileUpload" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentFileUpload" processedFileFolder="attachments" fieldSource="attch_sourcefile" caption="Attachment" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Hidden id="183" fieldSourceType="DBColumn" dataType="Text" name="storeuser" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentstoreuser" fieldSource="attch_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="184" fieldSourceType="DBColumn" dataType="Integer" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentresolution_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="200" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="210" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Database" urlType="Relative" preserveParameters="GET" name="att_link" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentatt_link" fieldSource="attch_sourcefile" hrefSource="attch_sourcefile" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="217" fieldSourceType="DBColumn" dataType="Date" html="False" name="lblDate" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentlblDate" format="GeneralDate" fieldSource="attch_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="264" fieldSourceType="DBColumn" dataType="Text" name="datemodified" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentdatemodified" fieldSource="datemodified" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="185"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="186"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="199"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="255"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="256"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="189" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="rid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="188" tableName="smart_attachment" posLeft="10" posTop="10" posWidth="123" posHeight="168"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="187" tableName="smart_attachment" fieldName="id" dataType="Integer"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="cmactivity.php" forShow="True" url="cmactivity.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="cmactivity_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="259" groupID="1"/>
		<Group id="260" groupID="2"/>
		<Group id="261" groupID="3"/>
		<Group id="262" groupID="5"/>
		<Group id="263" groupID="4"/>
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
