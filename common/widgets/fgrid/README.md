FGridView Widget for Yii2
========================
Installation
------------

* Add to your database new `unsigned int` attribute, such `sortOrder`.

* Add new behavior in the AR model, for example:

```php
use himiklab\sortablegrid\SortableGridBehavior;

public function behaviors()
{
    return [
        'sort' => [
            'class' => SortableGridBehavior::className(),
            'sortableAttribute' => 'sortOrder'
        ],
    ];
}
```

* Add action in the controller, for example:

```php
use himiklab\sortablegrid\SortableGridAction;

public function actions()
{
    return [
        'sort' => [
            'class' => SortableGridAction::className(),
            'modelName' => Model::className(),
        ],
    ];
}
```

Usage
-----
* Use SortableGridView as standard GridView with `sortableAction` option.
You can also subscribe to the JS event 'sortableSuccess' generated widget after a successful sorting.
