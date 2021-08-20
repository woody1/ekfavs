<?php
$emailbody = "

<p>Dear ". $to_name .",</p> 
<p>A new ". ucfirst($article_type) ." article has been published to the GMS website</p>
<h2>$article_title</h2>
<p>$description.  <a href=\"". _URL ."article/?id=$id\">Read more >></a></p>
<p> </p> 

";

