<?php
return array(
    'elements'=>array(
        'vhost'=>array(
            'type'=>'form',
            'title'=>'Base virtual host configuration:',
            'elements'=>array(
                'hostname'=>array(
                    'type'=>'text',
                    'size'=>50,
                    'maxlength'=>64
                ),
                'path_to'=>array(
                    'type'=>'text',
                    'size'=>60,
                    'maxlength'=>256
                ),
                'info'=>array(
                    'type'=>'textarea',
                    'rows'=>6,
                    'cols'=>50
                )
            ),
        ),

        'config'=>array(
            'type'=>'form',
            'title'=>'Extended virtual host configuration:',
            'elements'=>array(
                '<input type="checkbox" id="edit_config"> Edit config template',
                'config'=>array(
                    'type'=>'textarea',
                    'rows'=>10,
                    'cols'=>100,
                    'disabled'=>true,
                ),

            ),
        ),
    ),

    'buttons'=>array(
        'submit'=>array(
            'type'=>'submit',
            'label'=>'Send data',
        ),
    ),
);