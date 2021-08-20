<?php


$json = '[
{
    "name": "Diana Makgill",
    "title": "Honorary President",
    "phone": "830260"
},
{
    "name": "Christine Battle ",
    "title": "Secretary",
    "phone": "830975"
},
{
    "name": "Bill Willmott ",
    "title": "Chairman",
    "phone": "830009"
},
{
    "name": "Tom Kenyon ",
    "title": "Treasurer",
    "phone": "830246"
},

{
    "name": "Val Morsman",
    "title": "Publicity",
    "phone": "830030"
},

{
    "name": "Venetia Wright",
    "title": "Sponsorship",
    "phone": "830882"
},

{
    "name": "Jo Cumberlege",
    "title": " - ",
    "phone": "830375"
},

{
    "name": "Helen Lever",
    "title": " - ",
    "phone": "830473"
},

{
    "name": "Martin Smith",
    "title": " - ",
    "phone": "830420"
}

]';
$queries = json_decode($json);


//Example foreach
foreach ($queries as $query) {

    $names .= "
            
               <div class='col-md-3 col-sm-4 mb30 text-center'>
                    <h4>" . $query->name . "</h4>
                    <span class='bold'> " . $query->title . " </span>
                    <div class='seprator-overlay'></div>
                    <ul class='list-inline'>
                        <li class='list-inline-item'>
                            <i class='fa fa-phone'></i> " . $query->phone . "
                        </li>
                    </ul>
                </div><!--/col-->
          

";
}

?>
                <h2 class="mb20 text-center">Organising Committee</h2>
                <p>Please contact any of the organising committee if you have any questions, or if you might consider volunteering to help with preparations for the show or organising on the day.</p>


<div class='row justify-content-center'>
    <?= $names ?>
  </div>
