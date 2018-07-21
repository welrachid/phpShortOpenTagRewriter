# phpShortOpenTagRewriter
script that goes recursively and changes old php into &lt;?php
This script will run through a directory recursively and rewrite short open tag &lt;? to <?php .
Since this is a context-unaware script that i have made to help me upgrade some of my old projects please be aware that this will REWRITE texts/comments INSIDE .php

This tool should only be used with care and make sure you have a backup. The best solution is ofcourse to have versioning (svn/git/whatever)
The tool is provided as is and please feel free to make pull-requests if you think you can improve it.
