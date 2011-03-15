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
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_task" dataSource="smart_task" errorSummator="Error" wizardCaption="Add/Edit Smart Task " wizardFormMethod="post" PathID="smart_task">
			<Components>
				<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="smart_taskButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="smart_taskButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="8" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="smart_taskButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_current" fieldSource="task_current" required="False" caption="Task Current" wizardCaption="Task Current" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tasktask_current">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="11" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="task_currenteng" fieldSource="task_currenteng" required="False" caption="Task Currenteng" wizardCaption="Task Currenteng" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="smart_tasktask_currenteng" connection="SMART" dataSource="smart_user" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="3"/>
						<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="5"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="12" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="13" tableName="smart_user" fieldName="id"/>
						<Field id="14" tableName="smart_user" fieldName="usr_username"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<Record id="17" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_attachment" dataSource="smart_attachment" errorSummator="Error" wizardCaption="Add/Edit Smart Attachment " wizardFormMethod="post" PathID="smart_attachment">
<Components>
<Button id="18" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="smart_attachmentButton_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="19" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="smart_attachmentButton_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="20" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="smart_attachmentButton_Delete">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<TextBox id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="resolution_id" fieldSource="resolution_id" required="True" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentresolution_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="attch_byuser" fieldSource="attch_byuser" required="True" caption="Attch Byuser" wizardCaption="Attch Byuser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_byuser">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="attch_name" fieldSource="attch_name" required="True" caption="Attch Name" wizardCaption="Attch Name" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="attch_date" fieldSource="attch_date" required="True" caption="Attch Date" wizardCaption="Attch Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentattch_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="27" name="DatePicker_attch_date" control="attch_date" wizardSatellite="True" wizardControl="attch_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_attachmentDatePicker_attch_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_attachmentdatemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="29" name="DatePicker_datemodified" control="datemodified" wizardSatellite="True" wizardControl="datemodified" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_attachmentDatePicker_datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<FileUpload id="30" fieldSourceType="DBColumn" allowedFileMasks="*.pdf" fileSizeLimit="2097152" dataType="Text" tempFileFolder="temp" name="FileUpload1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_attachmentFileUpload1" processedFileFolder="attachments">
<Components/>
<Events/>
<Attributes/>
<Features/>
</FileUpload>
</Components>
<Events/>
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
		<CodeFile id="Code" language="PHPTemplates" name="adda.php" forShow="True" url="adda.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
