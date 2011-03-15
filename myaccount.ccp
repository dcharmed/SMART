<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
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
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_user" dataSource="smart_user" errorSummator="Error" wizardCaption="Add/Edit Smart User " wizardFormMethod="post" PathID="smart_user" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="smart_userButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_userButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_username" fieldSource="usr_username" required="False" caption="Usr Username" wizardCaption="Usr Username" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_username" html="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_vpassword" required="False" caption="Verify Password" wizardCaption="Usr Password" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_vpassword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="usr_group" fieldSource="usr_group" required="False" caption="Usr Group" wizardCaption="Usr Group" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_group" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="usrgroup"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="31" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</Label>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_email" fieldSource="usr_email" required="True" caption="Usr Email" wizardCaption="Usr Email" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_email" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_fullname" fieldSource="usr_fullname" required="True" caption="Usr Fullname" wizardCaption="Usr Fullname" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_staffid" fieldSource="usr_staffid" required="True" caption="Usr Staffid" wizardCaption="Usr Staffid" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_staffid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_post" fieldSource="usr_post" required="False" caption="Usr Post" wizardCaption="Usr Post" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_post" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="userpost"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="33" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextArea id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="usr_address" fieldSource="usr_address" required="False" caption="Usr Address" wizardCaption="Usr Address" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_userusr_address">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<RadioButton id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_gender" fieldSource="usr_gender" required="False" caption="Usr Gender" wizardCaption="Usr Gender" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_gender" sourceType="ListOfValues" html="True" connection="SMART" _valueOfList="F" _nameOfList="Female" dataSource="M;Male;F;Female">
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
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_password" required="False" caption="Password" wizardCaption="Usr Password" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_userusr_password">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="26" fieldSourceType="DBColumn" dataType="Text" name="Password" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_userPassword" fieldSource="usr_password">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="29" fieldSourceType="DBColumn" dataType="Text" name="datemodified" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_userdatemodified" fieldSource="datemodified">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="usr_dateofbirth" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_userusr_dateofbirth" fieldSource="usr_dateofbirth" format="ShortDate" defaultValue="CurrentDate" required="False" caption="Date Of Birth">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="39" name="DatePicker_usr_dateofbirth" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_userDatePicker_usr_dateofbirth" control="usr_dateofbirth" wizardDatePickerType="Image" wizardPicture="Styles/None/Images/DatePicker.gif" style="Styles/None/Style.css">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="28"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="30"/>
					</Actions>
				</Event>
				<Event name="BeforeUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="35"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="36"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="37"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="uid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="27" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="myaccount.php" forShow="True" url="myaccount.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="myaccount_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
