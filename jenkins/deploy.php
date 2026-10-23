<?php

// Credentials and server come from the environment, never from this file.
// Requests authenticated with an API token don't need a Jenkins-Crumb.
$jenkinsBaseUrl = rtrim(getenv('JENKINS_URL') ?: '', '/');
$jenkinsUser    = getenv('JENKINS_USER') ?: '';
$jenkinsToken   = getenv('JENKINS_TOKEN') ?: '';

if ($jenkinsBaseUrl === '' || $jenkinsUser === '' || $jenkinsToken === '') {
    fwrite(STDERR, "Set JENKINS_URL, JENKINS_USER and JENKINS_TOKEN first. See DEPLOY.md".PHP_EOL);
    exit(1);
}

$branch = $argv[1] ?? 'develop';
$project = $argv[2] ?? str_replace('prefix-', '', basename(getcwd()));

$gitTag = trim((string) shell_exec('git describe --exact-match --tags 2> /dev/null'));
echo "gitTag: $gitTag \n";
echo "project: $project \n";
if(empty($gitTag)) {
    fwrite(STDERR, "Git tag missing".PHP_EOL);
    exit(1);
}

$jenkinsUrl = $jenkinsBaseUrl."/job/backend/job/staging/job/".rawurlencode($project)."/buildWithParameters?delay=0sec";
$jenkinsParams = http_build_query([
    'name' => 'component',
    'value' => 'anything',
    'git_branch' => $gitTag,
]);

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL            => $jenkinsUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => "",
    CURLOPT_POSTFIELDS     => $jenkinsParams,
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => "POST",
    CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
    CURLOPT_USERPWD        => "$jenkinsUser:$jenkinsToken",
    CURLOPT_HTTPHEADER     => [
        "Cache-Control: no-cache",
        'Content-Type: application/x-www-form-urlencoded',
    ],
]);

$response = curl_exec($curl);
$err      = curl_error($curl);
$status   = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

if ($err) {
    fwrite(STDERR, "cURL Error #:" . $err.PHP_EOL);
    exit(1);
}

// Jenkins answers 201 Created when the build is queued
if ($status < 200 || $status >= 300) {
    fwrite(STDERR, "Deploy failed: HTTP $status".PHP_EOL.$response.PHP_EOL);
    exit(1);
}

echo $response.PHP_EOL;
echo 'successfully deployed :)'.PHP_EOL;
