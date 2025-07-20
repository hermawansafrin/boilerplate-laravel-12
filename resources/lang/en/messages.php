<?php

return [
    'success' => 'Successfully retrieved data from :url',
    'success_show' => 'Displaying data',
    'success_retrived' => 'Successfully retrieved data',
    'success_show_year' => 'Displaying data for year',
    'token_not_found' => 'Token not found',
    'token_invalid' => 'Invalid token',
    'failed_cause_client_error' => ':url cannot process your request due to input mismatch',
    'failed_cause_server_error' => ':url is temporarily unavailable, please try again later',

    'action_add' => 'added',
    'action_edit' => 'updated',
    'action_delete' => 'deleted',
    'action_reset' => 'reset',
    'action_asked' => 'submitted',
    'action_cancel' => 'cancelled',
    'action_complete' => 'completed',

    'confirmation' => [
        'cancel' => 'Are you sure you want to cancel this data?',
        'complete' => 'Are you sure you want to complete this data?',
        'delete' => 'Are you sure you want to delete this data?',
    ],

    'session' => [
        'success' => [
            'title' => 'Success!',
            'subtitle' => 'Data successfully :action.',
        ],
        'failed' => [
            'title' => 'Failed!',
            'subtitle' => 'Data failed to :action.',
        ],
    ],
    'failed_must_auth' => 'You must login first',
    'failed' => [
        'limit_images' => 'Number of images exceeds limit',
    ],
    'filter_implemented' => 'Filter successfully applied',
    'cannot_editable_or_deletable' => 'Cannot be edited or deleted',

    /**
     * FROM API
     */
    'auth' => [
        'login_success' => 'Login successful',
        'logout_success' => 'Logout successful',
        'unauthorized' => 'Unauthorized',
    ],

    'retrieved' => 'Successfully retrieved data',
    'created' => 'Successfully created data',
    'updated' => 'Successfully updated data',
    'deleted' => 'Successfully deleted data',
];
