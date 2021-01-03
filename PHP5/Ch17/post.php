<h3>Starting posting to site</h3>
<?
require_once ('settings.php');
function HTTP_Post($URL, $data, $response=false, $referrer="") 
{
    // parsing the given URL
    $URL_Info=parse_url($URL);

    // Building referrer
    if($referrer=="") // if not given use this script as referrer
        $referrer=$_SERVER["SCRIPT_FILENAME"];

    // making string from $data 
    foreach($data as $key=>$value) {
        $values[]="$key=".urlencode($value);
    }
    $data_string=implode("&",$values);
      
    // Find out which port is needed - if not given use standard (=80)
    if(!isset($URL_Info["port"]))
        $URL_Info["port"]=80;

    // building POST-request:
	$request = "";
    $request.="POST ".$URL_Info["path"]." HTTP/1.1\n";
    $request.="Host: ".$URL_Info["host"]."\n";
    $request.="Referer: $referrer\n";
    $request.="Content-type: application/x-www-form-urlencoded\n";
    $request.="Content-length: ".strlen($data_string)."\n";
    $request.="Connection: close\n";
    $request.="\n";
    $request.=$data_string."\n";

    $errno = 0;
    $errstr = "";
    $fp = fsockopen($URL_Info["host"],$URL_Info["port"], $errno, $errstr, 0);
    if ($errno == 0) {
        fputs($fp, $request);
    } else {
        die ($errno);
    }

    // by default we don't care about the response
    $result="";
    if ($response) {
        while(!feof($fp)) {
            $result .= fgets($fp, 128);
        }
    }

    fclose($fp);
    return $result;
}

print "<h3>user Alice</h3><pre>";
print HTTP_Post("$GLOBALS[baseurl]"."userlog.php",
                array("site"=>100, 
                      "section"=>1, 
                      "login"=>"alice", 
                      "session"=>"F34C44", 
                      "firstname"=>"Alice", 
                      "lastname"=>"Applebee", 
                      "address1"=>"101 Main St.", 
                      "address2"=>"", 
                      "city"=>"Urbana", 
                      "State"=>"OH", 
                      "ZIP"=>"43208", 
                      "demo0"=>"One half.", 
                      "demo1"=>"Thirty", 
                      "demo2"=>"None", 
                      "demo3"=>"Eight"
                      ), true); // see response
print "</pre>";

print "<h3>user Bob</h3><pre>";
print HTTP_Post("$GLOBALS[baseurl]"."userlog.php",
                array("site"=>200, 
                      "section"=>2, 
                      "login"=>"bob", 
                      "session"=>"65F44CC", 
                      "firstname"=>"Bob", 
                      "lastname"=>"Bingo", 
                      "address1"=>"55 Broadway.", 
                      "address2"=>"", 
                      "city"=>"Dallas", 
                      "State"=>"TX", 
                      "ZIP"=>"75201", 
                      "demo0"=>rand(1, 4),
                      "demo1"=>rand(3, 12),
                      "demo2"=>rand(0, 32)
                      ), true); // see response
print "</pre>";

?>
<h3>Posting complete</h3>
<a href="report.php">View the report</a>