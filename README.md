# heading-parser

Install
========

```
 $ composer require ibraheem-ghazi/heading-parser
```

**Example:**

```
<?php

require 'vendor/autoload.php';

use IbraheemGhazi\HeadingParser\HtmlHeadingParser;

$code = "";
$code  .= "<h2>Heading 2</h2>";
$code .=    "<h3>Heading 3</h3>";
$code .=        "<h4>Heading 4</h4>";
$code .=        "<h4>Heading 4</h4>";
$code .=            "<h5>Heading 5</h5>";
$code .=        "<h4>Heading 4</h4>";
$code .=    "<h3>Heading 3</h3>";
$code .= "<h2>Heading 2</h2>";
$code .=    "<h3>Heading 3</h3>";
$code .=    "<h3>Heading 3</h3>";
$code .=        "<h4>Heading 4</h4>";
$code .=         "<h5>Heading 5</h5>";
$code .=         "<h5>Heading 5</h5>";
$code .=           "<h6>Heading 6</h6>";
$code .= "<h2>Heading 2</h2>";

var_dump(HtmlHeadingParser::parse($code));
```
