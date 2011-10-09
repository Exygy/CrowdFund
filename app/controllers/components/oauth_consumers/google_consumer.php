<?php
class GoogleConsumer extends AbstractConsumer {
    public function __construct() {
        parent::__construct(BASE_DOMAIN, GOOGLE_OAUTH_CONSUMER_SECRET);
    }
}
?>