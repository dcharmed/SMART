<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Admin" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="adminheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="../footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RDelTicket" dataSource="smart_ticket" errorSummator="Error" wizardCaption="Add/Edit Smart Ticket " wizardFormMethod="post" PathID="RDelTicket" activeCollection="TableParameters">
			<Components>
				<Button id="6" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonDeleteOn" PathID="RDelTicketButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="7" message="You are about to delete this record. Are you really sure?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="8" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RDelTicketButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="64"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_refnumber" fieldSource="tckt_refnumber" required="False" caption="Tckt Refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RDelTickettckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="tckt_status" fieldSource="tckt_status" required="True" caption="Tckt Status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RDelTickettckt_status" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tckt_r_date" fieldSource="tckt_r_date" required="True" caption="Tckt R Date" wizardCaption="Tckt R Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RDelTickettckt_r_date" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_state" fieldSource="tckt_state" required="False" caption="Tckt State" wizardCaption="Tckt State" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RDelTickettckt_state" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_site" fieldSource="tckt_site" required="True" caption="Tckt Site" wizardCaption="Tckt Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RDelTickettckt_site" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_category" fieldSource="tckt_category" required="True" caption="Tckt Category" wizardCaption="Tckt Category" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RDelTickettckt_category" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tckt_subcategory" fieldSource="tckt_subcategory" required="False" caption="Tckt Subcategory" wizardCaption="Tckt Subcategory" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RDelTickettckt_subcategory" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
				<Event name="AfterDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="24"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="25"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="tckt_refnumber" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="d_tckt"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="21" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
		<Record id="18" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SDelTicket" wizardCaption="Search Smart Ticket " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="AdmTicMngmt.ccp" PathID="SDelTicket" pasteActions="pasteActions">
			<Components>
				<TextBox id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="d_tckt" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" PathID="SDelTicketd_tckt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="19" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SDelTicketButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
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
		<Grid id="26" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_ticket" name="GTickets" pageSizeLimit="100" wizardCaption="List of Smart Ticket " wizardGridType="Tabular" wizardSortingType="Extended" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" orderBy="tckt_r_date desc">
			<Components>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="smart_ticket_TotalRecords" wizardUseTemplateBlock="False" PathID="GTicketssmart_ticket_TotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="13" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="28" visible="True" name="Sorter_tckt_refnumber" column="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSortingType="Extended" wizardControl="tckt_refnumber" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="29" visible="True" name="Sorter_tckt_status" column="tckt_status" wizardCaption="Tckt Status" wizardSortingType="Extended" wizardControl="tckt_status" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="30" visible="True" name="Sorter_tckt_date" column="tckt_r_date" wizardCaption="Tckt Date" wizardSortingType="Extended" wizardControl="tckt_date" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="31" visible="True" name="Sorter_tckt_branch" column="tckt_site" wizardCaption="Tckt Branch" wizardSortingType="Extended" wizardControl="tckt_branch" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="32" visible="True" name="Sorter_tckt_severity" column="tckt_severity" wizardCaption="Tckt Severity" wizardSortingType="Extended" wizardControl="tckt_severity" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_severity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="33" visible="True" name="Sorter_tckt_adukomn" column="tckt_adukomn" wizardCaption="Tckt Adukomn" wizardSortingType="Extended" wizardControl="tckt_adukomn" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_adukomn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="34" visible="True" name="Sorter_tckt_toppanid" column="tckt_toppanid" wizardCaption="Tckt Toppanid" wizardSortingType="Extended" wizardControl="tckt_toppanid" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="35" visible="True" name="Sorter_tckt_esc" column="tckt_esc" wizardCaption="Tckt Esc" wizardSortingType="Extended" wizardControl="tckt_esc" wizardAddNbsp="False" PathID="GTicketsSorter_tckt_esc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Hidden id="36" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTicketsid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_refnumber" fieldSource="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketstckt_refnumber" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="../ticketdetails.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="38" sourceType="DataField" name="id" source="id"/>
					</LinkParameters>
				</Link>
				<Label id="39" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_status" fieldSource="tckt_status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTicketstckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Date" html="False" name="tckt_date" fieldSource="tckt_r_date" wizardCaption="Tckt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketstckt_date" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_branch" fieldSource="tckt_site" wizardCaption="Tckt Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketstckt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Integer" html="False" name="tckt_severity" fieldSource="tckt_severity" wizardCaption="Tckt Severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GTicketstckt_severity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_adukomn" fieldSource="tckt_r_adukomid" wizardCaption="Tckt Adukomn" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketstckt_adukomn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_toppanid" fieldSource="tckt_toppanid" wizardCaption="Tckt Toppanid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketstckt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_esc" fieldSource="tckt_escalate" wizardCaption="Tckt Esc" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketstckt_esc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Memo" html="False" name="tckt_description" fieldSource="tckt_description" wizardCaption="Tckt Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GTicketstckt_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="47" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" PathID="GTicketslblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="49" fieldSourceType="DBColumn" dataType="Text" name="tckt_state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketstckt_state" fieldSource="tckt_state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="50" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_age" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketstckt_age">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="False" name="tcktEng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketstcktEng">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="52" fieldSourceType="DBColumn" dataType="Date" name="tckt_c_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GTicketstckt_c_date" fieldSource="tckt_c_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="53" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="54"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="55"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="56" conditionType="Parameter" useIsNull="False" field="tckt_site" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1" parameterSource="s_branch"/>
				<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="tckt_refnumber" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" parameterSource="s_ref"/>
				<TableParameter id="58" conditionType="Parameter" useIsNull="False" field="tckt_r_date" dataType="Date" logicOperator="And" searchConditionType="GreaterThanOrEqual" parameterType="URL" orderNumber="3" parameterSource="s_sdate"/>
				<TableParameter id="59" conditionType="Parameter" useIsNull="False" field="tckt_r_date" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" parameterSource="s_edate"/>
				<TableParameter id="60" conditionType="Parameter" useIsNull="False" field="tckt_status" dataType="Integer" searchConditionType="LessThan" parameterType="URL" logicOperator="And" parameterSource="mode"/>
				<TableParameter id="61" conditionType="Parameter" useIsNull="False" field="tckt_severity" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_svr"/>
				<TableParameter id="62" conditionType="Parameter" useIsNull="False" field="tckt_status" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_status"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="63" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="65" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RRefGenerator" dataSource="smart_ticketgenerator" errorSummator="Error" wizardCaption="Add/Edit Smart Ticketgenerator " wizardFormMethod="post" PathID="RRefGenerator" activeCollection="TableParameters">
<Components>
<Button id="66" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RRefGeneratorButton_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="67" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RRefGeneratorButton_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="68" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RRefGeneratorButton_Cancel">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<ListBox id="70" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="type" fieldSource="type" required="False" caption="Type" wizardCaption="Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RRefGeneratortype" sourceType="ListOfValues" connection="SMART" _valueOfList="pm" _nameOfList="PM" dataSource="tckt;Ticketing;pm;PM">
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
</ListBox>
<TextBox id="71" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="year" fieldSource="year" required="False" caption="Year" wizardCaption="Year" wizardSize="5" wizardMaxLength="5" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RRefGeneratoryear">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="72" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="currentticket" fieldSource="currentticket" required="False" caption="Currentticket" wizardCaption="Currentticket" wizardSize="5" wizardMaxLength="5" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RRefGeneratorcurrentticket">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Link id="75" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RRefGeneratorLink1" hrefSource="AdmTicMngmt.ccp" wizardUseTemplateBlock="False" removeParameters="type;">
<Components/>
<Events/>
<LinkParameters>
<LinkParameter id="76" sourceType="Expression" format="yyyy-mm-dd" name="new" source="1"/>
<LinkParameter id="77" sourceType="Expression" format="yyyy-mm-dd" name="refgen" source="1"/>
</LinkParameters>
<Attributes/>
<Features/>
</Link>
</Components>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="79"/>
</Actions>
</Event>
<Event name="BeforeBuildSelect" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="80"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="69" conditionType="Parameter" useIsNull="False" field="type" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="type"/>
</TableParameters>
<SPParameters/>
<SQLParameters/>
<JoinTables>
<JoinTable id="78" tableName="smart_ticketgenerator" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="AdmTicMngmt.php" forShow="True" url="AdmTicMngmt.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="AdmTicMngmt_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="23"/>
			</Actions>
		</Event>
	</Events>
</Page>
