<?php

return [

    'app' => [
        'name' => 'PT MPK',
    ],

    'menu' => [
        'logout' => 'Logout',
        'password' => 'Change Password',
        'profile' => 'Profile',
        'dummies' => 'Dummies',
        'users' => 'Users',
        'home' => 'Home',
        'dashboard' => 'Dashboard',
        'asset_category' => 'Asset Category',
        'warehouse' => 'Warehouse',
        'supplier' => 'Supplier',
        'asset' => 'Asset',
    ],

    'categories' => [
        'name' => 'Category Name',
        'placeholders' => [
            'name' => 'Electronic',
        ],
        'titles' => [
            'index' => 'Categories',
            'create' => 'Create Category',
            'edit' => 'Edit Category',
            'show' => 'Detail Category',
        ]
    ],

    'auth' => [
        'email' => 'Email',
        'password' => 'Password',
        'forgot_password' => 'I forgot my password',
        'forgot_password_message' => 'You forgot your password? Here you can easily retrieve a new password.',
        'login' => 'Login',
        'remember_me' => 'Remember Me',
        'buttons' => [
            'request_password' => 'Request new password',
            'sign_in' => 'Sign In',
        ],
        'placeholders' => [
            'email' => 'Email',
            'password' => 'Password',
        ],
        'titles' => [
            'login' => 'Login',
            'forgot_password' => 'Forgot Password',
        ]
    ],

    'dummies' => [
        'name' => 'Product Name',
        'quantity' => 'Quantity',
        'production_date' => 'Production Date',
        'description' => 'Description',
        'image' => 'Image',
        'placeholders' => [
            'name' => 'Asus',
            'quantity' => '10',
            'production_date' => '2020-10-05',
            'description' => 'Example description',
        ],
        'titles' => [
            'index' => 'Dummies',
            'create' => 'Create Dummy',
            'edit' => 'Edit Dummy',
            'show' => 'Detail Dummy',
        ]
    ],

    // welcome
    'welcome' => [
        'titles' => [
            'index' => 'Welcome',
        ]
    ],

    'home' => [
        'titles' => [
            'index' => 'Home',
        ]
    ],

    'profile' => [
        'name' => 'Full Name',
        'email' => 'Email',
        'password' => 'Password',
        'new_password' => 'New Password',
        'password_confirmation' => 'Password Confirmation',
        'image' => 'Image',
        'photo_profile' => 'Photo Profile',
        'position' => 'Position',
        'placeholders' => [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'Your password',
            'new_password' => 'New password',
            'password_confirmation' => 'Retype password',
        ],
        'titles' => [
            'show' => 'User Profile',
            'edit' => 'Edit Profile',
        ]
    ],

    'users' => [
        'name' => 'User Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'image' => 'Image',
        'placeholders' => [
            'name' => 'John Doe',
            'email' => 'john.doe@example.test',
            'password' => 'Your password',
            'password_confirmation' => 'Retype password',
        ],
        'titles' => [
            'index' => 'Users',
            'create' => 'Create User',
            'edit' => 'Edit User',
            'show' => 'Detail User',
        ]
    ],

    'components' => [
        'forms' => [
            'text' => 'Text',
            'number' => 'Number',
            'email' => 'Email',
            'textarea' => 'Textarea',
            'image' => 'Image',
            'select' => 'Select',
            'select2' => 'Select2',
            'placeholders' => [
                'text' => 'Text field',
                'number' => 'Only accept number',
                'email' => 'example@gmail.com',
                'textarea' => 'Long text',
                'select' => '-- Select --',
                'select2' => '-- Select2 --',
            ]
        ],

        'titles' => [
            'form' => 'Forms'
        ]
    ],

    'dashboard' => [
        'titles' => [
            'index' => 'Dashboard',
        ]
    ],

    'asset_category' => [
        'name' => 'Name',
        'description' => 'Description',
        'placeholders' => [
            'name' => 'Name',
            'description' => 'Description...',
        ],
        'titles' => [
            'index' => 'Asset Categories',
            'create' => 'Create Asset Category',
            'edit' => 'Edit Asset Category',
            'show' => 'Detail Asset Category',
        ]
    ],

    'warehouse' => [
        'name' => 'Name',
        'description' => 'Description',
        'placeholders' => [
            'name' => 'Name',
            'description' => 'Description...',
        ],
        'titles' => [
            'index' => 'Warehouses',
            'create' => 'Create Warehouse',
            'edit' => 'Edit Warehouse',
            'show' => 'Detail Warehouse',
        ]
    ],

    'supplier' => [
        'name' => 'Name',
        'description' => 'Description',
        'no_telp' => 'No. telepon',
        'alamat' => 'Alamat',
        'placeholders' => [
            'name' => 'Name',
            'description' => 'Description...',
            'no_telp' => '6208123...',
            'alamat' => 'Alamat lengkap...',
        ],
        'titles' => [
            'index' => 'Suppliers',
            'create' => 'Create Supplier',
            'edit' => 'Edit Supplier',
            'show' => 'Detail Supplier',
        ]
    ],

    'asset' => [
        'code' => 'Code',
        'name' => 'Name',
        'serial_number' => 'Serial number',
        'asset_category' => 'Category',
        'warehouse' => 'Warehouse',
        'supplier' => 'Supplier',
        'price' => 'Price',
        'purchased_at' => 'Purchased at',
        'description' => 'Description',
        'image' => 'Image',
        'alamat' => 'Alamat',
        'placeholders' => [
            'code' => '1 2233....',
            'name' => 'Name',
            'serial_number' => '11 2233...',
            'description' => 'Description...',
            'no_telp' => '6208123...',
            'alamat' => 'Alamat lengkap...',
            'choose' => 'Choose...',
            'price' => '8000',
        ],
        'titles' => [
            'index' => 'Assets',
            'create' => 'Create Asset',
            'edit' => 'Edit Asset',
            'show' => 'Detail Asset',
            'qr_code' => 'Qr Code Asset',
        ]
    ],

    'buttons' => [
        'add' => 'Add',
        'back' => 'Back',
        'cancel' => 'Cancel',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'save' => 'Save',
        'show' => 'Show',
        'detail' => 'Detail',
        'download' => 'Download',
        'qrcode' => 'Qr Code',
    ],

    'general' => [
        'number' => 'No.',
        'actions' => 'Action',
        'click_to_see' => 'Klik untuk melihat',
        'data_does_not_exist' => 'Data does not exist',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'search' => 'Search..',
    ],
];
