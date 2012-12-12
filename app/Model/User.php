<?php
/**
 * @property Dashboard $Dashboard
 */
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

	var $hasMany = array(
		'Dashboard' => array(
			'className' => 'Dashboard',
			'foreignKey' => 'user_id',
			'dependent' => false,
		)
	);
	
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
}
