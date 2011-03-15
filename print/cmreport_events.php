<?php
//BindEvents Method @1-7AD1A523
require_once('../ghostscript/config.inc.php');
require_once('../ghostscript/pipeline.factory.class.php');
parse_config_file('../ghostscript/html2ps.config');

function convert_to_pdf($pdf) {

	class MyDestinationFile extends Destination {
		var $_dest_filename;

		function MyDestinationFile($dest_filename) {
			$this->_dest_filename = $dest_filename;
		}

		function process($tmp_filename, $content_type) {
			copy($tmp_filename, $this->_dest_filename);
		}
	}


	class MyDestinationDownload extends DestinationHTTP {
		function MyDestinationDownload($filename) {
			$this->DestinationHTTP($filename);
			$GLOBALS['PDFOutFileName'] = $filename;
		}

		function headers($content_type) {
			return array(
				"Content-Disposition: attachment; filename=".$GLOBALS['PDFOutFileName'].".".$content_type->default_extension,
				"Content-Transfer-Encoding: binary",
				"Cache-Control: must-revalidate, post-check=0, pre-check=0",
				"Pragma: public"
			);
		}
	}

	class MyFetcherLocalFile extends Fetcher {
	var $_content;

		function MyFetcherLocalFile() {
			$this->_content = "Test<!--NewPage-->Test<pagebreak/>Test<?page-break>Test";
		}

		function get_data($dummy1) {
			return new FetchedDataURL($this->_content, array(), "");
		}

		function get_base_url() {
			return "";
		}
	}



	$media = Media::predefined("A4");
	$media->set_landscape(false);
	$media->set_margins(array('left'   => 0,
        	                  'right'  => 0,
	                          'top'    => 0,
	                          'bottom' => 0));
	$media->set_pixels(1024); 

	$GLOBALS['g_config'] = array(
                  'cssmedia'     => 'screen',
                  'renderimages' => true,
                  'renderforms'  => false,
                  'renderlinks'  => true,
                  'renderfields'  => true,
                  'mode'         => 'html',
                  'debugbox'     => false,
                  'draw_page_border' => false,
                  );

	$g_px_scale = mm2pt($media->width() - $media->margins['left'] - $media->margins['right']) / $media->pixels;
	$g_pt_scale = $g_px_scale * 1.43; 

	$pipeline = new Pipeline;
        $pipeline->configure($GLOBALS['g_config']);
	$pipeline->fetchers[] = new MyFetcherLocalFile();
	// $pipeline->destination = new MyDestinationFile($pdf);
	$pipeline->destination = new MyDestinationDownload($pdf);
	$pipeline->data_filters[] = new DataFilterHTML2XHTML;
	$pipeline->pre_tree_filters = array();
	$header_html    = "test";
	$footer_html    = "test";
	$filter = new PreTreeFilterHeaderFooter($header_html, $footer_html);
	$pipeline->pre_tree_filters[] = $filter;
	$pipeline->pre_tree_filters[] = new PreTreeFilterHTML2PSFields();
	$pipeline->parser = new ParserXHTML();
	$pipeline->layout_engine = new LayoutEngineDefault;
	$pipeline->output_driver = new OutputDriverFPDF($media);

	$pipeline->process('', $media);
}

function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_BeforeOutput @1-C28A92E0
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cmreport; //Compatibility
//End Page_BeforeOutput

//Custom Code @3-2A29BDB7
// -------------------------
    convert_to_pdf();
// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput


?>
