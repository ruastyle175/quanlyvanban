<?php

namespace common\components;

class FAccessControl
{
    public static function allActivities()
    {
        return array(
            'index' => 'Index',
            'view' => 'View',
            'create' => 'Create',
            'update' => 'Update',
            'delete' => 'Delete',
            'bulk-delete' => 'Bulk Delete'
        );
    }
}