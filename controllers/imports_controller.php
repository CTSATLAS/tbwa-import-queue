<?php

class ImportsController extends ImportQueueAppController {
    public $name = 'Imports';

    public $uses = array('ImportQueue.Import');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'fullscreen';
    }

    public function admin_index() {
        $imports = $this->Import->find('all');

        $this->set(compact('imports'));
    }

    public function admin_open() {
        $data = array();
        $imports = $this->Import->find('all', array(
            'conditions' => array(
                'Import.processed_at' => NULL
            )
        ));

        if (!empty($imports)) {
            foreach ($imports as $import) {
                $tmp = array(
                    'firstname' => $import['Import']['firstname'],
                    'lastname' => $import['Import']['lastname'],
                    'ssn' => $import['Import']['ssn'],
                    'extra_data' => $import['Import']['extra_data']
                );

                $data['data'][] = $tmp;
            }
        } else {
            $data['data'] = array();
        }

        $data['recordsTotal'] = count($data['data']);

        $this->set(compact('data'));
        $this->render(null, null, '/elements/ajaxreturn');
    }

    public function admin_archived() {
        $data = array();
        $imports = $this->Import->find('all', array(
            'conditions' => array(
                'Import.processed_at <>' => NULL
            )
        ));

        if (!empty($imports)) {
            foreach ($imports as $import) {
                $tmp = array(
                    'firstname' => $import['Import']['firstname'],
                    'lastname' => $import['Import']['lastname'],
                    'ssn' => $import['Import']['ssn'],
                    'extra_data' => $import['Import']['extra_data'],
                    'processed_at' => $import['Import']['processed_at']
                );

                $data['data'][] = $tmp;
            }
        } else {
            $data['data'] = array();
        }

        $data['recordsTotal'] = count($data['data']);

        $this->set(compact('data'));
        $this->render(null, null, '/elements/ajaxreturn');
    }
}