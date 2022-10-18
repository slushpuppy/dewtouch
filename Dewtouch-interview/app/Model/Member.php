<?php

class Member extends AppModel
{
    var $hasMany = array('Transaction' => array(
        'foreignKey'    => 'member_id',
    )
    );
}