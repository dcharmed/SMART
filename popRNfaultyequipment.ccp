<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_faultyequipment" dataSource="smart_faultyequipment" errorSummator="Error" wizardCaption="Add/Edit Smart Faultyequipment " wizardFormMethod="post" PathID="smart_faultyequipment" pasteActions="pasteActions" activeCollection="TableParameters" visible="Dynamic">
			<Components>
				<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="smart_faultyequipmentButton_Insert">
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
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="smart_faultyequipmentButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="8" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_faultyequipmentButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="25" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="flty_date" fieldSource="flty_date" required="False" caption="Flty Date" wizardCaption="Flty Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_faultyequipmentflty_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="11" name="DatePicker_flty_date" control="flty_date" wizardSatellite="True" wizardControl="flty_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_faultyequipmentDatePicker_flty_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="flty_byuser" fieldSource="flty_byuser" required="False" caption="Flty Byuser" wizardCaption="Flty Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_faultyequipmentflty_byuser" sourceType="Table" connection="SMART" activeCollection="TableParameters" dataSource="smart_user" boundColumn="id" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="4"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="14" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<Hidden id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_faultyequipmentresolution_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_faultyequipmentdatemodified">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="17" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="eqpmt_serialnumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_faultyequipmenteqpmt_serialnumber" fieldSource="flty_serialnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features>
					</Features>
				</TextBox>
				<ListBox id="24" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="eqpmt_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="smart_faultyequipmenteqpmt_name" connection="SMART" dataSource="smart_equipment" boundColumn="id" textColumn="eqpmt_name">
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
						<Action actionName="Custom Code" actionCategory="General" id="20" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="resolution_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="rid"/>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="qpid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="23" tableName="smart_faultyequipment" posLeft="10" posTop="10" posWidth="115" posHeight="152"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="popRNfaultyequipment.php" forShow="True" url="popRNfaultyequipment.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="popRNfaultyequipment_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
