<?=$html->image( HTTP_BASE . '/img/logo.jpg' );?>
<p>Hi <?=$greeting?>,</p>
<p>A password reset has been requested for your Eurekafund.org account.</p>
<p>If you requested a password reset please follow the link below to reset your password: </p>
<p><?=$html->link( $reset_link, $reset_link )?></p>
<p>If you did not request a password reset, please ignore this email!</p>
<p>Thanks,</p>
<p>-Team EurekaFund</p>

