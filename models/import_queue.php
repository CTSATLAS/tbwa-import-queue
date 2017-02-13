<?php

class Import extends ImportQueueAppModel {
    public $name = 'Import';

    public $uses = array('ImportQueue.Import');
}