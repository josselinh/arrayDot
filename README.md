# ArrayDot
## Set a key => value
    $array = [];
    setArrayDot($array, 'my.key.path', 'myValue');

## Get a key
    $array = [
    	'my' => [
    		'key' => [
    			'path' => 'myValue',
    		],
    	],
    ];
    echo getArrayDot($array, 'my.key.path');
