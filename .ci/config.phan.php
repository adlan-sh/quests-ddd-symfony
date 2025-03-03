<?php

return [
    'target_php_version' => '8.3',
    'minimum_target_php_version' => '8.3',
    'directory_list' => [
        'src',
        'public',
        'bin',
        'vendor',
    ],
    'exclude_analysis_directory_list' => [
        'vendor/',
    ],
    'plugins' => [
        'AlwaysReturnPlugin',
        'DuplicateArrayKeyPlugin',
        'DollarDollarPlugin',
        'DuplicateArrayKeyPlugin',
        'PregRegexCheckerPlugin',
        'PrintfCheckerPlugin',
        'UseReturnValuePlugin',
    ],
    'suppress_issue_types' => [
        'PhanTypeMismatchArgument',
        'PhanRedefinedExtendedClass',
        'PhanRedefinedClassReference',
    ],
];
