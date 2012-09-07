<?php
$config =& get_config();
echo file_get_contents($config['base_url'] . 'errors/error_404');