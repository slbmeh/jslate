<?php
/**
 * @property Dashboard $Dashboard
 */
class Dbview extends AppModel {
	var $name = 'Dbview';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'dashboard_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'left' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'top' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'width' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'height' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

	var $belongsTo = array(
		'Dashboard' => array(
			'className' => 'Dashboard',
			'foreignKey' => 'dashboard_id',
		)
	);
}
