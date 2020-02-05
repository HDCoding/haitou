<?php

namespace App\Helpers;

class BBCode
{
    public $parsers = [
        'h1' => [
            'pattern' => '/\[h1\](.*?)\[\/h1\]/s',
            'replace' => '<h1>$1</h1>',
            'content' => '$1',
        ],

        'h2' => [
            'pattern' => '/\[h2\](.*?)\[\/h2\]/s',
            'replace' => '<h2>$1</h2>',
            'content' => '$1',
        ],

        'h3' => [
            'pattern' => '/\[h3\](.*?)\[\/h3\]/s',
            'replace' => '<h3>$1</h3>',
            'content' => '$1',
        ],

        'h4' => [
            'pattern' => '/\[h4\](.*?)\[\/h4\]/s',
            'replace' => '<h4>$1</h4>',
            'content' => '$1',
        ],

        'h5' => [
            'pattern' => '/\[h5\](.*?)\[\/h5\]/s',
            'replace' => '<h5>$1</h5>',
            'content' => '$1',
        ],

        'h6' => [
            'pattern' => '/\[h6\](.*?)\[\/h6\]/s',
            'replace' => '<h6>$1</h6>',
            'content' => '$1',
        ],

        'bold' => [
            'pattern' => '/\[b\](.*?)\[\/b\]/s',
            'replace' => '<strong>$1</strong>',
            'content' => '$1',
        ],

        'italic' => [
            'pattern' => '/\[i\](.*?)\[\/i\]/s',
            'replace' => '<em>$1</em>',
            'content' => '$1',
        ],

        'underline' => [
            'pattern' => '/\[u\](.*?)\[\/u\]/s',
            'replace' => '<u>$1</u>',
            'content' => '$1',
        ],

        'linethrough' => [
            'pattern' => '/\[s\](.*?)\[\/s\]/s',
            'replace' => '<span style="text-decoration: line-through;">$1</span>',
            'content' => '$1',
        ],

        'size' => [
            'pattern' => '/\[size\=(.*?)\](.*?)\[\/size\]/s',
            'replace' => '<span style="font-size: $1px;">$2</span>',
            'content' => '$2',
        ],

        'font' => [
            'pattern' => '/\[font\=(.*?)\](.*?)\[\/font\]/s',
            'replace' => '<span style="font-family: $1;">$2</span>',
            'content' => '$2',
        ],

        'color' => [
            'pattern' => '/\[color\=(.*?)\](.*?)\[\/color\]/s',
            'replace' => '<span style="color: $1;">$2</span>',
            'content' => '$2',
        ],

        'center' => [
            'pattern' => '/\[center\](.*?)\[\/center\]/s',
            'replace' => '<div style="text-align:center;">$1</div>',
            'content' => '$1',
        ],

        'left' => [
            'pattern' => '/\[left\](.*?)\[\/left\]/s',
            'replace' => '<div style="text-align:left;">$1</div>',
            'content' => '$1',
        ],

        'right' => [
            'pattern' => '/\[right\](.*?)\[\/right\]/s',
            'replace' => '<div style="text-align:right;">$1</div>',
            'content' => '$1',
        ],

        'quote' => [
            'pattern' => '/\[quote\](.*?)\[\/quote\]/s',
            'replace' => '<blockquote class="blockquote">$1</blockquote>',
            'content' => '$1',
        ],

        'namedquote' => [
            'pattern' => '/\[quote\=(.*?)\](.*)\[\/quote\]/s',
            'replace' => '<blockquote><small>$1</small>$2</blockquote>',
            'content' => '$2',
        ],

        'link' => [
            'pattern' => '/\[url\](.*?)\[\/url\]/s',
            'replace' => '<a href="$1" target="_blank">$1</a>',
            'content' => '$1',
        ],

        'namedlink' => [
            'pattern' => '/\[url\=(.*?)\](.*?)\[\/url\]/s',
            'replace' => '<a href="$1" target="_blank">$2</a>',
            'content' => '$2',
        ],

        'image' => [
            'pattern' => '/\[img\](.*?)\[\/img\]/s',
            'replace' => '<img src="$1">',
            'content' => '$1',
        ],

        'sized-image' => [
            'pattern' => '/\[img width\=(.*?)\](.*?)\[\/img\]/s',
            'replace' => '<img src="$2" width="$1px">',
            'content' => '$1',
        ],

        'sized-image2' => [
            'pattern' => '/\[img\=(.*?)\](.*?)\[\/img\]/s',
            'replace' => '<img src="$2" width="$1px">',
            'content' => '$1',
        ],

        'orderedlistnumerical' => [
            'pattern' => '/\[list=1\](.*?)\[\/list\]/s',
            'replace' => '<ol>$1</ol>',
            'content' => '$1',
        ],

        'orderedlistalpha' => [
            'pattern' => '/\[list=a\](.*?)\[\/list\]/s',
            'replace' => '<ol type="a">$1</ol>',
            'content' => '$1',
        ],

        'unorderedlist' => [
            'pattern' => '/\[list\](.*?)\[\/list\]/s',
            'replace' => '<ul>$1</ul>',
            'content' => '$1',
        ],

        'listitem' => [
            'pattern' => '/\[\*\](.*)/',
            'replace' => '<li>$1</li>',
            'content' => '$1',
        ],

        'code' => [
            'pattern' => '/\[code\](.*?)\[\/code\]/s',
            'replace' => '<code>$1</code>',
            'content' => '$1',
        ],

        'alert' => [
            'pattern' => '/\[alert\](.*?)\[\/alert\]/s',
            'replace' => '<div class="bbcode-alert">$1</div>',
            'content' => '$1',
        ],

        'note' => [
            'pattern' => '/\[note\](.*?)\[\/note\]/s',
            'replace' => '<div class="bbcode-note">$1</div>',
            'content' => '$1',
        ],

        'sub' => [
            'pattern' => '/\[sub\](.*?)\[\/sub\]/s',
            'replace' => '<sub>$1</sub>',
            'content' => '$1',
        ],

        'sup' => [
            'pattern' => '/\[sup\](.*?)\[\/sup\]/s',
            'replace' => '<sup>$1</sup>',
            'content' => '$1',
        ],

        'small' => [
            'pattern' => '/\[small\](.*?)\[\/small\]/s',
            'replace' => '<small>$1</small>',
            'content' => '$1',
        ],

        'table' => [
            'pattern' => '/\[table\](.*?)\[\/table\]/s',
            'replace' => '<table>$1</table>',
            'content' => '$1',
        ],

        'table-row' => [
            'pattern' => '/\[tr\](.*?)\[\/tr\]/s',
            'replace' => '<tr>$1</tr>',
            'content' => '$1',
        ],

        'table-data' => [
            'pattern' => '/\[td\](.*?)\[\/td\]/s',
            'replace' => '<td>$1</td>',
            'content' => '$1',
        ],

        'youtube' => [
            'pattern' => '/\[youtube\](.*?)\[\/youtube\]/s',
            'replace' => '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/$1?rel=0" 
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
            'content' => '$1',
        ],

        'video' => [
            'pattern' => '/\[video\](.*?)\[\/video\]/s',
            'replace' => '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/$1?rel=0" 
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
            'content' => '$1',
        ],

        'video-youtube' => [
            'pattern' => '/\[video="youtube"\](.*?)\[\/video\]/s',
            'replace' => '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/$1?rel=0" 
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
            'content' => '$1',
        ],

        'linebreak' => [
            'pattern' => '/\r\n/',
            'replace' => '<br />',
            'content' => '',
        ],

        'spoiler' => [
            'pattern' => '/\[spoiler\](.*?)\[\/spoiler\]/s',
            'replace' => '<details class="label label-primary"><summary>Spoiler</summary><pre><code>$1</code></pre></details>',
            'content' => '$1',
        ],

        'named-spoiler' => [
            'pattern' => '/\[spoiler\=(.*?)\](.*?)\[\/spoiler\]/s',
            'replace' => '<details class="label label-primary"><summary>$1</summary><pre><code>$2</code></pre></details>',
            'content' => '$1',
        ],

        'ss-compare' => [
            'pattern' => '/\[ss-compare\=(.*?)\](.*?)\[\/ss-compare\]/s',
            'replace' => '<a class="ss-compare" href="#">
                          <img src="$1" />
                          <img src="$2" />
                          </a>',
            'content' => '$1',
        ],
    ];

    /**
     * var array
     */
    protected $enabledParsers;

    /**
     * BBCode constructor.
     */
    public function __construct()
    {
        $this->enabledParsers = $this->parsers;
    }

    /**
     * Remove all BBCode.
     *
     * @param string $source
     * @return string|string[]|null Parsed text
     */
    public function stripBBCodeTags($source)
    {
        foreach ($this->parsers as $name => $parser) {
            $source = $this->searchAndReplace($parser['pattern'] . 'i', $parser['content'], $source);
        }
        return $source;
    }

    /**
     * Searches after a specified pattern and replaces it with provided structure.
     *
     * @param string $pattern Search pattern
     * @param string $replace Replacement structure
     * @param string $source Text to search in
     * @return string|string[]|null Parsed text
     */
    public function searchAndReplace($pattern, $replace, $source)
    {
        while (preg_match($pattern, $source)) {
            $source = preg_replace($pattern, $replace, $source);
        }
        return $source;
    }

    /**
     * Helper function to parse case sensitive.
     *
     * @param $source String containing the BBCode
     * @return string
     */
    public function parseCaseSensitive($source)
    {
        return $this->parse($source, false);
    }

    /**
     * Parses the BBCode string
     *
     * @param $source
     * @param bool $caseInsensitive
     * @return string
     */
    public function parse($source, $caseInsensitive = false)
    {
        foreach ($this->enabledParsers as $name => $parser) {
            $pattern = ($caseInsensitive) ? $parser['pattern'] . 'i' : $parser['pattern'];
            $source = $this->searchAndReplace($pattern, $parser['replace'], $source);
        }
        return $source;
    }

    /**
     * Helper function to parse case insensitive.
     *
     * @param string $source String containing the BBCode
     * @return string
     */
    public function parseCaseInsensitive($source)
    {
        return $this->parse($source, true);
    }

    /**
     * List of chosen parsers
     *
     * @return array of parsers
     */
    public function getParsers()
    {
        return $this->enabledParsers;
    }

    /**
     * Sets the parser pattern and replace.
     * This can be used for new parsers or overwriting existing ones.
     *
     * @param string $name
     * @param string $pattern
     * @param string $replace
     * @param string $content
     */
    public function setParser($name, $pattern, $replace, $content)
    {
        $this->parsers[$name] = [
            'pattern' => $pattern,
            'replace' => $replace,
            'content' => $content
        ];

        $this->enabledParsers[$name] = [
            'pattern' => $pattern,
            'replace' => $replace,
            'content' => $content
        ];
    }
}
