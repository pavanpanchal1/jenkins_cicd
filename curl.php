<?php
$apiKey = "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";
$model = "text-davinci-003";
$prompt = $_POST['prompt'];
$temperature = 0.7;
$maxTokens = 256;
$topP = 1;
$frequencyPenalty = 0;
$presencePenalty = 0;

$data = array(
    'model' => $model,
    'prompt' => $prompt,
    'temperature' => $temperature,
    'max_tokens' => $maxTokens,
    'top_p' => $topP,
    'frequency_penalty' => $frequencyPenalty,
    'presence_penalty' => $presencePenalty
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $apiKey));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    $jsonResponse = json_decode($response, true);
    $generatedText = '';
    var_dump($jsonResponse);die();
    if (isset($jsonResponse['choices']) && count($jsonResponse['choices']) > 0 && isset($jsonResponse['choices'][0]['text'])) {
        $generatedText = $jsonResponse['choices'][0]['text'];
    } else {
        $generatedText = 'No response generated.';
    }
  
    $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $generatedText);
    $numSentences = count($sentences);
    $paragraphs = array();
    $curParagraph = '';
    for ($i = 0; $i < $numSentences; $i++) {
        $curParagraph .= $sentences[$i] . ' ';
        if (($i + 1) % 3 == 0) {
            array_push($paragraphs, $curParagraph);
            $curParagraph = '';
        }
    }
    if ($curParagraph != '') {
        array_push($paragraphs, $curParagraph);
    }
    foreach ($paragraphs as $paragraph) {
        echo "<p>" . trim($paragraph) . "</p>" . "<br>";
    }
}

curl_close($ch);
?>