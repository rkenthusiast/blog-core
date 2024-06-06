<?php return array(
    'root' => array(
        'name' => 'rk/blog_core',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '219f95759bf3a5476e7cb69fe6c3aad2868b6408',
        'type' => 'project',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'composer/installers' => array(
            'pretty_version' => 'v1.12.0',
            'version' => '1.12.0.0',
            'reference' => 'd20a64ed3c94748397ff5973488761b22f6d3f19',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'rk/blog_core' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '219f95759bf3a5476e7cb69fe6c3aad2868b6408',
            'type' => 'project',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'shama/baton' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
    ),
);
