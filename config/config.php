<?php
$config['plugins.navigation.tools.import_queue'] = array(
    'rel' => 'plugin',
    'title' => 'Import Queue',
    'children' => array(
        array(
            'rel' => 'plugin',
            'title' => 'Import Queue',
            'link'  => array('controller' => 'imports', 'plugin' => 'import_queue', 'admin' => true)
        )
    )
);