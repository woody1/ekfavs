<?php

$emailbody = "

<p>Dear ". decrypt($row['firstname']) .",</p> 
<p>". $_POST['email_strapline']  ."</p>
<h2>". clean($this->post['event_title']) ."</h2>

<p><b>Location:</b> ". $this->post['event_location'] ."</p>
<p><b>Date:</b> ". date("D dS M Y", strtotime(clean($this->post['start_date']))) ." at ". date("H:i", strtotime(clean($this->post['start_time']))) ."</p>

<p>". html_entity_decode($this->post['event_details']) ."</p>

<p><a href='". _URL ."events/'>Click here to book >></a></p>
<p> </p> ";