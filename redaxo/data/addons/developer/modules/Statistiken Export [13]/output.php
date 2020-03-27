<?php

$authentication_required = true;

if (!rex::isBackend()) {
    $stats_credential = rex_post('Stats-Credential');

    if ($authentication_required && !$stats_credential) {
        rex_response::setStatus(401); // 401 Unauthorized means 'No authentication provided' (!!!)

        $post_content = '';
        foreach ($_POST as $key => $val) {
            $post_content .= "$key: $val\r\n";
        }
        $get_content = '';
        foreach ($_GET as $key => $val) {
            $get_content .= "$key: $val\r\n";
        }

        rex_response::sendContent('You must authenticate with your stats credential token: ' . $post_content);
    } elseif ($authentication_required && !naju_credentials::checkToken($stats_credential)) {
        rex_response::setStatus(403); // 403 Forbidden means authorization failed
        rex_response::sendContent('Invalid stats credential token');
    } else {
        $stats_csv = "timestamp,page,referer\r\n";
        $from = rex_get('from', 'string', null);
        $to = rex_get('to', 'string', null);
        
        $log_entries = naju_stats::fetchStats($from, $to);
        
        foreach ($log_entries as $entry) {
            $stats_csv .= "{$entry['timestamp']},{$entry['page']},{$entry['referer']}\r\n";
        }
        
        rex_response::setHeader('Content-Type', 'text/csv');
        rex_response::sendContent($stats_csv);
    }
} else {
    echo 'Hier wird die Besucherstatistik angezeigt';
}

