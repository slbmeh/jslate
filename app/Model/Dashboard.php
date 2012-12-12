<?php
/**
 * @property Dbview $Dbview
 */
class Dashboard extends AppModel {
        
	public $name = 'Dashboard';
	public $displayField = 'name';
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

	public $hasMany = array(
		'Dbview' => array(
			'className' => 'Dbview',
			'foreignKey' => 'dashboard_id',
			'dependent' => false,
		)
	);

	public function belongsToUser($dashboard_id, $user_id){
		$dashboard = $this->find('first',array(
			'conditions' => array(
				'id' => $dashboard_id,
				'user_id' => $user_id
			)
		));
		return !empty($dashboard) ? true : false;
        }

}
