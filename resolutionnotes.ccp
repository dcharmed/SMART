<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Panel id="2" visible="Dynamic" name="Panel1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1" features="(assigned)">
			<Components>
				<Panel id="4" visible="True" name="TabCMActivity" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabCMActivity" features="(assigned)">
					<Components>
						<Record id="12" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_resolution" errorSummator="Error" wizardCaption="Add/Edit Smart Resolution " wizardFormMethod="post" PathID="resolutionnotesPanel1TabCMActivitysmart_resolution" pasteActions="pasteActions" dataSource="smart_resolutionnote" activeCollection="TableParameters">
							<Components>
								<Button id="13" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionButton_Insert">
									<Components/>
									<Events>
										<Event name="OnClick" type="Server">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="68" eventType="Server"/>
											</Actions>
										</Event>
									</Events>
									<Attributes/>
									<Features/>
								</Button>
								<Button id="14" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionButton_Update">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Button>
								<Button id="15" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionButton_Cancel">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Button>
								<Hidden id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionticket_id">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Hidden>
								<TextBox id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_date" fieldSource="rsltn_date" required="True" caption="Date" wizardCaption="Rslt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_date">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
								<DatePicker id="18" name="DatePicker_rslt_date" control="rsltn_date" wizardSatellite="True" wizardControl="rslt_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionDatePicker_rslt_date">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</DatePicker>
								<ListBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="rsltn_engineer" fieldSource="rsltn_byuser" required="False" caption="Rslt Engineer" wizardCaption="Rslt Engineer" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_engineer" sourceType="Table" connection="SMART" activeCollection="TableParameters" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
									<TableParameters>
										<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
									</TableParameters>
									<SPParameters/>
									<SQLParameters/>
									<JoinTables>
										<JoinTable id="21" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
									</JoinTables>
									<JoinLinks/>
									<Fields/>
								</ListBox>
								<TextBox id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_servicedate" fieldSource="rsltn_servicedate" required="True" caption="Service Date" wizardCaption="Rslt Servicedate" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_servicedate">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
								<DatePicker id="23" name="DatePicker_rslt_servicedate" control="rsltn_servicedate" wizardSatellite="True" wizardControl="rslt_servicedate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionDatePicker_rslt_servicedate">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</DatePicker>
								<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_serviceno" fieldSource="rsltn_servicennumber" required="True" caption="Service No." wizardCaption="Rslt Serviceno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_serviceno">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
								<TextBox id="27" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_eta" fieldSource="rsltn_eta" required="False" caption="ETA" wizardCaption="Rslt Eta" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_eta">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
								<DatePicker id="28" name="DatePicker_rslt_eta" control="rsltn_eta" wizardSatellite="True" wizardControl="rslt_eta" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionDatePicker_rslt_eta">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</DatePicker>
								<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="rsltn_etd" fieldSource="rsltn_etd" required="False" caption="ETD" wizardCaption="Rslt Etd" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_etd">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
								<DatePicker id="30" name="DatePicker_rslt_etd" control="rsltn_etd" wizardSatellite="True" wizardControl="rslt_etd" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionDatePicker_rslt_etd">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</DatePicker>
								<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="False" name="ticketNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionticketNumber">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionsite">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ticketToppanid" required="False" caption="Toppan ID" wizardCaption="Rslt Toppanid" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionticketToppanid">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
								<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ticketRelated" required="False" caption="Tag Related" wizardCaption="Rslt Related" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionticketRelated">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
								<TextArea id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_inspection" fieldSource="rsltn_inspection" required="True" caption="Inspection" wizardCaption="Rslt Inspection" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_inspection">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextArea>
								<TextArea id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_action" fieldSource="rsltn_actiontaken" required="True" caption="Action" wizardCaption="Rslt Action" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_action">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextArea>
								<RadioButton id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rsltn_method" fieldSource="rsltn_actionmethod" required="False" caption="Rslt Method" wizardCaption="Rslt Method" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_method" sourceType="ListOfValues" html="True" connection="SMART" _valueOfList="3" _nameOfList="Remote" dataSource="1;Phone Call;2;Visit Site;3;Remote">
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
								</RadioButton>
								<TextArea id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_planning" fieldSource="rsltn_planning" required="False" caption="Rslt Planning" wizardCaption="Rslt Planning" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_planning">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextArea>
								<TextArea id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="rsltn_remark" fieldSource="rsltn_remark" required="False" caption="Rslt Remark" wizardCaption="Rslt Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltn_remark">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextArea>
								<Label id="66" fieldSourceType="DBColumn" dataType="Text" html="False" name="rsltnId" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutionrsltnId" fieldSource="id">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabCMActivitysmart_resolutiondatemodified" defaultValue="CurrentDateTime">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</TextBox>
							</Components>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="67" eventType="Server"/>
									</Actions>
								</Event>
								<Event name="AfterInsert" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="69" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<TableParameters>
								<TableParameter id="40" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="rid"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="59" tableName="smart_resolutionnote" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
						<YahooTabbedTab id="5" name="YahooTabbedTab" category="YahooUI">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Features/>
						</YahooTabbedTab>
					</Features>
				</Panel>
				<Panel id="6" visible="True" name="TabEquipment" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabEquipment" features="(assigned)" pasteActions="pasteActions">
					<Components>
						<Panel id="131" visible="Dynamic" name="Panel2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabEquipmentPanel2" features="(assigned)" pasteActions="pasteActions">
<Components>
<Grid id="41" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="smart_equipment" connection="SMART" dataSource="smart_faultyequipment" pageSizeLimit="100">
<Components>
<Label id="42" fieldSourceType="DBColumn" dataType="Integer" html="False" name="eqmt_type" fieldSource="equipment_id" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_equipmenteqmt_type">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Link id="43" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqmt_serialno" fieldSource="flty_serialnumber" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_equipmenteqmt_serialno" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketactivity.ccp" wizardUseTemplateBlock="False">
<Components/>
<Events/>
<Attributes/>
<Features/>
<LinkParameters>
<LinkParameter id="134" sourceType="URL" name="tcktid" source="tcktid"/>
<LinkParameter id="135" sourceType="URL" name="rid" source="rid"/>
<LinkParameter id="136" sourceType="DataField" name="eqid" source="equipment_id"/>
</LinkParameters>
</Link>
<Label id="44" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_equipmentid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<ImageLink id="70" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" name="btnNewRec" hrefSource="javascript:OpenFormEq();" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_equipmentbtnNewRec">
<Components/>
<Events/>
<LinkParameters/>
<Attributes/>
<Features/>
</ImageLink>
<Hidden id="129" fieldSourceType="DBColumn" dataType="Text" name="querystring" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_equipmentquerystring">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="133" eventType="Server"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="61" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" parameterSource="rid" logicOperator="And"/>
</TableParameters>
<JoinTables>
<JoinTable id="60" tableName="smart_faultyequipment" posWidth="115" posHeight="152" posLeft="10" posTop="10"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Record id="137" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_faultyequipment" dataSource="smart_faultyequipment" errorSummator="Error" wizardCaption="Add/Edit Smart Faultyequipment " wizardFormMethod="post" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipment" pasteActions="pasteActions" activeCollection="TableParameters" visible="Dynamic">
									<Components>
										<Button id="138" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentButton_Insert">
											<Components/>
											<Events>
<Event name="OnClick" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="26" eventType="Client"/>
</Actions>
</Event>
</Events>
											<Attributes/>
											<Features/>
										</Button>
										<Button id="139" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentButton_Update">
											<Components/>
											<Events/>
											<Attributes/>
											<Features/>
										</Button>
										<Button id="140" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentButton_Cancel">
											<Components/>
											<Events>
												<Event name="OnClick" type="Client">
													<Actions>
														<Action actionName="Custom Code" actionCategory="General" id="141" eventType="Client"/>
													</Actions>
												</Event>
											</Events>
											<Attributes/>
											<Features/>
										</Button>
										<TextBox id="142" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="flty_date" fieldSource="flty_date" required="False" caption="Flty Date" wizardCaption="Flty Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentflty_date">
											<Components/>
											<Events/>
											<Attributes/>
											<Features/>
										</TextBox>
										<DatePicker id="143" name="DatePicker_flty_date" control="flty_date" wizardSatellite="True" wizardControl="flty_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentDatePicker_flty_date">
											<Components/>
											<Events/>
											<Attributes/>
											<Features/>
										</DatePicker>
										<ListBox id="144" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="flty_byuser" fieldSource="flty_byuser" required="False" caption="Flty Byuser" wizardCaption="Flty Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentflty_byuser" sourceType="Table" connection="SMART" activeCollection="TableParameters" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname">
											<Components/>
											<Events/>
											<Attributes/>
											<Features/>
											<TableParameters>
												<TableParameter id="145" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="4"/>
											</TableParameters>
											<SPParameters/>
											<SQLParameters/>
											<JoinTables>
												<JoinTable id="146" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
											</JoinTables>
											<JoinLinks/>
											<Fields/>
										</ListBox>
										<Hidden id="147" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentresolution_id">
											<Components/>
											<Events/>
											<Attributes/>
											<Features/>
										</Hidden>
										<Hidden id="148" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentdatemodified">
											<Components/>
											<Events/>
											<Attributes/>
											<Features/>
										</Hidden>
										<TextBox id="149" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="eqpmt_serialnumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmenteqpmt_serialnumber" fieldSource="flty_serialnumber">
											<Components/>
											<Events/>
											<Attributes/>
											<Features>
											</Features>
										</TextBox>
										<ListBox id="150" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="eqpmt_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmenteqpmt_name" connection="SMART" dataSource="smart_equipment" boundColumn="id" textColumn="eqpmt_name">
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
									</Components>
									<Events>
										<Event name="BeforeShow" type="Server">
											<Actions>
												<Action actionName="Custom Code" actionCategory="General" id="151" eventType="Server"/>
											</Actions>
										</Event>
									</Events>
									<TableParameters>
										<TableParameter id="152" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="rid"/>
										<TableParameter id="153" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="qpid"/>
									</TableParameters>
									<SPParameters/>
									<SQLParameters/>
									<JoinTables>
										<JoinTable id="154" tableName="smart_faultyequipment" posLeft="10" posTop="10" posWidth="115" posHeight="152"/>
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
<UpdatePanel id="132" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax">
<Components/>
<Events/>
<ControlPoints/>
<Features/>
</UpdatePanel>
<HideShow id="155" enabled="True" name="HideShow1" category="Ajax" featureNameChanged="No" controlId="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipment" ccsIdsOnly="False" show="resolutionnotesPanel1TabEquipmentPanel2smart_equipmenteqmt_serialno.onclick;" hide="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentButton_Cancel.onclick;">
<Components/>
<Events/>
<ControlPoints>
<ControlPoint id="156" name="resolutionnotesPanel1TabEquipmentPanel2smart_equipmenteqmt_serialno.onclick" relProperty="show">
<Items>
<ControlPointItem id="157" name="resolutionnotes" ccpId="1" type="Page" isFeature="False" PathID="resolutionnotes"/>
<ControlPointItem id="158" name="Panel1" ccpId="2" type="Panel" isFeature="False" PathID="resolutionnotesPanel1"/>
<ControlPointItem id="159" name="TabEquipment" ccpId="6" type="Panel" isFeature="False" PathID="resolutionnotesPanel1TabEquipment"/>
<ControlPointItem id="160" name="Panel2" ccpId="131" type="Panel" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentPanel2"/>
<ControlPointItem id="161" name="smart_equipment" ccpId="41" type="Grid" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_equipment"/>
<ControlPointItem id="162" name="eqmt_serialno" ccpId="43" type="Link" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_equipmenteqmt_serialno"/>
</Items>
</ControlPoint>
<ControlPoint id="163" name="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentButton_Cancel.onclick" relProperty="hide">
<Items>
<ControlPointItem id="164" name="resolutionnotes" ccpId="1" type="Page" isFeature="False" PathID="resolutionnotes"/>
<ControlPointItem id="165" name="Panel1" ccpId="2" type="Panel" isFeature="False" PathID="resolutionnotesPanel1"/>
<ControlPointItem id="166" name="TabEquipment" ccpId="6" type="Panel" isFeature="False" PathID="resolutionnotesPanel1TabEquipment"/>
<ControlPointItem id="167" name="Panel2" ccpId="131" type="Panel" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentPanel2"/>
<ControlPointItem id="168" name="smart_faultyequipment" ccpId="137" type="Record" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipment"/>
<ControlPointItem id="169" name="Button_Cancel" ccpId="140" type="Button" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentPanel2smart_faultyequipmentButton_Cancel"/>
</Items>
</ControlPoint>
</ControlPoints>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Features/>
</HideShow>
</Features>
</Panel>
</Components>
					<Events/>
					<Attributes/>
					<Features>
						<YahooTabbedTab id="7" name="YahooTabbedTab" category="YahooUI">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Features/>
						</YahooTabbedTab>
					</Features>
				</Panel>
				<Panel id="8" visible="True" name="TabSparePart" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabSparePart" features="(assigned)">
					<Components>
						<Grid id="45" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_measurement" name="smart_measurement" pageSizeLimit="100" wizardCaption="List of Smart Measurement " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" pasteActions="pasteActions">
							<Components>
								<Label id="46" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabSparePartsmart_measurementlblNumber">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="False" name="msre_item" fieldSource="msre_item" wizardCaption="Msre Item" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabSparePartsmart_measurementmsre_item">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="48" fieldSourceType="DBColumn" dataType="Single" html="False" name="msre_before" fieldSource="msre_before" wizardCaption="Msre Before" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabSparePartsmart_measurementmsre_before">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="49" fieldSourceType="DBColumn" dataType="Single" html="False" name="msre_after" fieldSource="msre_after" wizardCaption="Msre After" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabSparePartsmart_measurementmsre_after">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="50" fieldSourceType="DBColumn" dataType="Memo" html="False" name="msre_remark" fieldSource="msre_remark" wizardCaption="Msre Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabSparePartsmart_measurementmsre_remark">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<ImageLink id="71" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="btnNewRec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabSparePartsmart_measurementbtnNewRec" hrefSource="#">
									<Components/>
									<Events/>
									<LinkParameters/>
									<Attributes/>
									<Features/>
								</ImageLink>
							</Components>
							<Events/>
							<TableParameters>
								<TableParameter id="63" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="rid"/>
							</TableParameters>
							<JoinTables>
								<JoinTable id="62" tableName="smart_measurement" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
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
					<Events/>
					<Attributes/>
					<Features>
						<YahooTabbedTab id="9" name="YahooTabbedTab" category="YahooUI">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Features/>
						</YahooTabbedTab>
					</Features>
				</Panel>
				<Panel id="10" visible="True" name="TabReplacement" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabReplacement" features="(assigned)" pasteActions="pasteActions">
					<Components>
						<Grid id="51" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_replacement" name="smart_replacement" pageSizeLimit="100" wizardCaption="List of Smart Replacement " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" pasteActions="pasteActions">
							<Components>
								<Label id="52" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabReplacementsmart_replacementlblNumber">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="54" fieldSourceType="DBColumn" dataType="Integer" html="False" name="equipment_id" fieldSource="faultyequipment_id" wizardCaption="Equipment Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabReplacementsmart_replacementequipment_id">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="55" fieldSourceType="DBColumn" dataType="Integer" html="False" name="equipment_serialno" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabReplacementsmart_replacementequipment_serialno">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="rplc_serialnumber" fieldSource="rplc_serialnumber" wizardCaption="Rplmt Serialno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabReplacementsmart_replacementrplc_serialnumber">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Label id="57" fieldSourceType="DBColumn" dataType="Memo" html="False" name="rplc_remark" fieldSource="rplc_remark" wizardCaption="Rplmt Remark" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="resolutionnotesPanel1TabReplacementsmart_replacementrplc_remark">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
								<Navigator id="58" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Navigator>
								<ImageLink id="72" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="btnNewRec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabReplacementsmart_replacementbtnNewRec" hrefSource="#">
									<Components/>
									<Events/>
									<LinkParameters/>
									<Attributes/>
									<Features/>
								</ImageLink>
								<Label id="73" fieldSourceType="DBColumn" dataType="Text" html="False" name="rplc_method" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="resolutionnotesPanel1TabReplacementsmart_replacementrplc_method" fieldSource="rplc_method">
									<Components/>
									<Events/>
									<Attributes/>
									<Features/>
								</Label>
							</Components>
							<Events/>
							<TableParameters>
								<TableParameter id="65" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="rid"/>
							</TableParameters>
							<JoinTables>
								<JoinTable id="64" tableName="smart_replacement" posLeft="10" posTop="10" posWidth="144" posHeight="180"/>
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
					<Events/>
					<Attributes/>
					<Features>
						<YahooTabbedTab id="11" name="YahooTabbedTab" category="YahooUI">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Features/>
						</YahooTabbedTab>
					</Features>
				</Panel>
			</Components>
			<Events/>
			<Attributes/>
			<Features>
				<YahooTabbedView id="3" name="YahooTabbedView" category="YahooUI">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Features/>
				</YahooTabbedView>
				<UpdatePanel id="94" enabled="True" childrenAsTriggers="True" name="UpdatePanel1" category="Ajax" featureNameChanged="No">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
				<ClientCustomCode id="95" enabled="True" name="ClientCustomCode2" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" start="resolutionnotesPanel1TabEquipmentsmart_equipmentbtnNewRec.onclick;">
					<Components/>
					<Events/>
					<ControlPoints>
						<ControlPoint id="96" name="resolutionnotesPanel1TabEquipmentsmart_equipmentbtnNewRec.onclick" relProperty="start">
							<Items>
								<ControlPointItem id="97" name="resolutionnotes" ccpId="1" type="Page" isFeature="False" PathID="resolutionnotes"/>
								<ControlPointItem id="98" name="Panel1" ccpId="2" type="Panel" isFeature="False" PathID="resolutionnotesPanel1"/>
								<ControlPointItem id="99" name="TabEquipment" ccpId="6" type="Panel" isFeature="False" PathID="resolutionnotesPanel1TabEquipment"/>
								<ControlPointItem id="100" name="smart_equipment" ccpId="41" type="Grid" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentsmart_equipment"/>
								<ControlPointItem id="101" name="btnNewRec" ccpId="70" type="ImageLink" isFeature="False" PathID="resolutionnotesPanel1TabEquipmentsmart_equipmentbtnNewRec"/>
							</Items>
						</ControlPoint>
					</ControlPoints>
					<Features/>
				</ClientCustomCode>
			</Features>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="resolutionnotes_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="resolutionnotes.php" forShow="True" url="resolutionnotes.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
