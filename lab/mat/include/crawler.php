<?php 
class crawler
{
    protected $_url;
    protected $_depth;
    protected $_host;
    protected $_useHttpAuth = false;
    protected $_user;
    protected $_pass;
    protected $_seen = array();
    protected $_filter = array();

    public function __construct($url, $depth = 5)
    {
        $this->_url = $url;
        $this->_depth = $depth;
        $parse = parse_url($url);
        $this->_host = $parse['host'];
    }

    protected function _processAnchors($content, $url, $depth)
    {
        $dom = new DOMDocument('1.0');
        @$dom->loadHTML($content);
        $anchors = $dom->getElementsByTagName('a');

        foreach ($anchors as $element) {
            $href = $element->getAttribute('href');
            if (0 !== strpos($href, 'http')) {
                $path = '/' . ltrim($href, '/');
                if (extension_loaded('http')) {
                    $href = http_build_url($url, array('path' => $path));
                } else {
                    $parts = parse_url($url);
                    $href = $parts['scheme'] . '://';
                    if (isset($parts['user']) && isset($parts['pass'])) {
                        $href .= $parts['user'] . ':' . $parts['pass'] . '@';
                    }
                    $href .= $parts['host'];
                    if (isset($parts['port'])) {
                        $href .= ':' . $parts['port'];
                    }
                    $href .= $path;
                }
            }
            // Crawl only link that belongs to the start domain
            $this->crawl_page($href, $depth - 1);
        }
    }

    protected function _getContent($url)
    {
        $handle = curl_init($url);
        if ($this->_useHttpAuth) {
            curl_setopt($handle, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($handle, CURLOPT_USERPWD, $this->_user . ":" . $this->_pass);
        }
        // follows 302 redirect, creates problem wiht authentication
//        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, TRUE);
        // return the content
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);
        // response total time
        $time = curl_getinfo($handle, CURLINFO_TOTAL_TIME);
        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        curl_close($handle);
        return array($response, $httpCode, $time);
    }

    protected function _printResult($url, $depth, $httpcode, $time)
    {
        ob_end_flush();
        $currentDepth = $this->_depth - $depth;
        $count = count($this->_seen);
        echo "<tr><td>No $count</td><td>CODE : $httpcode</td><td>TIME: $time</td><td>DEPTH: $currentDepth</td><td> URL: <a href='$url' target='_blank'>$url</a> [<a href='?go=url-dl.php&url=".urlencode($url)."&file=test.mp3' target='_blank'>DL</a>] - [<a href='?go=crawler.php&startURL=".urlencode($url)."&depth=6&username=&password=&exclude=Huntr&crawl=1'>CRAWL</a>]</td></tr>";
        ob_start();
        flush();
    }

    protected function isValid($url, $depth)
    {
        if (strpos($url, $this->_host) === false
            || $depth === 0
            || isset($this->_seen[$url])
        ) {
            return false;
        }
        foreach ($this->_filter as $excludePath) {
            if (strpos($url, $excludePath) !== false) {
                return false;
            }
        }
        return true;
    }

    public function crawl_page($url, $depth)
    {
        if (!$this->isValid($url, $depth)) {
            return;
        }
        // add to the seen URL
        $this->_seen[$url] = true;
        // get Content and Return Code
        list($content, $httpcode, $time) = $this->_getContent($url);
        // print Result for current Page
        $this->_printResult($url, $depth, $httpcode, $time);
        // process subPages
        $this->_processAnchors($content, $url, $depth);
    }

    public function setHttpAuth($user, $pass)
    {
        $this->_useHttpAuth = true;
        $this->_user = $user;
        $this->_pass = $pass;
    }

    public function addFilterPath($path)
    {
        $this->_filter[] = $path;
    }

    public function run()
    {
        $this->crawl_page($this->_url, $this->_depth);
    }
}

?>
<h2> Webpage crawler </h2>
<br>
<center>
    <?php
    if(isset($_REQUEST['crawl'])){
       extract($_REQUEST); 
        // $startURL = 'http://YOUR_URL/';
        // $depth = 6;
        // $username = 'YOURUSER';
        // $password = 'YOURPASS';
       echo '<table class="highlight">';
        $crawler = new crawler($startURL, $depth);
        $crawler->setHttpAuth($username, $password);
        // Exclude path with the following structure to be processed 
        $crawler->addFilterPath(@implode(',',$exclude));
        $crawler->run();
        echo '</table><br><br>';
    }
    ?>
</center>
<form method="post" action="#">
    <div class="container">
        <div class="input-field">
        <label for="startURL">URL de Base</label> <input id="startURL" type="text" name="startURL" size="50">
        </div>
        <div class="input-field">
        <label for="depth">Profondeur</label> <input type="text" name="depth" placeholder="Sur 6" id="depth">
        </div>
        <div class="input-field">
        <label for="username">Username (si besoin)</label> <input type="text" name="username" id="username">
        </div>
        <div class="input-field">
        <label for="mdp">MDP (si besoin)</label> <input id="mdp" placeholder="Mot de passe" type="text" name="password">
        </div>
        <div class="input-field">
        <label for="exclude">Exclure</label> <input id="exclude" type="text" name="exclude" value="huntr" placeholder="Si plusieurs, separez avec de virgules">
        </div>
        <br>
        <div>
        <input type="submit" name="crawl" value="Demarrer" class="btn-flat green white-text waves-effect waves-light">
    </div>
    </div>
</form>