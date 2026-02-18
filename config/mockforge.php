<?php

return [
    /*
     * Maximum number of history records shown in the endpoint history modal.
     */
    'history_display_limit' => 10,

    /*
     * Maximum allowed JSON payload size in bytes.
     */
    'max_payload_bytes' => 25000,

    /*
     * Maximum simulated delay in milliseconds.
     */
    'max_delay_ms' => 10000,

    /*
     * Number of days after creation before an endpoint is considered expired
     * and soft-deleted by the DeleteExpiredEndpoints job.
     */
    'endpoint_expiry_days' => 7,

    /*
     * Number of days after soft-deletion before an endpoint is permanently
     * hard-deleted by the DeleteExpiredEndpoints job.
     */
    'soft_delete_retention_days' => 5,
];
