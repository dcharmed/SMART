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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" name="GSmartPreventive" pageSizeLimit="100" wizardCaption="List of Smart Ticket " wizardGridType="Tabular" wizardSortingType="Extended" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" dataSource="smart_preventive" pasteActions="pasteActions" orderBy="prvt_date desc">
			<Components>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="GSmartPreventive_TotalRecords" wizardUseTemplateBlock="False" PathID="GSmartPreventiveGSmartPreventive_TotalRecords">
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
				<Sorter id="20" visible="True" name="Sorter_tckt_date" column="prvt_date" wizardCaption="Tckt Date" wizardSortingType="Extended" wizardControl="tckt_date" wizardAddNbsp="False" PathID="GSmartPreventiveSorter_tckt_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="21" visible="True" name="Sorter_tckt_branch" column="tckt_branch" wizardCaption="Tckt Branch" wizardSortingType="Extended" wizardControl="tckt_branch" wizardAddNbsp="False" PathID="GSmartPreventiveSorter_tckt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_tckt_etd" column="prvt_etd" wizardCaption="Tckt Severity" wizardSortingType="Extended" wizardControl="tckt_severity" wizardAddNbsp="False" PathID="GSmartPreventiveSorter_tckt_etd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_tckt_toppanid" column="tckt_toppanid" wizardCaption="Tckt Toppanid" wizardSortingType="Extended" wizardControl="tckt_toppanid" wizardAddNbsp="False" PathID="GSmartPreventiveSorter_tckt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_tckt_eta" column="prvt_eta" wizardCaption="Tckt Esc" wizardSortingType="Extended" wizardControl="tckt_esc" wizardAddNbsp="False" PathID="GSmartPreventiveSorter_tckt_eta">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Hidden id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSmartPreventiveid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="31" fieldSourceType="DBColumn" dataType="Date" html="False" name="prvt_date" fieldSource="prvt_date" wizardCaption="Tckt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartPreventiveprvt_date" format="GeneralDate" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="pmactivity.ccp" removeParameters="GSmartPreventivePage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="63" sourceType="DataField" name="pmid" source="id"/>
						<LinkParameter id="66" sourceType="DataField" name="rf" source="prvt_refnumber"/>
					</LinkParameters>
				</Link>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="prvt_branch" fieldSource="prvt_site" wizardCaption="Tckt Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartPreventiveprvt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Date" html="False" name="prvt_etd" fieldSource="prvt_etd" wizardCaption="Tckt Severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSmartPreventiveprvt_etd" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="prvt_toppanid" fieldSource="prvt_toppanid" wizardCaption="Tckt Toppanid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartPreventiveprvt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Date" html="False" name="prvt_eta" fieldSource="prvt_eta" wizardCaption="Tckt Esc" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSmartPreventiveprvt_eta" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="39" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" PathID="GSmartPreventivelblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="54" fieldSourceType="DBColumn" dataType="Text" name="prvt_state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartPreventiveprvt_state" fieldSource="prvt_state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="False" name="tcktEng2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartPreventivetcktEng2" fieldSource="prvt_byuser2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="tcktEng1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartPreventivetcktEng1" fieldSource="prvt_byuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="65" fieldSourceType="DBColumn" dataType="Text" html="False" name="refnumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GSmartPreventiverefnumber" fieldSource="prvt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="27" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="50" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="49" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="prvt_date" dataType="Date" searchConditionType="GreaterThanOrEqual" parameterType="URL" logicOperator="And" orderNumber="3" leftBrackets="0" rightBrackets="0" parameterSource="s_sdate"/>
				<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="prvt_date" dataType="Date" searchConditionType="LessThanOrEqual" parameterType="URL" logicOperator="And" leftBrackets="0" rightBrackets="0" parameterSource="s_edate"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="62" tableName="smart_preventive" posLeft="10" posTop="10" posWidth="159" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Search" wizardCaption="Search Smart Ticket " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="pmlist.ccp" PathID="Search" pasteActions="pasteActions">
			<Components>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_sdate" wizardCaption="Tckt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" PathID="Searchs_sdate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="11" name="DatePicker_s_sdate" control="s_sdate" wizardSatellite="True" wizardControl="s_tckt_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="SearchDatePicker_s_sdate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_edate" PathID="Searchs_edate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="41" name="DatePicker_s_edate" PathID="SearchDatePicker_s_edate" control="s_edate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SearchButton_DoSearch">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="pmlist_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="pmlist.php" forShow="True" url="pmlist.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
