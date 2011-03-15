<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="4" name="footer" PathID="footer" page="footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RAttachment" dataSource="smart_attachment" errorSummator="Error" wizardCaption="Add/Edit Smart Attachment " wizardFormMethod="post" PathID="RAttachment" pasteActions="pasteActions">
			<Components>
				<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RAttachmentButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RAttachmentButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="8" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonDeleteOn" PathID="RAttachmentButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="9" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="10" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RAttachmentButton_Cancel" removeParameters="att;">
					<Components/>
					<Events>
<Event name="OnClick" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="11"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="attch_byuser" fieldSource="attch_byuser" required="False" caption="Attch Byuser" wizardCaption="Attch Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RAttachmentattch_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_name" fieldSource="attch_name" required="True" caption="Title" wizardCaption="Attch Name" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RAttachmentattch_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="attch_date" fieldSource="attch_date" required="True" caption="Attch Date" wizardCaption="Attch Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RAttachmentattch_date" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="resolution_id" fieldSource="resolution_id" required="False" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RAttachmentresolution_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="byuser_toshow" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RAttachmentbyuser_toshow">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RAttachmentdatemodified" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<DatePicker id="18" name="DatePicker_attch_date1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RAttachmentDatePicker_attch_date1" control="attch_date" wizardDatePickerType="Image" wizardPicture="Styles/None/Images/DatePicker.gif" style="Styles/smartStyleTurqoise/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<FileUpload id="19" fieldSourceType="DBColumn" allowedFileMasks="*.pdf;*.jpg;*.gif" fileSizeLimit="2097152" dataType="Text" tempFileFolder="temp" name="FileUpload1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RAttachmentFileUpload1" fieldSource="attch_sourcefile" processedFileFolder="attachments" caption="Attachments" required="True">
<Components/>
<Events/>
<Attributes/>
<Features/>
</FileUpload>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="20"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="popattach.php" forShow="True" url="popattach.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="popattach_events.php" forShow="False" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
