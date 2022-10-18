<?php

class Transaction extends AppModel
{
    var $hasMany = array('TransactionItem' => array(
        'foreignKey'    => 'transaction_id',
    )
    );
}