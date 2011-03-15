<?php
//Service Class @100-1917590E
class Service {
	
	/**
	 * Unique service identifier
	 * @var string
	 */
	var $ServiceId;
	
	/**
	 * CCS database object
	 * @var mixed
	 */
	var $DataSource;
	
	/**
	 * Database SQL query
	 * @var string
	 */
	var $DataSourceQuery;
	
	/**
	 * Database fields
	 * @var array
	 */
	var $DataSourceFields = null;
	
	/**
	 * Resulting dataset
	 * @var array
	 */
	var $DataSet = array();
	
	/**
	 * Response headers
	 * @var array
	 */
	var $HttpHeaders = array();
	
	/**
	 * Object, formatting service output
	 * @var OutputFormatter
	 */
	var $OutputFormatter = null;
	
	/**
	 * Source of input data
	 * @var integer
	 */
	var $InputFetcher;
	
	/**
	 * Object, parsing input data
	 * @var InputParser
	 */
	var $InputParser = null;
	
	
	/**
	 * Service input data
	 * @var mixed
	 */
	var $InputData = null;
	
	/**
	 * Output regular or associative arrays
	 * @var boolean
	 */
	var $OutputAssoc = true;
	
	var $Errors;
	
	/**
	 * Class constructor
	 * @constructor
	 */
	function Service() {
		// Set defaults
		$this->InputFetcher = new GetInputFetcher();
		$this->InputParser = new JsonParser();
		$this->OutputFormatter = new JsonFormatter();
		$this->Errors = new clsErrors();
		ob_start();
	}
	
	function SetId($ServiceId) {
		$this->ServiceId = $ServiceId;
		return $this->ServiceId;
	}
	
	function GetId() {
		return $this->ServiceId;
	}
	
	function SetDataSource($DataSource) {
		$this->DataSource = $DataSource;
	}
	
	function SetFormatter($OutputFomatter) {
		$this->OutputFormatter = $OutputFomatter;
		return $this->OutputFormatter;
	}
	
	function GetFormatter() {
		return $this->OutputFormatter;
	}
	
	function SetInputType($InputType) {
		$this->InputType = $InputType;
	}
	
	function SetParser($InputParser) {
		$this->InputParser = $InputParser;
		return $this->InputParser;
	}
	
	function GetParser() {
		return $this->InputParser;
	}
	
	function SetDataSourceFields($DataSourceFields) {
		$this->DataSourceFields = $DataSourceFields;
		return $this->DataSourceFields;
	}
	
	function SetAssociativeOutput($AssociativeOutput) {
		$this->OutputAssoc = $AssociativeOutput;
		return $this->OutputAssoc;
	}
	
	function GetAssociativeOutput() {
		return $this->OutputAssoc;
	}
	
	/**
	 * @param string $databaseField Could be instance of DatabaseField
	 * @param integer $fieldType
	 * @param string $fieldFormat
	 */
	function AddDataSourceField($DataSourceField, $FieldType = ccsText, $FieldFormat = '') {
		if (!is_array($this->DataSourceFields)) {
			$this->DataSourceFields = array();
		}
		if (is_a($DataSourceField, 'DatabaseField')) {
			$this->DataSourceFields[] = $DataSourceField;
			return $DataSourceField;
		}
		if (is_string($DataSourceField)) {
			$FieldObject = new clsField($DataSourceField, $FieldType, $FieldFormat);
			$this->DataSourceFields[] = $FieldObject;
			return $FieldObject;
		}
		return false;
	}
	
	function AddHttpHeader($HeaderName, $HeaderValue) {
		$this->HttpHeaders[$HeaderName] = $HeaderValue;
	}
	
	function SetDataSourceQuery($DataSourceQuery) {
		$this->DataSourceQuery = $DataSourceQuery;
	}
	
	/**
	 * Fetches data form database and filters only specified fields
	 */
	function GetDataSourceData() {
		$this->DataSource->query($this->DataSourceQuery);
		$RowNumber = 0;
		while ($this->DataSource->next_record() && (!$this->DataSource->PageSize || $RowNumber < $this->DataSource->PageSize)) {
			if (is_null($this->DataSourceFields)) {
				$this->DataSet[] = $this->DataSource->Record;
			} else {
				$DataRow = array();
				foreach ($this->DataSourceFields as $Field) {
					$Field->SetValue($this->DataSource->f($Field->Name));
					if ($this->OutputAssoc) {
						$DataRow[$Field->Name] = $Field->GetFormattedValue();
					} else {
						$DataRow[] = $Field->GetFormattedValue();
					}
				}
				$this->DataSet[] = $DataRow;
			}
		$RowNumber++;
		}
	}
	
	function DisplayHeaders() {
		foreach ($this->HttpHeaders as $HeaderName => $HeaderValue) {
			header($HeaderName . ': ' . $HeaderValue);
		}
	}
	
	/**
	 * Executes service
	 * @return string
	 */
	function Execute() {
		$this->GetDataSourceData();
		$RawPageErrors = strip_tags(ob_get_clean());
		if (strlen($RawPageErrors)) {
			$this->Errors->addError($RawPageErrors);
		}
		if ($this->DataSource->Error) {
			$this->Errors->addError('Database error: ' . $this->DataSource->Error);
		}
		if (!is_null($this->OutputFormatter)) {
			if ($this->Errors->Count()) {
				header('HTTP/1.0 409 Conflict');
				return $this->FormatErrors();
			} else {
				return $this->OutputFormatter->Format($this->DataSet);
			}
		}
	}
	
	function FormatErrors() {
		return implode("\n", $this->Errors->Errors);
	}
	
	/**
	 * Gets input data according based on inputType
	 * @return string
	 */
	function GetInput() {
		return $this->InputFetcher->Fetch();
	}
	
	/**
	 * Gets parsed input data
	 * @return mixed
	 */
	function GetInputData($DataIndex = null) {
		if (is_null($this->InputData)) {
			if (!is_null($this->InputParser)) {
				$this->InputData = $this->InputParser->Parse($this->GetInput());
			}
		}
		if (is_null($DataIndex)) {
			return $this->InputData;
		} elseif (isset($this->InputData[$DataIndex])) {
			return $this->InputData[$DataIndex];
		}
		return null;
	}
	
	function AddDataSetValue($Key, $Value) {
		$this->DataSet[$Key] = $Value;
	}
}

//End Service Class

//ServicesRegistry Class @100-F7E452EA
class ServicesRegistry {
	var $ServicesCollection = array();
	
	function GetService($ServiceId) {
		return isset($this->ServicesCollection[$ServiceId])?$this->ServicesCollection[$ServiceId]:null;
	}
	
	function AddService($ServiceObject) {
		$this->ServicesCollection[$ServiceObject->GetId()] = $ServiceObject;
		return $this->ServicesCollection[$ServiceObject->GetId()];
	}
	
	function RemoveService($Service) {
		if (is_a($Service, 'Service')) {
			if (isset($this->ServicesCollection[$Service->GetId()])) {
				unset($this->ServicesCollection[$Service->GetId()]);
			}
		} else {
			if (isset($this->ServicesCollection[$Service])) {
				unset($this->ServicesCollection[$Service]);
			}
		}
	}
	
	function Clear() {
		$this->ServicesCollection = array();
	}
}

//End ServicesRegistry Class

//InputFetcher Class @100-C599E205
class InputFetcher {
	function Fetch() {
		return null;
	}
}

//End InputFetcher Class

//GetInputFetcher Class @100-4B23F895
class GetInputFetcher {
	function Fetch() {
		return CCGetFromGet('data', null);
	}
}

//End GetInputFetcher Class

//PostInputFetcher Class @100-9DC7A80E
class PostInputFetcher {
	function Fetch() {
		return file_get_contents('php://input');
	}
}

//End PostInputFetcher Class

//Services_JSON Class @100-41A060B5
/**
* Converts to and from JSON format.
*
* JSON (JavaScript Object Notation) is a lightweight data-interchange
* format. It is easy for humans to read and write. It is easy for machines
* to parse and generate. It is based on a subset of the JavaScript
* Programming Language, Standard ECMA-262 3rd Edition - December 1999.
* This feature can also be found in  Python. JSON is a text format that is
* completely language independent but uses conventions that are familiar
* to programmers of the C-family of languages, including C, C++, C#, Java,
* JavaScript, Perl, TCL, and many others. These properties make JSON an
* ideal data-interchange language.
*
* This package provides a simple encoder and decoder for JSON notation. It
* is intended for use with client-side Javascript applications that make
* use of HTTPRequest to perform server communication functions - data can
* be encoded into JSON notation for use in a client-side javascript, or
* decoded from incoming Javascript requests. JSON format is native to
* Javascript, and can be directly eval()'ed with no further parsing
* overhead
*
* All strings should be in ASCII or UTF-8 format!
*
* LICENSE: Redistribution and use in source and binary forms, with or
* without modification, are permitted provided that the following
* conditions are met: Redistributions of source code must retain the
* above copyright notice, this list of conditions and the following
* disclaimer. Redistributions in binary form must reproduce the above
* copyright notice, this list of conditions and the following disclaimer
* in the documentation and/or other materials provided with the
* distribution.
*
* THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED
* WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
* MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN
* NO EVENT SHALL CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS
* OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
* ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
* TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
* USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
* DAMAGE.
*
* @category
* @package     Services_JSON
* @author      Michal Migurski <mike-json@teczno.com>
* @author      Matt Knapp <mdknapp[at]gmail[dot]com>
* @author      Brett Stimmerman <brettstimmerman[at]gmail[dot]com>
* @copyright   2005 Michal Migurski
* @version     CVS: $Id: JSON.php,v 1.31 2006/06/28 05:54:17 migurski Exp $
* @license     http://www.opensource.org/licenses/bsd-license.php
* @link        http://pear.php.net/pepr/pepr-proposal-show.php?id=198
*/

/**
* Marker constant for Services_JSON::decode(), used to flag stack state
*/
define('SERVICES_JSON_SLICE',   1);

/**
* Marker constant for Services_JSON::decode(), used to flag stack state
*/
define('SERVICES_JSON_IN_STR',  2);

/**
* Marker constant for Services_JSON::decode(), used to flag stack state
*/
define('SERVICES_JSON_IN_ARR',  3);

/**
* Marker constant for Services_JSON::decode(), used to flag stack state
*/
define('SERVICES_JSON_IN_OBJ',  4);

/**
* Marker constant for Services_JSON::decode(), used to flag stack state
*/
define('SERVICES_JSON_IN_CMT', 5);

/**
* Behavior switch for Services_JSON::decode()
*/
define('SERVICES_JSON_LOOSE_TYPE', 16);

/**
* Behavior switch for Services_JSON::decode()
*/
define('SERVICES_JSON_SUPPRESS_ERRORS', 32);

/**
* Converts to and from JSON format.
*
* Brief example of use:
*
* <code>
* // create a new instance of Services_JSON
* $json = new Services_JSON();
*
* // convert a complexe value to JSON notation, and send it to the browser
* $value = array('foo', 'bar', array(1, 2, 'baz'), array(3, array(4)));
* $output = $json->encode($value);
*
* print($output);
* // prints: ["foo","bar",[1,2,"baz"],[3,[4]]]
*
* // accept incoming POST data, assumed to be in JSON notation
* $input = file_get_contents('php://input', 1000000);
* $value = $json->decode($input);
* </code>
*/
class Services_JSON
{
   /**
    * constructs a new JSON instance
    *
    * @param    int     $use    object behavior flags; combine with boolean-OR
    *
    *                           possible values:
    *                           - SERVICES_JSON_LOOSE_TYPE:  loose typing.
    *                                   "{...}" syntax creates associative arrays
    *                                   instead of objects in decode().
    *                           - SERVICES_JSON_SUPPRESS_ERRORS:  error suppression.
    *                                   Values which can't be encoded (e.g. resources)
    *                                   appear as NULL instead of throwing errors.
    *                                   By default, a deeply-nested resource will
    *                                   bubble up with an error, so all return values
    *                                   from encode() should be checked with isError()
    */
    function Services_JSON($use = 0)
    {
        $this->use = $use;
    }

   /**
    * convert a string from one UTF-16 char to one UTF-8 char
    *
    * Normally should be handled by mb_convert_encoding, but
    * provides a slower PHP-only method for installations
    * that lack the multibye string extension.
    *
    * @param    string  $utf16  UTF-16 character
    * @return   string  UTF-8 character
    * @access   private
    */
    function utf162utf8($utf16)
    {
        // oh please oh please oh please oh please oh please
        if(function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($utf16, 'UTF-8', 'UTF-16');
        }

        $bytes = (ord($utf16{0}) << 8) | ord($utf16{1});

        switch(true) {
            case ((0x7F & $bytes) == $bytes):
                // this case should never be reached, because we are in ASCII range
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0x7F & $bytes);

            case (0x07FF & $bytes) == $bytes:
                // return a 2-byte UTF-8 character
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0xC0 | (($bytes >> 6) & 0x1F))
                     . chr(0x80 | ($bytes & 0x3F));

            case (0xFFFF & $bytes) == $bytes:
                // return a 3-byte UTF-8 character
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0xE0 | (($bytes >> 12) & 0x0F))
                     . chr(0x80 | (($bytes >> 6) & 0x3F))
                     . chr(0x80 | ($bytes & 0x3F));
        }

        // ignoring UTF-32 for now, sorry
        return '';
    }

   /**
    * convert a string from one UTF-8 char to one UTF-16 char
    *
    * Normally should be handled by mb_convert_encoding, but
    * provides a slower PHP-only method for installations
    * that lack the multibye string extension.
    *
    * @param    string  $utf8   UTF-8 character
    * @return   string  UTF-16 character
    * @access   private
    */
    function utf82utf16($utf8)
    {
        // oh please oh please oh please oh please oh please
        if(function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($utf8, 'UTF-16', 'UTF-8');
        }

        switch(strlen($utf8)) {
            case 1:
                // this case should never be reached, because we are in ASCII range
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return $utf8;

            case 2:
                // return a UTF-16 character from a 2-byte UTF-8 char
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0x07 & (ord($utf8{0}) >> 2))
                     . chr((0xC0 & (ord($utf8{0}) << 6))
                         | (0x3F & ord($utf8{1})));

            case 3:
                // return a UTF-16 character from a 3-byte UTF-8 char
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr((0xF0 & (ord($utf8{0}) << 4))
                         | (0x0F & (ord($utf8{1}) >> 2)))
                     . chr((0xC0 & (ord($utf8{1}) << 6))
                         | (0x7F & ord($utf8{2})));
        }

        // ignoring UTF-32 for now, sorry
        return '';
    }

   /**
    * encodes an arbitrary variable into JSON format
    *
    * @param    mixed   $var    any number, boolean, string, array, or object to be encoded.
    *                           see argument 1 to Services_JSON() above for array-parsing behavior.
    *                           if var is a strng, note that encode() always expects it
    *                           to be in ASCII or UTF-8 format!
    *
    * @return   mixed   JSON string representation of input var or an error if a problem occurs
    * @access   public
    */
    function encode($var)
    {
        switch (gettype($var)) {
            case 'boolean':
                return $var ? 'true' : 'false';

            case 'NULL':
                return 'null';

            case 'integer':
                return (int) $var;

            case 'double':
            case 'float':
                return (float) $var;

            case 'string':
                // STRINGS ARE EXPECTED TO BE IN ASCII OR UTF-8 FORMAT
                $ascii = '';
                $strlen_var = strlen($var);

               /*
                * Iterate over every character in the string,
                * escaping with a slash or encoding to UTF-8 where necessary
                */
                for ($c = 0; $c < $strlen_var; ++$c) {

                    $ord_var_c = ord($var{$c});

                    switch (true) {
                        case $ord_var_c == 0x08:
                            $ascii .= '\b';
                            break;
                        case $ord_var_c == 0x09:
                            $ascii .= '\t';
                            break;
                        case $ord_var_c == 0x0A:
                            $ascii .= '\n';
                            break;
                        case $ord_var_c == 0x0C:
                            $ascii .= '\f';
                            break;
                        case $ord_var_c == 0x0D:
                            $ascii .= '\r';
                            break;

                        case $ord_var_c == 0x22:
                        case $ord_var_c == 0x2F:
                        case $ord_var_c == 0x5C:
                            // double quote, slash, slosh
                            $ascii .= '\\'.$var{$c};
                            break;

                        case (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)):
                            // characters U-00000000 - U-0000007F (same as ASCII)
                            $ascii .= $var{$c};
                            break;

                        case (($ord_var_c & 0xE0) == 0xC0):
                            // characters U-00000080 - U-000007FF, mask 110XXXXX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c, ord($var{$c + 1}));
                            $c += 1;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xF0) == 0xE0):
                            // characters U-00000800 - U-0000FFFF, mask 1110XXXX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}));
                            $c += 2;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xF8) == 0xF0):
                            // characters U-00010000 - U-001FFFFF, mask 11110XXX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}),
                                         ord($var{$c + 3}));
                            $c += 3;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xFC) == 0xF8):
                            // characters U-00200000 - U-03FFFFFF, mask 111110XX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}),
                                         ord($var{$c + 3}),
                                         ord($var{$c + 4}));
                            $c += 4;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xFE) == 0xFC):
                            // characters U-04000000 - U-7FFFFFFF, mask 1111110X
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}),
                                         ord($var{$c + 3}),
                                         ord($var{$c + 4}),
                                         ord($var{$c + 5}));
                            $c += 5;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;
                    }
                }

                return '"'.$ascii.'"';

            case 'array':
               /*
                * As per JSON spec if any array key is not an integer
                * we must treat the the whole array as an object. We
                * also try to catch a sparsely populated associative
                * array with numeric keys here because some JS engines
                * will create an array with empty indexes up to
                * max_index which can cause memory issues and because
                * the keys, which may be relevant, will be remapped
                * otherwise.
                *
                * As per the ECMA and JSON specification an object may
                * have any string as a property. Unfortunately due to
                * a hole in the ECMA specification if the key is a
                * ECMA reserved word or starts with a digit the
                * parameter is only accessible using ECMAScript's
                * bracket notation.
                */

                // treat as a JSON object
                if (is_array($var) && count($var) && (array_keys($var) !== range(0, sizeof($var) - 1))) {
                    $properties = array_map(array($this, 'name_value'),
                                            array_keys($var),
                                            array_values($var));

                    foreach($properties as $property) {
                        if(Services_JSON::isError($property)) {
                            return $property;
                        }
                    }

                    return '{' . join(',', $properties) . '}';
                }

                // treat it like a regular array
                $elements = array_map(array($this, 'encode'), $var);

                foreach($elements as $element) {
                    if(Services_JSON::isError($element)) {
                        return $element;
                    }
                }

                return '[' . join(',', $elements) . ']';

            case 'object':
                $vars = get_object_vars($var);

                $properties = array_map(array($this, 'name_value'),
                                        array_keys($vars),
                                        array_values($vars));

                foreach($properties as $property) {
                    if(Services_JSON::isError($property)) {
                        return $property;
                    }
                }

                return '{' . join(',', $properties) . '}';

            default:
                return ($this->use & SERVICES_JSON_SUPPRESS_ERRORS)
                    ? 'null'
                    : new Services_JSON_Error(gettype($var)." can not be encoded as JSON string");
        }
    }

   /**
    * array-walking function for use in generating JSON-formatted name-value pairs
    *
    * @param    string  $name   name of key to use
    * @param    mixed   $value  reference to an array element to be encoded
    *
    * @return   string  JSON-formatted name-value pair, like '"name":value'
    * @access   private
    */
    function name_value($name, $value)
    {
        $encoded_value = $this->encode($value);

        if(Services_JSON::isError($encoded_value)) {
            return $encoded_value;
        }

        return $this->encode(strval($name)) . ':' . $encoded_value;
    }

   /**
    * reduce a string by removing leading and trailing comments and whitespace
    *
    * @param    $str    string      string value to strip of comments and whitespace
    *
    * @return   string  string value stripped of comments and whitespace
    * @access   private
    */
    function reduce_string($str)
    {
        $str = preg_replace(array(

                // eliminate single line comments in '// ...' form
                '#^\s*//(.+)$#m',

                // eliminate multi-line comments in '/* ... */' form, at start of string
                '#^\s*/\*(.+)\*/#Us',

                // eliminate multi-line comments in '/* ... */' form, at end of string
                '#/\*(.+)\*/\s*$#Us'

            ), '', $str);

        // eliminate extraneous space
        return trim($str);
    }

   /**
    * decodes a JSON string into appropriate variable
    *
    * @param    string  $str    JSON-formatted string
    *
    * @return   mixed   number, boolean, string, array, or object
    *                   corresponding to given JSON input string.
    *                   See argument 1 to Services_JSON() above for object-output behavior.
    *                   Note that decode() always returns strings
    *                   in ASCII or UTF-8 format!
    * @access   public
    */
    function decode($str)
    {
        $str = $this->reduce_string($str);

        switch (strtolower($str)) {
            case 'true':
                return true;

            case 'false':
                return false;

            case 'null':
                return null;

            default:
                $m = array();

                if (is_numeric($str)) {
                    // Lookie-loo, it's a number

                    // This would work on its own, but I'm trying to be
                    // good about returning integers where appropriate:
                    // return (float)$str;

                    // Return float or int, as appropriate
                    return ((float)$str == (integer)$str)
                        ? (integer)$str
                        : (float)$str;

                } elseif (preg_match('/^("|\').*(\1)$/s', $str, $m) && $m[1] == $m[2]) {
                    // STRINGS RETURNED IN UTF-8 FORMAT
                    $delim = substr($str, 0, 1);
                    $chrs = substr($str, 1, -1);
                    $utf8 = '';
                    $strlen_chrs = strlen($chrs);

                    for ($c = 0; $c < $strlen_chrs; ++$c) {

                        $substr_chrs_c_2 = substr($chrs, $c, 2);
                        $ord_chrs_c = ord($chrs{$c});

                        switch (true) {
                            case $substr_chrs_c_2 == '\b':
                                $utf8 .= chr(0x08);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\t':
                                $utf8 .= chr(0x09);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\n':
                                $utf8 .= chr(0x0A);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\f':
                                $utf8 .= chr(0x0C);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\r':
                                $utf8 .= chr(0x0D);
                                ++$c;
                                break;

                            case $substr_chrs_c_2 == '\\"':
                            case $substr_chrs_c_2 == '\\\'':
                            case $substr_chrs_c_2 == '\\\\':
                            case $substr_chrs_c_2 == '\\/':
                                if (($delim == '"' && $substr_chrs_c_2 != '\\\'') ||
                                   ($delim == "'" && $substr_chrs_c_2 != '\\"')) {
                                    $utf8 .= $chrs{++$c};
                                }
                                break;

                            case preg_match('/\\\u[0-9A-F]{4}/i', substr($chrs, $c, 6)):
                                // single, escaped unicode character
                                $utf16 = chr(hexdec(substr($chrs, ($c + 2), 2)))
                                       . chr(hexdec(substr($chrs, ($c + 4), 2)));
                                $utf8 .= $this->utf162utf8($utf16);
                                $c += 5;
                                break;

                            case ($ord_chrs_c >= 0x20) && ($ord_chrs_c <= 0x7F):
                                $utf8 .= $chrs{$c};
                                break;

                            case ($ord_chrs_c & 0xE0) == 0xC0:
                                // characters U-00000080 - U-000007FF, mask 110XXXXX
                                //see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 2);
                                ++$c;
                                break;

                            case ($ord_chrs_c & 0xF0) == 0xE0:
                                // characters U-00000800 - U-0000FFFF, mask 1110XXXX
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 3);
                                $c += 2;
                                break;

                            case ($ord_chrs_c & 0xF8) == 0xF0:
                                // characters U-00010000 - U-001FFFFF, mask 11110XXX
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 4);
                                $c += 3;
                                break;

                            case ($ord_chrs_c & 0xFC) == 0xF8:
                                // characters U-00200000 - U-03FFFFFF, mask 111110XX
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 5);
                                $c += 4;
                                break;

                            case ($ord_chrs_c & 0xFE) == 0xFC:
                                // characters U-04000000 - U-7FFFFFFF, mask 1111110X
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 6);
                                $c += 5;
                                break;

                        }

                    }

                    return $utf8;

                } elseif (preg_match('/^\[.*\]$/s', $str) || preg_match('/^\{.*\}$/s', $str)) {
                    // array, or object notation

                    if ($str{0} == '[') {
                        $stk = array(SERVICES_JSON_IN_ARR);
                        $arr = array();
                    } else {
                        if ($this->use & SERVICES_JSON_LOOSE_TYPE) {
                            $stk = array(SERVICES_JSON_IN_OBJ);
                            $obj = array();
                        } else {
                            $stk = array(SERVICES_JSON_IN_OBJ);
                            $obj = new stdClass();
                        }
                    }

                    array_push($stk, array('what'  => SERVICES_JSON_SLICE,
                                           'where' => 0,
                                           'delim' => false));

                    $chrs = substr($str, 1, -1);
                    $chrs = $this->reduce_string($chrs);

                    if ($chrs == '') {
                        if (reset($stk) == SERVICES_JSON_IN_ARR) {
                            return $arr;

                        } else {
                            return $obj;

                        }
                    }

                    //print("\nparsing {$chrs}\n");

                    $strlen_chrs = strlen($chrs);

                    for ($c = 0; $c <= $strlen_chrs; ++$c) {

                        $top = end($stk);
                        $substr_chrs_c_2 = substr($chrs, $c, 2);

                        if (($c == $strlen_chrs) || (($chrs{$c} == ',') && ($top['what'] == SERVICES_JSON_SLICE))) {
                            // found a comma that is not inside a string, array, etc.,
                            // OR we've reached the end of the character list
                            $slice = substr($chrs, $top['where'], ($c - $top['where']));
                            array_push($stk, array('what' => SERVICES_JSON_SLICE, 'where' => ($c + 1), 'delim' => false));
                            //print("Found split at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                            if (reset($stk) == SERVICES_JSON_IN_ARR) {
                                // we are in an array, so just push an element onto the stack
                                array_push($arr, $this->decode($slice));

                            } elseif (reset($stk) == SERVICES_JSON_IN_OBJ) {
                                // we are in an object, so figure
                                // out the property name and set an
                                // element in an associative array,
                                // for now
                                $parts = array();
                                
                                if (preg_match('/^\s*(["\'].*[^\\\]["\'])\s*:\s*(\S.*),?$/Uis', $slice, $parts)) {
                                    // "name":value pair
                                    $key = $this->decode($parts[1]);
                                    $val = $this->decode($parts[2]);

                                    if ($this->use & SERVICES_JSON_LOOSE_TYPE) {
                                        $obj[$key] = $val;
                                    } else {
                                        $obj->$key = $val;
                                    }
                                } elseif (preg_match('/^\s*(\w+)\s*:\s*(\S.*),?$/Uis', $slice, $parts)) {
                                    // name:value pair, where name is unquoted
                                    $key = $parts[1];
                                    $val = $this->decode($parts[2]);

                                    if ($this->use & SERVICES_JSON_LOOSE_TYPE) {
                                        $obj[$key] = $val;
                                    } else {
                                        $obj->$key = $val;
                                    }
                                }

                            }

                        } elseif ((($chrs{$c} == '"') || ($chrs{$c} == "'")) && ($top['what'] != SERVICES_JSON_IN_STR)) {
                            // found a quote, and we are not inside a string
                            array_push($stk, array('what' => SERVICES_JSON_IN_STR, 'where' => $c, 'delim' => $chrs{$c}));
                            //print("Found start of string at {$c}\n");

                        } elseif (($chrs{$c} == $top['delim']) &&
                                 ($top['what'] == SERVICES_JSON_IN_STR) &&
                                 ((strlen(substr($chrs, 0, $c)) - strlen(rtrim(substr($chrs, 0, $c), '\\'))) % 2 != 1)) {
                            // found a quote, we're in a string, and it's not escaped
                            // we know that it's not escaped becase there is _not_ an
                            // odd number of backslashes at the end of the string so far
                            array_pop($stk);
                            //print("Found end of string at {$c}: ".substr($chrs, $top['where'], (1 + 1 + $c - $top['where']))."\n");

                        } elseif (($chrs{$c} == '[') &&
                                 in_array($top['what'], array(SERVICES_JSON_SLICE, SERVICES_JSON_IN_ARR, SERVICES_JSON_IN_OBJ))) {
                            // found a left-bracket, and we are in an array, object, or slice
                            array_push($stk, array('what' => SERVICES_JSON_IN_ARR, 'where' => $c, 'delim' => false));
                            //print("Found start of array at {$c}\n");

                        } elseif (($chrs{$c} == ']') && ($top['what'] == SERVICES_JSON_IN_ARR)) {
                            // found a right-bracket, and we're in an array
                            array_pop($stk);
                            //print("Found end of array at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                        } elseif (($chrs{$c} == '{') &&
                                 in_array($top['what'], array(SERVICES_JSON_SLICE, SERVICES_JSON_IN_ARR, SERVICES_JSON_IN_OBJ))) {
                            // found a left-brace, and we are in an array, object, or slice
                            array_push($stk, array('what' => SERVICES_JSON_IN_OBJ, 'where' => $c, 'delim' => false));
                            //print("Found start of object at {$c}\n");

                        } elseif (($chrs{$c} == '}') && ($top['what'] == SERVICES_JSON_IN_OBJ)) {
                            // found a right-brace, and we're in an object
                            array_pop($stk);
                            //print("Found end of object at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                        } elseif (($substr_chrs_c_2 == '/*') &&
                                 in_array($top['what'], array(SERVICES_JSON_SLICE, SERVICES_JSON_IN_ARR, SERVICES_JSON_IN_OBJ))) {
                            // found a comment start, and we are in an array, object, or slice
                            array_push($stk, array('what' => SERVICES_JSON_IN_CMT, 'where' => $c, 'delim' => false));
                            $c++;
                            //print("Found start of comment at {$c}\n");

                        } elseif (($substr_chrs_c_2 == '*/') && ($top['what'] == SERVICES_JSON_IN_CMT)) {
                            // found a comment end, and we're in one now
                            array_pop($stk);
                            $c++;

                            for ($i = $top['where']; $i <= $c; ++$i)
                                $chrs = substr_replace($chrs, ' ', $i, 1);

                            //print("Found end of comment at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                        }

                    }

                    if (reset($stk) == SERVICES_JSON_IN_ARR) {
                        return $arr;

                    } elseif (reset($stk) == SERVICES_JSON_IN_OBJ) {
                        return $obj;

                    }

                }
        }
    }

    /**
     * @todo Ultimately, this should just call PEAR::isError()
     */
    function isError($data, $code = null)
    {
        if (class_exists('pear')) {
            return PEAR::isError($data, $code);
        } elseif (is_object($data) && (get_class($data) == 'services_json_error' ||
                                 is_subclass_of($data, 'services_json_error'))) {
            return true;
        }

        return false;
    }
}

if (class_exists('PEAR_Error')) {

    class Services_JSON_Error extends PEAR_Error
    {
        function Services_JSON_Error($message = 'unknown error', $code = null,
                                     $mode = null, $options = null, $userinfo = null)
        {
            parent::PEAR_Error($message, $code, $mode, $options, $userinfo);
        }
    }

} else {

    /**
     * @todo Ultimately, this class shall be descended from PEAR_Error
     */
    class Services_JSON_Error
    {
        function Services_JSON_Error($message = 'unknown error', $code = null,
                                     $mode = null, $options = null, $userinfo = null)
        {

        }
    }

}

//End Services_JSON Class

//InputParser Class @100-FD76091B
class InputParser {
	function Parse($text) {
		return null;
	}
}

//End InputParser Class

//JsonParser Class @100-3B41CE54
class JsonParser extends InputParser {
	function Parse($text) {
		$JsonParser = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
		return $JsonParser->decode($text);
	}
}

//End JsonParser Class

//OutputFormatter Class @100-DC78D990
class OutputFormatter {
	function Format($data) {
		return null;
	}
}

//End OutputFormatter Class

//JsonFormatter Class @100-789856A7
class JsonFormatter extends OutputFormatter {
	function Format($data) {
		$JsonFormatter = new Services_JSON();
		return $JsonFormatter->Encode($data);
	}
}

//End JsonFormatter Class

//ListFormatter Class @100-BD5D5F98
class ListFormatter extends OutputFormatter {
	function Format($data) {
    $result = '<ul>';
		foreach($data as $row) {
      $result .= '<li>';
      foreach($row as $cell) {
        $result .= $cell;
      }
      $result .= '</li>';
    }
    $result .= '</li>';
		return $result;
	}
}

//End ListFormatter Class

//TreeFormatter Class @100-0E301FEB
class TreeFormatter extends JsonFormatter {
	var $CategoryIdField;
	
	var $CategoryNameField;
	
	var $SubCategoryIdField;
	
	function TreeFormatter($CategoryIdField, $SubCategoryIdField, $CategoryNameField) {
		$this->CategoryIdField = $CategoryIdField;
		$this->SubCategoryIdField = $SubCategoryIdField;
		$this->CategoryNameField = $CategoryNameField;
	}
	
	function Format($Data) {
		$LastCategoryId = null;
		$OutputArray = array();
		foreach ($Data as $Row) {
			if ($LastCategoryId != $Row[$this->CategoryIdField]) {
				$LastCategoryId = $Row[$this->CategoryIdField];
				$IsFolder = $Row[$this->SubCategoryIdField]?true:false;
				$OutputArray[] = array(
					'objectId' => $LastCategoryId,
					'title' => $Row[$this->CategoryNameField],
					'isFolder' => $IsFolder,
				);
			}			
		}
		return parent::Format($OutputArray);
	}
}

//End TreeFormatter Class

//TreePlainFormatter Class @100-749D8219
class TreePlainFormatter extends JsonFormatter {
	var $CategotyIdField;
	
	var $CategoryNameField;
	
	var $SubCategoryIdField;
	
	function TreePlainFormatter($CategoryIdField, $SubCategoryIdField, $CategoryNameField) {
		$this->CategoryIdField = $CategoryIdField;
		$this->SubCategoryIdField = $SubCategoryIdField;
		$this->CategoryNameField = $CategoryNameField;
	}
	
	function Format($Data) {
		$OutputArray = array();
		foreach ($Data as $Row) {
			$Row['objectId'] = $Row[$this->CategoryIdField];
			$Row['title'] = $Row[$this->CategoryNameField];
			$Row['isFolder'] = ($Row[$this->SubCategoryIdField] > 0)?true:false;
 			$OutputArray[] = $Row;
		}
		return parent::Format($OutputArray);
	}
}

//End TreePlainFormatter Class

//TemplateFormatter Class @100-32533DD9
class TemplateFormatter extends OutputFormatter {
	
	var $Template;
	
	function SetTemplate($Template) {
		$this->Template = $Template;
	}
	
	function Format($Data) {
		global $FileEncoding, $TemplateEncoding;
		$this->TplParser = new clsTemplate($FileEncoding, $TemplateEncoding);
		$this->TplParser->LoadTemplateFromStr($this->Template, "main");
		$this->TplParser->block_path = "/main";
		foreach ($Data as $RowKey => $DataRow) {
			if (is_array($DataRow)) {
				$this->TplParser->block_path = "/main/Row";
				foreach ($DataRow as $Key => $Value) {
					$this->TplParser->SetVar($Key, htmlspecialchars($Value));
				}
				$this->TplParser->block_path = "/main";
				$this->TplParser->Parse("Row", true);
			} else {
				$this->TplParser->SetVar($RowKey, htmlspecialchars($DataRow));
			}
		}
		$this->TplParser->block_path = "";
		$this->TplParser->Parse("main", false);
		return $this->TplParser->GetVar("main");
	}
}

//End TemplateFormatter Class

//TemplateObjectFormatter Class @100-225F3A3F
class TemplateObjectFormatter extends OutputFormatter {
	
	var $Template;
  var $TplParser;
	
	function SetTemplate($Template) {
		$this->Template = $Template;
	}
	
	function Format($Data) {
    global $FileEncoding, $TemplateEncoding;
    $this->TplParser = new clsTemplate($FileEncoding, $TemplateEncoding);
    $this->TplParser->LoadTemplateFromStr($this->Template, "main");
    $this->TplParser->block_path = "/main";
    $this->ParseHash($Data);
    $this->TplParser->block_path = "";
    $this->TplParser->Parse("main", false);
    return $this->TplParser->GetVar("main");
	}
  
  function IsHash($Data) {
    if (!is_array($Data) || empty($Data)) {
      return false;
    }
    $DataKeys = array_keys($Data);
    return array_keys($DataKeys) !== $DataKeys;
  }
  
  function IsArray($Data) {
    if (!is_array($Data) || empty($Data)) {
      return false;
    }
    $DataKeys = array_keys($Data);
    return array_keys($DataKeys) === $DataKeys;
  }
  
  function ParseHash($Data) {
    foreach ($Data as $DataKey => $DataValue) {
      if ($this->IsArray($DataValue)) {
        $BlockPath = $this->TplParser->block_path;
        $NewBlockPath = $this->TplParser->block_path . "/" . $DataKey;
        $this->TplParser->block_path = $NewBlockPath;
        foreach ($DataValue as $Element) {
          $this->ParseHash($Element);
          $this->TplParser->block_path = $BlockPath;
          $this->TplParser->Parse($DataKey, true);
          $this->TplParser->block_path = $NewBlockPath;
        }
        $this->TplParser->block_path = $BlockPath;
      } else {
        // Regular value
        $this->TplParser->SetVar($DataKey, $DataValue);
      }
    }
  }
}

//End TemplateObjectFormatter Class

//Services Common Functions @100-FF6961A4
function CCEscapeSingle($str) {
	$str = str_replace(array("\\", "\'"), array("\\\\", "\\'"), $str);
	return $str;
}

function CCEscapeDouble($str) {
	$str = str_replace(array("\\", "\""), array("\\\\", "\\\""), $str);
	return $str;
}

function CCBuildSnippet($ParamsArr) {
	$Formatter = new JsonFormatter();
	if (count($ParamsArr)) {
		$Output = '<script language="JavaScript" type="text/javascript">';
		foreach ($ParamsArr as $FeatureName => $ControlParams) {
			$ControlName = $ControlParams[0];
			$ParamsStr = $Formatter->Format($ControlParams[1]);
			$Output .= 'document.getElementById("' . $ControlName . '").ccs' . $FeatureName . 'Data = ' . $ParamsStr . ';';
		}
		$Output .= '</script>';
		return $Output;
	}
	return '';
}

//End Services Common Functions

//Tpl Class @100-7DD2F37A
class Tpl {
	var $tplVars = array();
	var $tpl = null;
	
	function __construct($tpl = null) {
		$this->set_template($tpl);
	}

	function assign_var ($name, $value) {
		$this->tplVars[$name] = $value;
	}
	
	function assign_vars($arr) {
		foreach ($arr as $item => $value) {
			$this->tplVars[$item] = $value;
		}
	}
	
	function assign_block_vars($block, $arr) {
		$blockParts = explode('.', $block);
		$currentPath = '$this->tplVars';
		for ($i = 0; $i < count($blockParts); $i++) {
			$currentBlock = $blockParts[$i] . '.';
			eval('if (!isset(' . $currentPath . '[\'' . $currentBlock . '\'])) ' .
				$currentPath . '[\'' . $currentBlock . '\'] = array();');
			eval('$count = count(' . $currentPath . '[\'' . $currentBlock . '\']);');
			if ($i == count($blockParts) - 1) {
				eval($currentPath . '[\'' . $currentBlock . '\'][' . count($blockParts) . '] = $arr;');
			}
			$currentPath = $currentPath . '[\'' . $currentBlock . '\'][' . (count($blockParts) - 1) . ']';
		}
	}
	
	function parse() {
		return $this->parse_iteration($this->tpl, $this->tplVars);
	}
	
	function parse_iteration($text, $items) {
		foreach ($items as $item => $value) {
			if (substr($item, -1) == '.') { // It's block
				$block = substr($item, 0, -1);
				$beginComment = '<!-- BEGIN ' . $block . ' -->';
				$endComment = '<!-- END ' . $block . ' -->';
				while (true) {
					$beginPos = strpos($text, $beginComment);
					$beginPosAC = $beginPos + strlen($beginComment);
					$endPos = strpos($text, $endComment);
					$endPosAC = $endPos + strlen($endComment);
					if ($endPos - $beginPosAC > 0) {
						$parsed_block = "";
						for ($i = 0; $i < count($value); $i++) {
							$parsed_block .= $this->parse_iteration(substr($text, $beginPosAC, $endPos - $beginPosAC), $value[$i]);
						}
						$text = substr($text, 0, $beginPos) . $parsed_block . substr($text, $endPosAC);
					} else {
						break;
					}
				}
			} else { // It's variable
				$text = str_replace("{" . $item . "}", $value, $text);
			}
		}
		// Cut all unknown blocks
		$text = preg_replace('/<!-- BEGIN ([\s\w]+) -->[\w\W]+<!-- END \1 -->/', '', $text);
		return $text;
	}
	
	function set_template($tpl) {
		$this->tpl = $tpl;
		$this->tplVars = array();
	}
}

//End Tpl Class

?>
